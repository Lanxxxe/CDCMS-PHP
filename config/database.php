<?php
// Database configuration
$host = 'localhost';
$dbname = 'chil_cdcms_databases';
$username = 'childdev';
$password = 'Xal./XYo_p9UHcJ-';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}

