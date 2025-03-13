<?php
session_start();
$pageTitle = "Teacher Dashboard";
// include '../includes/header.php';
require_once '../config/database.php';


// Get guardian name from form or URL parameters and convert to lowercase
// $guardianFirstName = isset($_POST['guardian_firstname']) ? strtolower(trim($_POST['guardian_firstname'])) : '';
// $guardianMiddleName = isset($_POST['guardian_middlename']) ? strtolower(trim($_POST['guardian_middlename'])) : '';
// $guardianLastName = isset($_POST['guardian_lastname']) ? strtolower(trim($_POST['guardian_lastname'])) : '';

$guardianFirstName ='Johnpaul';
$guardianMiddleName = 'Araceli';
$guardianLastName = 'Daniel';


// Redirect if required fields are empty
if (empty($guardianFirstName) || empty($guardianLastName)) {
    header("Location: index.php");
    exit();
}

// SQL query to fetch student details, evaluation scores, and recommendations
$sql = "SELECT 
            s.student_id,
            CONCAT(s.firstname, ' ', COALESCE(s.middlename, ''), ' ', s.lastname, ' ', COALESCE(s.suffix, '')) AS full_name,
            
            -- 1st Evaluation Total Score
            (SELECT COALESCE(SUM(gross_motor_score + fine_motor_score + self_help_score + receptive_language_score + expressive_language_score + cognitive_score + socio_emotional_score), 0)
             FROM student_evaluation 
             WHERE student_id = s.id AND evaluation_period = '1st') AS first_eval_score,

            -- 2nd Evaluation Total Score
            (SELECT COALESCE(SUM(gross_motor_score + fine_motor_score + self_help_score + receptive_language_score + expressive_language_score + cognitive_score + socio_emotional_score), 0)
             FROM student_evaluation 
             WHERE student_id = s.id AND evaluation_period = '2nd') AS second_eval_score,

            -- Recommendation (latest if available)
            (SELECT recommendation FROM recommendation 
             WHERE student_id = s.id 
             ORDER BY id DESC LIMIT 1) AS recommendation

        FROM 
            student s
        INNER JOIN 
            guardian_info g ON s.id = g.student_id
        WHERE 
            LOWER(g.firstname) LIKE LOWER(:firstname) AND
            (LOWER(g.middlename) LIKE LOWER(:middlename) OR (g.middlename IS NULL AND :middlename = '')) AND
            LOWER(g.lastname) LIKE LOWER(:lastname)
        ORDER BY 
            s.lastname, s.firstname";

$stmt = $pdo->prepare($sql);

// Bind parameters with wildcard search
$stmt->execute([
    'firstname' => "%$guardianFirstName%",
    'middlename' => "%$guardianMiddleName%",
    'lastname' => "%$guardianLastName%"
]);

$students = $stmt->fetchAll();

include './includes/header.php';
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="../assets/css/user_navbar.css">

<?php 
include './includes/navbar.php';
include './includes/sidebar.php';
?>

<main role="main" class="main-content">


    <!-- Page Content Here -->
    <div class="container-fluid py-3">
        <!-- Welcome Section -->
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
                    <?php if (!empty($students)): ?>
                        <?php foreach ($students as $student): ?>
                            <tr class="text-center">
                                <td><?= htmlspecialchars($student['student_id']) ?></td>
                                <td class="text-left"><?= htmlspecialchars($student['full_name']) ?></td>
                                <td><?= htmlspecialchars($student['first_eval_score']) ?></td>
                                <td><?= htmlspecialchars($student['second_eval_score']) ?></td>
                                <td class="text-left"><?= htmlspecialchars($student['recommendation'] ?? 'No recommendation') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No student found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>   
    </div>
</main>

<?php
include './includes/footer.php';

?>




