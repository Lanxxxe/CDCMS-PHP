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

// ✅ Fetch registerlanding data from Main Domain API
$api_url = "https://smartbarangayconnect.com/api_get_registerlanding.php";
$response = file_get_contents($api_url);
$data = json_decode($response, true);

if (!$data || !is_array($data)) {
    die("❌ Failed to fetch data from Main Domain.");
}

// ✅ Clear old data in subdomain database
$conn->query("TRUNCATE TABLE registerlanding");

// ✅ Insert new data into subdomain database (Now includes additional fields)
$stmt = $conn->prepare("INSERT INTO registerlanding 
    (id, email, first_name, last_name, session_token, picture_pic, birth_date, sex, mobile, working, occupation, house, street, barangay, city) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    die("❌ Query Preparation Failed: " . $conn->error);
}

foreach ($data as $row) {
    $picture_pic = !empty($row['picture_pic']) ? $row['picture_pic'] : null;

    $stmt->bind_param("issssssssssssss", 
        $row['id'], $row['email'], $row['first_name'], $row['last_name'], $row['session_token'], $picture_pic,
        $row['birth_date'], $row['sex'], $row['mobile'], $row['working'], $row['occupation'],
        $row['house'], $row['street'], $row['barangay'], $row['city']
    );
    $stmt->execute();
}

// ✅ Verify session token in subdomain database (Now selects all fields)
$sql = "SELECT id, email, first_name, last_name, picture_pic, birth_date, sex, mobile, working, occupation, house, street, barangay, city 
        FROM registerlanding WHERE email = ? AND session_token = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("❌ Query Preparation Failed: " . $conn->error);
}

$stmt->bind_param("ss", $email, $session_token);
if (!$stmt->execute()) {
    die("❌ Query Execution Failed: " . $stmt->error);
}

$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("❌ Invalid session token or email!");
}

$row = $result->fetch_assoc();

// ✅ Store all data in session
$_SESSION['id'] = $row['id'];
$_SESSION['email'] = $email;
$_SESSION['first_name'] = $row['first_name'];
$_SESSION['last_name'] = $row['last_name'];
$_SESSION['session_token'] = $session_token;
$_SESSION['picture_pic'] = !empty($row['picture_pic']) ? $row['picture_pic'] : 'https://smartbarangayconnect.com/uploads/default-profile.png';

//  Additional session data
$_SESSION['birth_date'] = $row['birth_date'];
$_SESSION['sex'] = $row['sex'];
$_SESSION['mobile'] = $row['mobile'];
$_SESSION['working'] = $row['working'];
$_SESSION['occupation'] = $row['occupation'];
$_SESSION['house'] = $row['house'];
$_SESSION['street'] = $row['street'];
$_SESSION['barangay'] = $row['barangay'];
$_SESSION['city'] = $row['city'];

// ✅ Debugging: Uncomment to check if session data is correct before redirecting
// var_dump($_SESSION);
// exit();

// ✅ Redirect to dashboard
header("Location: user/dashboard.php");
exit();
?>