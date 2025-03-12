<?php
session_start();
$pageTitle = "Teacher's Profile";
include '../includes/header.php';
require_once '../config/database.php';
require_once '../includes/functions.php';

if (!isLoggedIn() || !hasRole('guardian')) {
    header('Location: ../login.php');
    exit;
}

// Get guardian's student ID
$guardian_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT student_id FROM guardians WHERE user_id = ?");
$stmt->execute([$guardian_id]);
$student_id = $stmt->fetchColumn();

if (!$student_id) {
    displayAlert("No student found for this guardian", "danger");
    header('Location: announcement.php');
    exit;
}

// Get student's teacher information
// This is a placeholder - in a real application, you would have a proper teacher-student relationship
$stmt = $pdo->prepare("
    SELECT t.name, t.contact_number, t.schedule, t.role
    FROM teachers t
    JOIN class_assignments ca ON t.id = ca.teacher_id
    WHERE ca.student_id = ?
");
$stmt->execute([$student_id]);
$teacher = $stmt->fetch();

include 'includes/sidebar.php';
?>

<div class="welcome-section">
    <h3 class="mb-0">Teacher's Profile</h3>
</div>

<div class="container-fluid px-4">
    <div class="d-flex align-items-center justify-content-center gap-5">
        <img class="rounded img-fluid" src="../assets/images/female.jpg" alt="">
        <div>
            <h4 class="fw-bold">Adviser</h4>
            <p class="mb-1">Name: <?php echo $teacher['name'] ?? 'Not assigned'; ?></p>
            <p class="mb-1">Contact Number: <?php echo $teacher['contact_number'] ?? 'Not available'; ?></p>
            <p class="mb-1">Schedule: <?php echo $teacher['schedule'] ?? 'Not available'; ?></p>
            <p class="mb-1">Role: <?php echo $teacher['role'] ?? 'Teacher'; ?></p>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>

