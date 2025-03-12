<?php
session_start();
$pageTitle = "Requirements";
include '../includes/header.php';
require_once '../config/database.php';
require_once '../includes/functions.php';

if (!isLoggedIn() || !hasRole('guardian')) {
    header('Location: ../login.php');
    exit;
}

// Get guardian's student ID
$guardian_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT student_id FROM guardians WHERE user_id = ?");
$stmt->execute([$guardian_id]);
$student_id = $stmt->fetchColumn();

if (!$student_id) {
    displayAlert("No student found for this guardian", "danger");
    header('Location: announcement.php');
    exit;
}

// Get student's requirements
$stmt = $pdo->prepare("SELECT * FROM requirements WHERE student_id = ?");
$stmt->execute([$student_id]);
$requirements_data = $stmt->fetch();

// Define requirements structure
$requirements = [
    'psa' => [
        'name' => 'PSA Birth Certificate',
        'image' => null
    ],
    'immunization_card' => [
        'name' => 'Immunization Card',
        'image' => null
    ],
    'recent_photo' => [
        'name' => 'Recent Photo',
        'image' => null
    ],
    'guardian_qcid' => [
        'name' => 'Guardian QC ID',
        'image' => null
    ]
];

// Required fields that cannot be deleted
$exclude_keys = ['psa', 'guardian_qcid'];

// Populate requirements with actual data
if ($requirements_data) {
    foreach ($requirements as $key => $value) {
        if (!empty($requirements_data[$key])) {
            $requirements[$key]['image'] = [
                'url' => '../uploads/' . $requirements_data[$key]
            ];
        }
    }
}

include 'includes/sidebar.php';
?>

<div class="welcome-section">
    <h3 class="mb-0">Requirements</h3>
</div>

<div class="container-fluid px-4 mt-3">
    <?php $counter = 0; foreach ($requirements as $key => $value): $counter++; ?>
        <div class="card mb-3 py-4 d-flex align-items-center justify-content-center flex-column">
            <?php if (isset($value['image']) && $value['image']): ?>
                <img src="<?php echo $value['image']['url']; ?>" class="card-img-top img-container img-fluid rounded mx-auto" 
                    style="height: 500px; width: 500px; object-fit: contain;" alt="<?php echo $key; ?>">
            <?php else: ?>
                <img src="../assets/images/noDocument.jpg" class="card-img-top img-container img-fluid rounded mx-auto"
                    style="height: 500px; width: 500px; object-fit: contain;" alt="No Document">
            <?php endif; ?>
            
            <div class="card-body w-50 mt-3">
                <div class="d-flex justify-content-between align-items-center pe-5">
                    <h5 class="card-title"><?php echo $value['name']; ?></h5>
                    <?php if (isset($value['image']) && $value['image']): ?>
                        <div>
                            <a href="add_requirement.php?student_id=<?php echo $student_id; ?>&type=<?php echo $key; ?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-edit"></i> Update</a>
                            <?php if (!in_array($key, $exclude_keys)): ?>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $counter; ?>">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </button>
                            <?php endif; ?>
                        </div>  
                    <?php else: ?>
                        <a href="add_requirement.php?student_id=<?php echo $student_id; ?>&type=<?php echo $key; ?>" class="btn btn-success">Add</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <?php if (isset($value['image']) && $value['image'] && !in_array($key, $exclude_keys)): ?>
            <div class="modal fade" id="deleteModal<?php echo $counter; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo $counter; ?>" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="deleteModalLabel<?php echo $counter; ?>">Delete <?php echo $value['name']; ?>?</h3>
                            <button type="button" class="btn-close border-0" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>
                                Are you sure you want to delete this <?php echo $value['name']; ?>?
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <a href="delete_requirement.php?student_id=<?php echo $student_id; ?>&type=<?php echo $key; ?>" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

<?php include '../includes/footer.php'; ?>

