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
    <div class="modal fade modal-notif modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
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
            </div>
        </div>
    </div>


    <!-- Page Content Here -->
    <div class="container-fluid py-3">
        <!-- Welcome Section -->
        <div class="welcome-section">
            <h3 class="mb-0">A.I. Recommendation</h3>
        </div>

        <div class="container-fluid px-4 mt-3">
            <form method="get" action="{% url 'ai_recommendation' %}">
                <div class="row">
                    <div class="col-md-4">
                        <label for="kinder_level">Kinder Level:</label>
                        <select name="kinder_level" id="kinder_level" class="form-control">
                            <option value="">All</option>
                                <option value="{{ level }}" {% if level == selected_kinder_level %}selected{% endif %}>{{ level }}</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary mt-4">Filter</button>
                    </div>
                </div>
            </form>

            <div class="table-responsive mt-3">
                <table class="table table-bordered table-striped table-sm mt-3">
                    <thead>
                        <tr>
                            <th class="bg-primary text-white" scope="col">Student ID</th>
                            <th class="bg-primary text-white" scope="col">Kinder Level</th>
                            <th class="bg-primary text-white" scope="col">Full Name</th>
                            <th class="bg-primary text-white" scope="col">1st Recommendation</th>
                            <th class="bg-primary text-white" scope="col">2nd Recommendation</th>
                        </tr>
                    </thead>
                    <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                        <tr>
                            <td class="text-center" colspan="5">No data available</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="container px-4 mt-3 d-flex align-items-center justify-content-center">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="?page=1&kinder_level={{ selected_kinder_level }}&semester={{ selected_semester }}" aria-label="First">
                                    <span aria-hidden="true">&laquo;&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="?page={{ page_students.previous_page_number }}&kinder_level={{ selected_kinder_level }}&semester={{ selected_semester }}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>

                        <li class="page-item disabled">
                            <span class="page-link">
                            </span>
                        </li>

                            <li class="page-item">
                                <a class="page-link" href="?page={{ page_students.next_page_number }}&kinder_level={{ selected_kinder_level }}&semester={{ selected_semester }}" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="?page={{ page_students.paginator.num_pages }}&kinder_level={{ selected_kinder_level }}&semester={{ selected_semester }}" aria-label="Last">
                                    <span aria-hidden="true">&raquo;&raquo;</span>
                                </a>
                            </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</main>

<?php
include './includes/footer.php';

?>


