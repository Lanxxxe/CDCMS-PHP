<?php
session_start();
$pageTitle = "Teacher Dashboard";
// include '../includes/header.php';
require_once '../config/database.php';


include './includes/header.php';
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="../assets/css/user_navbar.css">

<?php 
include './includes/navbar.php';
include './includes/sidebar.php';
?>

<main role="main" class="main-content">
            
    <?php include_once './includes/notification.php' ?>


    <!-- Page Content Here -->
    <div class="container-fluid py-3">
        <!-- Welcome Section -->
        <div class="welcome-section">
            <h3 class="mb-0">Teacher Management</h3>
        </div>
        <div class="container-fluid px-4">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm mt-3">
                    <thead class="">
                        <tr class="text-center table-head-columns">
                            <th class="bg-primary text-white" scope="col">Position</th>
                            <th class="bg-primary text-white" scope="col">Teacher's Name</th>
                            <th class="bg-primary text-white" scope="col">Contact Number</th>
                            <th class="bg-primary text-white" scope="col">Schedule</th>
                            <th class="bg-primary text-white" scope="col">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>test</td>
                            <td>test</td>
                            <td>test</td>
                            <td>test</td>
                            <td>test</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>    
    </div>
</main>

<?php
include './includes/footer.php';

?>

