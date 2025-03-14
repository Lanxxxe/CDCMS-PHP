<?php
session_start();
$pageTitle = "Teacher Dashboard";
// include '../includes/header.php';
require_once '../config/database.php';


// Get guardian name from form or URL parameters
// $guardianFirstName = isset($_POST['guardian_firstname']) ? strtolower(trim($_POST['guardian_firstname'])) : '';
// $guardianMiddleName = isset($_POST['guardian_middlename']) ? strtolower(trim($_POST['guardian_middlename'])) : '';
// $guardianLastName = isset($_POST['guardian_lastname']) ? strtolower(trim($_POST['guardian_lastname'])) : '';

$guardianFirstName = $_SESSION['first_name'] ?? '';
$guardianMiddleName = $_SESSION['middle_name'] ?? '';
$guardianLastName = $_SESSION['last_name'] ?? '';

// $guardianFirstName ='Johnpaul';
// $guardianMiddleName = 'Araceli';
// $guardianLastName = 'Daniel';

// Redirect if required fields are empty
if (empty($guardianFirstName) || empty($guardianLastName)) {
    header("Location: index.php");
    exit();
}

// Prepare the SQL statement
$sql = "SELECT 
            s.student_id AS student_id,
            CONCAT(s.firstname, ' ', COALESCE(s.middlename, ''), ' ', s.lastname, ' ', COALESCE(s.suffix, '')) AS student_name,
            DATE_FORMAT(a.date, '%M %d, %Y') AS date,
            a.status AS status
        FROM 
            attendance a
        INNER JOIN 
            student s ON a.student_id = s.id
        INNER JOIN 
            guardian_info g ON s.id = g.student_id
        WHERE 
            LOWER(g.firstname) LIKE LOWER(:firstname) AND
            (LOWER(g.middlename) LIKE LOWER(:middlename) OR (g.middlename IS NULL AND :middlename = '')) AND
            LOWER(g.lastname) LIKE LOWER(:lastname)
        ORDER BY 
            a.date DESC";

$stmt = $pdo->prepare($sql);

// Bind parameters with wildcard search
$stmt->execute([
    'firstname' => "%$guardianFirstName%",
    'middlename' => "%$guardianMiddleName%",
    'lastname' => "%$guardianLastName%"
]);

$attendanceRecords = $stmt->fetchAll();



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
        <div class="welcome-section">
            <h3 class="mb-0">Attendance</h3>
        </div>


        <?php if (!empty($attendanceRecords)): ?>
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
                        <?php foreach ($attendanceRecords as $record): ?>
                                <tr>
                                    <td class="px-2 text-center"><?= htmlspecialchars($record['student_id']) ?></td>
                                    <td><?= htmlspecialchars($record['student_name']) ?></td>
                                    <td class="text-center"><?= htmlspecialchars($record['date']) ?></td>
                                    <td class="text-center"><?= htmlspecialchars($record['status']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>  
        <?php else: ?>
            <div class="container-fluid px-4 mt-5">
                <div class="card shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-exclamation-circle text-warning" style="font-size: 4rem;"></i>
                        <h4 class="mt-3">No Attendance available</h4>
                        <p class="text-muted">Please contact the administrator if you believe this is an error.</p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php
include './includes/footer.php';

?>




