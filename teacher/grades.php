<?php
session_start();
$pageTitle = "Grades";
include '../includes/header.php';
require_once '../config/database.php';
require_once '../includes/functions.php';

if (!isLoggedIn() || !hasRole('teacher')) {
    header('Location: ../login.php');
    exit;
}

include 'includes/sidebar.php';

// Add your grade management content here

include '../includes/footer.php';

