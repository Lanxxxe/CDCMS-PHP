<?php
session_start();
$pageTitle = "Guardian Management";
include '../includes/header.php';
require_once '../config/database.php';
require_once '../includes/functions.php';

if (!isLoggedIn() || !hasRole('teacher')) {
    header('Location: ../login.php');
    exit;
}

include 'includes/sidebar.php';

// Add your guardian management content here

include '../includes/footer.php';

