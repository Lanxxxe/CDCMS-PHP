<?php
session_start();
$pageTitle = "Announcement";
include '../includes/header.php';
require_once '../config/database.php';
require_once '../includes/functions.php';

if (!isLoggedIn() || !hasRole('guardian')) {
    header('Location: ../login.php');
    exit;
}

// Get all announcements
$stmt = $pdo->query("SELECT * FROM announcements ORDER BY upload_date DESC");
$announcements = $stmt->fetchAll();

include 'includes/sidebar.php';
?>

<div class="welcome-section mb-5">
    <h3 class="mb-0">Announcement</h3>
</div>

<div class="container-fluid px-4">
    <?php foreach ($announcements as $announcement): ?>
        <div class="card mb-3 p-5 d-flex align-items-center flex-column justify-content-center">
            <?php if (!empty($announcement['picture'])): ?>
                <img class="card-img-top mx-auto img-fluid rounded" style="max-height: 500px; max-width: 500px; object-fit:contain;" src="../uploads/<?php echo $announcement['picture']; ?>" alt="<?php echo $announcement['title']; ?>">
            <?php endif; ?>
            <div class="card-body mt-2 w-75">
                <h5 class="card-title"><?php echo $announcement['title']; ?></h5>
                <p class="card-text"><?php echo $announcement['description']; ?></p>
                <p class="card-text"><small class="text-body-secondary"><?php echo $announcement['upload_date']; ?></small></p>
            </div>
        </div>
    <?php endforeach; ?>
    
    <?php if (empty($announcements)): ?>
        <div class="alert alert-info">No announcements available at this time.</div>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>

