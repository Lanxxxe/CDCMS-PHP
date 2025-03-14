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
// $email = 'daveprotacio48@gmail.com';
// $session_token = '3a1f4ea023c4747d8870060768215d478d1ff256f5fe3a58bbfddfa22d6f4be9';

// ✅ Fetch registerlanding data from Main Domain API
$api_url = "https://smartbarangayconnect.com/api_get_registerlanding.php";
$response = file_get_contents($api_url);
$data = json_decode($response, true);

if (!$data || !is_array($data)) {
    die("❌ Failed to fetch data from Main Domain.");
}

// ✅ Clear old data in subdomain database
$pdo->exec("TRUNCATE TABLE registerlanding");

// ✅ Insert new data into subdomain database
$sql = "INSERT INTO registerlanding 
    (id, email, first_name, last_name, session_token, picture_pic, birth_date, sex, mobile, working, occupation, house, street, barangay, city, password) 
    VALUES (:id, :email, :first_name, :last_name, :session_token, :picture_pic, :birth_date, :sex, :mobile, :working, :occupation, :house, :street, :barangay, :city, :password)";

$stmt = $pdo->prepare($sql);

foreach ($data as $row) {
    $stmt->execute([
        ':id' => $row['id'],
        ':email' => $row['email'],
        ':first_name' => $row['first_name'],
        ':last_name' => $row['last_name'],
        ':session_token' => $row['session_token'],
        ':picture_pic' => $row['picture_pic'] ?? null,
        ':birth_date' => $row['birth_date'],
        ':sex' => $row['sex'],
        ':mobile' => $row['mobile'],
        ':working' => $row['working'],
        ':occupation' => $row['occupation'],
        ':house' => $row['house'],
        ':street' => $row['street'],
        ':barangay' => $row['barangay'],
        ':city' => $row['city'],
        ':password' => $row['password']
    ]);
}


// ✅ Verify session token in subdomain database
$sql = "SELECT id, email, first_name, last_name, picture_pic, birth_date, sex, mobile, working, occupation, house, street, barangay, city 
        FROM registerlanding WHERE email = :email AND session_token = :session_token";
$stmt = $pdo->prepare($sql);
$stmt->execute([':email' => $email, ':session_token' => $session_token]);

$row = $stmt->fetch();

if (!$row) {
    die("❌ Invalid session token or email!");
}


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
header("Location: ./dashboard.php");
exit();
?>