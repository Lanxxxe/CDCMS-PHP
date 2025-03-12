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
        <div class="welcome-section">
            <h3 class="mb-0">Requirements</h3>
        </div>

        <div class="container-fluid px-4 mt-3">
                <div class="card mb-3 py-4 d-flex align-items-center justify-content-center flex-column">
                        <img src="{{ value.image.url }}" class="card-img-top img-container img-fluid rounded mx-auto" 
                            style="height: 500px; width: 500px; object-fit: contain;" alt="{{ key }}">
                        <img src="{% static 'images/noDocument.jpg' %}" class="card-img-top img-container img-fluid rounded mx-auto"
                            style="height: 500px; width: 500px; object-fit: contain;" alt="No Document">
                    
                    <div class="card-body w-50 mt-3">
                    <div class="d-flex justify-content-between align-items-center pe-5">
                        <h5 class="card-title"></h5>
                                <div>
                                    <a href="{% url 'add_requirement' student_id key %}" class="btn btn-warning btn-sm"><i class="fa-solid fa-edit"></i> Update</a>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ forloop.counter }}">
                                            <i class="fa-solid fa-trash"></i> Delete
                                        </button>
                                </div>  
                                <a href="{% url 'add_requirement' student_id key %}" class="btn btn-success">Add</a>
                        </div>
                    </div>
                </div>

                <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteModal{{ forloop.counter }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ forloop.counter }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="deleteModalLabel{{ forloop.counter }}">Delete {{ value.name }}?</h3>
                                    <button type="button" class="btn-close border-0" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>
                                        Are you sure you want to delete this {{ value.name }}?
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <a href="{% url 'delete_requirement' student_id key %}" class="btn btn-danger">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
    </div>
</main>

<?php
include './includes/footer.php';

?>




