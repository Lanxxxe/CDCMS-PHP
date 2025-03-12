<?php
session_start();
$pageTitle = "Grades";
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

// Get student's grades
$stmt = $pdo->prepare("
    SELECT 
        s.student_id,
        CONCAT(s.firstName, ' ', s.lastName) as full_name,
        e1.evaluation_period as first_eval_period,
        e1.gross_motor_score + e1.fine_motor_score + e1.self_help_score + 
        e1.receptive_language_score + e1.expressive_language_score + 
        e1.cognitive_score + e1.socio_emotional_score as first_eval_ss,
        e2.evaluation_period as second_eval_period,
        e2.gross_motor_score + e2.fine_motor_score + e2.self_help_score + 
        e2.receptive_language_score + e2.expressive_language_score + 
        e2.cognitive_score + e2.socio_emotional_score as second_eval_ss,
        r.recommendation
    FROM students s
    LEFT JOIN evaluations e1 ON s.id = e1.student_id AND e1.evaluation_period = 'First'
    LEFT JOIN evaluations e2 ON s.id = e2.student_id AND e2.evaluation_period = 'Second'
    LEFT JOIN recommendations r ON s.id = r.student_id
    WHERE s.id = ?
");
$stmt->execute([$student_id]);
$students = $stmt->fetchAll();

include 'includes/sidebar.php';
?>

<div class="welcome-section">
    <h3 class="mb-0">Grades</h3>
</div>

<div class="container-fluid px-4">
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th class="bg-primary text-white" scope="col">Student ID</th>
                <th class="bg-primary text-white" scope="col">Full Name</th>
                <th class="bg-primary text-white" scope="col">1st Evaluation (SS)</th>
                <th class="bg-primary text-white" scope="col">2nd Evaluation (SS)</th>
                <th class="bg-primary text-white" scope="col">Recommendation</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
                <tr class="text-left">
                    <td><?php echo $student['student_id']; ?></td>
                    <td><?php echo $student['full_name']; ?></td>
                    <td><?php echo $student['first_eval_ss'] ? $student['first_eval_ss'] : '-'; ?></td>
                    <td><?php echo $student['second_eval_ss'] ? $student['second_eval_ss'] : '-'; ?></td>
                    <td><?php echo $student['recommendation'] ? $student['recommendation'] : '-'; ?></td>
                </tr>
            <?php endforeach; ?>
            
            <?php if (empty($students)): ?>
                <tr>
                    <td colspan="5" class="text-center">No student found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>

