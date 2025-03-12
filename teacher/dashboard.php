<?php
session_start();
$pageTitle = "Teacher Dashboard";
include '../includes/header.php';
require_once '../config/database.php';
require_once '../includes/functions.php';

if (!isLoggedIn() || !hasRole('teacher')) {
    header('Location: ../login.php');
    exit;
}

include 'includes/sidebar.php';

// Add your teacher dashboard content here

include '../includes/footer.php';

