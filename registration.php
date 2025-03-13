<?php
// session_start();
$pageTitle = "Home";
include './includes/header.php';
require_once './config/database.php';
// require_once 'includes/functions.php';
?>

    <?php
        include './includes/navbar.php';
    ?>

    <main class="container mt-5">
        <div class="row">
            <div class="col-md-6 d-flex flex-column align-items-center justify-content-center bg-primary py-5" style="height: 100%;">
                <img src="./assets/images/cropMainCDC.png" class="img-fluid " alt="CDCMS Banner">
                <h4 class="text-center fw-bold text-white mt-5">CHILD DEVELOPMENT CENTER MANAGEMENT SYSTEM</h4>
            </div>
            <div class="col-md-6" >
                <div class="card shadow p-4 h-100 py-5">
                    <div class="text-center">
                        <img src="./assets/images/logo.png" alt="Logo" width="80">
                        <h4 class="mt-2">Login</h4>
                    </div>
                    <form>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" placeholder="Maria Theresa">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" placeholder="Juan">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" placeholder="Enter email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" placeholder="Enter password">
                        </div>
                        <button type="submit" class="btn btn-success w-100">Create</button>
                    </form>
                    <p class="text-center mt-3">Already have an account? <a href="./login.php">Login Here</a></p>
                </div>
            </div>
        </div>
    </main>
</div>
<?php include 'includes/footer.php'; ?>

