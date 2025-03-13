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
        <div class="welcome-section d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Grades</h3>
            <form class="mr-3" method="get">
                <label for="kinder_level">Filter by Kinder Level:</label>
                <select name="kinder_level" id="kinder_level" onchange="this.form.submit()">
                    <option value="">All Levels</option>
                        <option value="" >
                        </option>
                </select>
            </form>
        </div>

        <div class="container-fluid px-4">

            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th class="bg-primary text-white" scope="col">Student ID</th>
                        <th class="bg-primary text-white" scope="col">Kinder Level</th>
                        <th class="bg-primary text-white" scope="col">Full Name</th>
                        <th class="bg-primary text-white" scope="col">1st Evaluation (SS)</th>
                        <th class="bg-primary text-white" scope="col">2nd Evaluation (SS)</th>
                        <th class="bg-primary text-white" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                
                            </td>
                            <td>
                        
                            </td>
                            <td>
                                <a href="{% url 'view_student_grades' student_data.student.student_id %}" class="btn btn-success btn-sm">
                                    <i class="fa-solid fa-eye"></i> View
                                </a>
                                <a href="{% url 'update_student_grades' student_data.student.student_id %}" class="btn btn-primary btn-sm">
                                    <i class="fa-solid fa-edit"></i> Update
                                </a>
                            </td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php
include './includes/footer.php';

?>




