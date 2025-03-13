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
            
    <!--For Notification header naman ito-->
    <!-- <div class="modal fade modal-notif modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="defaultModalLabel">Notifications</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <div class="list-group list-group-flush my-n3">
                <div class="col-12 mb-4">
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="notification">
                    <img class="fade show" src="{% static '/images/unified-lgu-logo.png' %}" width="35" height="35">
                    <strong style="font-size:12px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"></strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="removeNotification()">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                </div>

            <div id="no-notifications" style="display: none; text-align:center; margin-top:10px;">
                No notifications
            </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-block" onclick="clearAllNotifications()">Clear All</button>
        </div>
        </div>
    </div>
    </div> -->


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
                        <tr class="text-left">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-center">No student found</td>
                        </tr>
                </tbody>
            </table>
        </div>   
    </div>
</main>

<?php
include './includes/footer.php';

?>




