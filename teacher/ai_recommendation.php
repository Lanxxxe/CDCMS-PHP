<?php
session_start();
$pageTitle = "AI Recommendation";
include '../includes/header.php';
require_once '../config/database.php';
require_once '../includes/functions.php';

if (!isLoggedIn() || !hasRole('teacher')) {
    header('Location: ../login.php');
    exit;
}

include 'includes/sidebar.php';

// Get kinder levels for filter
$stmt = $pdo->query("SELECT DISTINCT schedule FROM enrollment ORDER BY schedule");
$kinder_levels = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Get selected kinder level from filter
$selected_kinder_level = $_GET['kinder_level'] ?? '';

// Add your AI recommendation content here

include '../includes/footer.php';

