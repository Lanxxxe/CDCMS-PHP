<?php
session_start();
$pageTitle = "Attendance";
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

// Get attendance records for the student
$stmt = $pdo->prepare("
    SELECT a.date, a.status, s.student_id, s.firstName, s.lastName, s.middleName
    FROM attendance a
    JOIN students s ON a.student_id = s.id
    WHERE s.id = ?
    ORDER BY a.date DESC
");
$stmt->execute([$student_id]);
$attendance_records = $stmt->fetchAll();

include 'includes/sidebar.php';
?>

<div class="welcome-section">
    <h3 class="mb-0">Attendance</h3>
</div>

<div class="container-fluid px-4 mt-3">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-sm">
            <thead class="">
                <tr class="text-center table-head-columns">
                    <th class="bg-primary text-white" scope="col">Student ID</th>
                    <th class="bg-primary text-white" scope="col">Student Name</th>
                    <th class="bg-primary text-white" scope="col">Date</th>
                    <th class="bg-primary text-white" scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($attendance_records as $record): ?>
                    <tr>
                        <td class="px-2"><?php echo $record['student_id']; ?></td>
                        <td><?php echo $record['lastName'] . ', ' . $record['firstName'] . ' ' . $record['middleName']; ?></td>
                        <td><?php echo date('Y-m-d', strtotime($record['date'])); ?></td>
                        <td><?php echo $record['status']; ?></td>
                    </tr>
                <?php endforeach; ?>
                
                <?php if (empty($attendance_records)): ?>
                    <tr>
                        <td colspan="4" class="text-center">No attendance records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../includes/footer.php'; ?>

