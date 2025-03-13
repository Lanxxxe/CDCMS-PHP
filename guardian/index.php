<?php 
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);


include '../config/database.php';

// ✅ Check if email & session_token are provided
if (!isset($_GET['email']) || !isset($_GET['session_token'])) {
    header("Location: https://smartbarangayconnect.com");
    exit();
}

$email = $_GET['email'];
$session_token = $_GET['session_token'];
// $email = 'akirafranse@gmail.com';
// $session_token = null;

// ✅ Fetch registerlanding data from Main Domain API
$api_url = "https://smartbarangayconnect.com/api_get_registerlanding.php"; // Correct URL
$response = file_get_contents($api_url);
$data = json_decode($response, true);

if (!$data) {
    die("❌ Failed to fetch data from Main Domain.");
}

// Clear old data in subdomain database
$conn->query("TRUNCATE TABLE registerlanding");

// Insert new data into subdomain database
foreach ($data as $row) {
    $stmt = $conn->prepare("INSERT INTO registerlanding (id, email, first_name, last_name, session_token) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $row['id'], $row['email'], $row['first_name'], $row['last_name'], $row['session_token']);
    $stmt->execute();
}

// ✅ Verify session token in subdomain database
$sql = "SELECT id, first_name, last_name FROM registerlanding WHERE email = ? AND session_token = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("❌ Query Preparation Failed: " . $conn->error);
}

$stmt->bind_param("ss", $email, $session_token);
if (!$stmt->execute()) {
    die(" Query Execution Failed: " . $stmt->error);
}

$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die(" Invalid session token or email!");
}

$row = $result->fetch_assoc();

// ✅ Set session in subdomain
$_SESSION['user_id'] = $row['id'];
$_SESSION['email'] = $email;
$_SESSION['first_name'] = $row['first_name'];
$_SESSION['last_name'] = $row['last_name'];
$_SESSION['role'] = 'guardian';
$_SESSION['session_token'] = $session_token;

// ✅ Redirect to dashboard
header("Location: dashboard.php");
exit();
?>