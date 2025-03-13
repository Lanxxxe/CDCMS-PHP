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

// Pagination settings
$itemsPerPage = 5; // Number of announcements per page
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($currentPage < 1) $currentPage = 1;
$offset = ($currentPage - 1) * $itemsPerPage;

// Count total announcements for pagination
$countQuery = "SELECT COUNT(*) as total FROM announcement";
$stmt = $pdo->prepare($countQuery);
$stmt->execute();
$totalItems = $stmt->fetchColumn();
$totalPages = ceil($totalItems / $itemsPerPage);

// Ensure current page doesn't exceed total pages
if ($currentPage > $totalPages && $totalPages > 0) {
    $currentPage = $totalPages;
    $offset = ($currentPage - 1) * $itemsPerPage;
}

// Get announcements
$query = "SELECT * FROM announcement  
          ORDER BY date_posted DESC 
          LIMIT :limit OFFSET :offset";
$stmt = $pdo->prepare($query);
$stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$announcements = $stmt->fetchAll();

// Function to format date
function formatDate($dateString) {
    $date = new DateTime($dateString);
    return $date->format('F j, Y');
}

// Build pagination URL
function buildPaginationUrl($page) {
    return '?page=' . $page;
}


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
            <h3 class="mb-0">Announcements</h3>
        </div>

        <div class="container-fluid px-4">
            <?php if (count($announcements) > 0): ?>
                <?php foreach ($announcements as $announcement): ?>
                    <div class="card mb-5 p-4 d-flex align-items-center flex-column justify-content-center shadow-sm">
                        <?php if (!empty($announcement['picture'])): ?>
                            <img class="card-img-top mx-auto img-fluid rounded" 
                                 style="max-height: 500px; max-width: 500px; object-fit:contain;" 
                                 src="../uploads/announcements/<?php echo htmlspecialchars($announcement['picture']); ?>" 
                                 alt="<?php echo htmlspecialchars($announcement['title']); ?>">
                        <?php endif; ?>
                        <div class="card-body mt-3 w-75">
                            <h4 class="card-title text-center fw-bold"><?php echo htmlspecialchars($announcement['title']); ?></h4>
                            <p class="card-text mt-5"><?php echo nl2br(htmlspecialchars($announcement['description'])); ?></p>
                            <p class="card-text text-end">
                                <small class="text-body-secondary">
                                    Posted on <?php echo formatDate($announcement['date_posted']); ?>
                                </small>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
                
                <!-- Pagination Controls -->
                <?php if ($totalPages > 1): ?>
                <nav aria-label="Announcement pagination" class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?php echo $currentPage <= 1 ? 'disabled' : ''; ?>">
                            <a class="page-link" href="<?php echo buildPaginationUrl(1); ?>">&laquo; First</a>
                        </li>
                        <li class="page-item <?php echo $currentPage <= 1 ? 'disabled' : ''; ?>">
                            <a class="page-link" href="<?php echo buildPaginationUrl($currentPage - 1); ?>">Previous</a>
                        </li>

                        <?php
                        $startPage = max(1, $currentPage - 2);
                        $endPage = min($totalPages, $currentPage + 2);
                        
                        for ($i = $startPage; $i <= $endPage; $i++):
                        ?>
                            <li class="page-item <?php echo $i === $currentPage ? 'active' : ''; ?>">
                                <?php if ($i === $currentPage): ?>
                                    <span class="page-link"><?php echo $i; ?></span>
                                <?php else: ?>
                                    <a class="page-link" href="<?php echo buildPaginationUrl($i); ?>"><?php echo $i; ?></a>
                                <?php endif; ?>
                            </li>
                        <?php endfor; ?>

                        <li class="page-item <?php echo $currentPage >= $totalPages ? 'disabled' : ''; ?>">
                            <a class="page-link" href="<?php echo buildPaginationUrl($currentPage + 1); ?>">Next</a>
                        </li>
                        <li class="page-item <?php echo $currentPage >= $totalPages ? 'disabled' : ''; ?>">
                            <a class="page-link" href="<?php echo buildPaginationUrl($totalPages); ?>">Last &raquo;</a>
                        </li>
                    </ul>
                </nav>
                <?php endif; ?>
                
            <?php else: ?>
                <div class="alert alert-info text-center">
                    <i class="fa-solid fa-info-circle me-2"></i> No announcements available at this time.
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php
include './includes/footer.php';

?>




