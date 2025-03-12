<?php
session_start();
$pageTitle = "Teacher Dashboard";
// include '../includes/header.php';
require_once '../config/database.php';
// require_once '../includes/functions.php';

// if (!isLoggedIn() || !hasRole('teacher')) {
//     header('Location: ../login.php');
//     exit;
// }

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
            <h3 class="mb-0">Student Management</h3>
        </div>

        <!-- Student Table -->
        <div class="container-fluid px-4">
            <!-- Filter Form -->
            <form method="GET" class="my-3">
                <label for="kinder_filter">Filter by Kinder Level:</label>
                <select name="kinder_level" id="kinder_filter" class="form-control w-auto d-inline">
                    <option value="">All</option>
                    <option value="K1">Kinder 1</option>
                    <option value="K2">Kinder 2</option>
                    <option value="K3">Kinder 3</option>
                </select>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm mt-3">
                    <thead>
                        <tr class="text-center table-head-columns">
                            <th class="bg-primary text-white">Student I.D.</th>
                            <th class="bg-primary text-white">Full Name</th>
                            <th class="bg-primary text-white">Guardian</th>
                            <th class="bg-primary text-white">Health History</th>
                            <th class="bg-primary text-white">Kinder Level</th>
                            <th class="bg-primary text-white">Requirements</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="">
                                    
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6" class="text-center">No students found.</td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination Controls -->
        <nav>
            <ul class="pagination justify-content-center">
                    <li class="page-item">
                        <a class="page-link" href="">&laquo; First</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="">Previous</a>
                    </li>

                <li class="page-item active">
                    <span class="page-link"></span>
                </li>

                    <li class="page-item">
                        <a class="page-link" href="">Next</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="">Last &raquo;</a>
                    </li>
            </ul>
        </nav>  
    </div>
</main>

<?php
include './includes/footer.php';

?>




