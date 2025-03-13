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
        <div class="welcome-section mb-5">
            <h3 class="mb-0">Announcement</h3>
        </div>

        <div class="container-fluid px-4">
        <div class="card mb-3 p-5 d-flex align-items-center flex-column justify-content-center">
            <img class="card-img-top mx-auto img-fluid rounded" style="max-height: 500px; max-width: 500px; object-fit:contain;"  src="/asEASdwaSEAdWas/{{ announcement.picture}}" alt="{{ announcement.title }}">
            <div class="card-body mt-2 w-75">
                <h5 class="card-title"></h5>
                <p class="card-text"></p>
                <p class="card-text"><small class="text-body-secondary"></small></p>
            </div>
        </div>
            
        </div>    
    </div>
</main>

<?php
include './includes/footer.php';

?>




