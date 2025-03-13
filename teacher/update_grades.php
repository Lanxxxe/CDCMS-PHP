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

// Initialize variables
$message = '';
$messageType = '';
$showAlert = false;

// Check if ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: grades.php");
    exit;
}

$studentId = (int)$_GET['id'];

// Get student information
$query = "SELECT s.id, s.student_id as student_number, 
          CONCAT(s.firstname, ' ', IFNULL(s.middlename, ''), ' ', s.lastname, ' ', IFNULL(s.suffix, '')) AS full_name,
          e.schedule as kinder_level
          FROM student s
          JOIN enrollment e ON s.id = e.student_id
          WHERE s.id = :id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id', $studentId, PDO::PARAM_INT);
$stmt->execute();
$student = $stmt->fetch();

// If student not found, redirect back to list
if (!$student) {
    header("Location: grades.php");
    exit;
}

// Get first evaluation scores
$query = "SELECT * FROM student_evaluation 
          WHERE student_id = :student_id AND evaluation_period = 'First'";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':student_id', $studentId, PDO::PARAM_INT);
$stmt->execute();
$firstEvaluation = $stmt->fetch();

// Get second evaluation scores
$query = "SELECT * FROM student_evaluation 
          WHERE student_id = :student_id AND evaluation_period = 'Second'";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':student_id', $studentId, PDO::PARAM_INT);
$stmt->execute();
$secondEvaluation = $stmt->fetch();

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Get form data
        $evaluationPeriod = $_POST['evaluation_period'];
        $grossMotorScore = (int)$_POST['gross_motor_score'];
        $fineMotorScore = (int)$_POST['fine_motor_score'];
        $selfHelpScore = (int)$_POST['self_help_score'];
        $receptiveLanguageScore = (int)$_POST['receptive_language_score'];
        $expressiveLanguageScore = (int)$_POST['expressive_language_score'];
        $cognitiveScore = (int)$_POST['cognitive_score'];
        $socioEmotionalScore = (int)$_POST['socio_emotional_score'];
        
        // Basic validation
        if ($grossMotorScore < 0 || $fineMotorScore < 0 || $selfHelpScore < 0 || 
            $receptiveLanguageScore < 0 || $expressiveLanguageScore < 0 || 
            $cognitiveScore < 0 || $socioEmotionalScore < 0) {
            throw new Exception("All scores must be non-negative numbers");
        }
        
        // Begin transaction
        $pdo->beginTransaction();
        
        // Check if evaluation record already exists
        $query = "SELECT id FROM student_evaluation 
                  WHERE student_id = :student_id AND evaluation_period = :evaluation_period";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':student_id', $studentId, PDO::PARAM_INT);
        $stmt->bindParam(':evaluation_period', $evaluationPeriod);
        $stmt->execute();
        $existingEvaluation = $stmt->fetch();
        
        if ($existingEvaluation) {
            // Update existing record
            $query = "UPDATE student_evaluation SET 
                      gross_motor_score = :gross_motor_score,
                      fine_motor_score = :fine_motor_score,
                      self_help_score = :self_help_score,
                      receptive_language_score = :receptive_language_score,
                      expressive_language_score = :expressive_language_score,
                      cognitive_score = :cognitive_score,
                      socio_emotional_score = :socio_emotional_score
                      WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':gross_motor_score', $grossMotorScore, PDO::PARAM_INT);
            $stmt->bindParam(':fine_motor_score', $fineMotorScore, PDO::PARAM_INT);
            $stmt->bindParam(':self_help_score', $selfHelpScore, PDO::PARAM_INT);
            $stmt->bindParam(':receptive_language_score', $receptiveLanguageScore, PDO::PARAM_INT);
            $stmt->bindParam(':expressive_language_score', $expressiveLanguageScore, PDO::PARAM_INT);
            $stmt->bindParam(':cognitive_score', $cognitiveScore, PDO::PARAM_INT);
            $stmt->bindParam(':socio_emotional_score', $socioEmotionalScore, PDO::PARAM_INT);
            $stmt->bindParam(':id', $existingEvaluation['id'], PDO::PARAM_INT);
            $stmt->execute();
        } else {
            // Insert new record
            $query = "INSERT INTO student_evaluation 
                      (student_id, evaluation_period, gross_motor_score, fine_motor_score, 
                       self_help_score, receptive_language_score, expressive_language_score, 
                       cognitive_score, socio_emotional_score) 
                      VALUES 
                      (:student_id, :evaluation_period, :gross_motor_score, :fine_motor_score, 
                       :self_help_score, :receptive_language_score, :expressive_language_score, 
                       :cognitive_score, :socio_emotional_score)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':student_id', $studentId, PDO::PARAM_INT);
            $stmt->bindParam(':evaluation_period', $evaluationPeriod);
            $stmt->bindParam(':gross_motor_score', $grossMotorScore, PDO::PARAM_INT);
            $stmt->bindParam(':fine_motor_score', $fineMotorScore, PDO::PARAM_INT);
            $stmt->bindParam(':self_help_score', $selfHelpScore, PDO::PARAM_INT);
            $stmt->bindParam(':receptive_language_score', $receptiveLanguageScore, PDO::PARAM_INT);
            $stmt->bindParam(':expressive_language_score', $expressiveLanguageScore, PDO::PARAM_INT);
            $stmt->bindParam(':cognitive_score', $cognitiveScore, PDO::PARAM_INT);
            $stmt->bindParam(':socio_emotional_score', $socioEmotionalScore, PDO::PARAM_INT);
            $stmt->execute();
        }
        
        // Generate AI recommendation
        $totalScore = $grossMotorScore + $fineMotorScore + $selfHelpScore + 
                      $receptiveLanguageScore + $expressiveLanguageScore + 
                      $cognitiveScore + $socioEmotionalScore;
        
        // Call the recommendation generator API
        $recommendation = generateAIRecommendation(
            $student['full_name'],
            $student['kinder_level'],
            $evaluationPeriod,
            $grossMotorScore,
            $fineMotorScore,
            $selfHelpScore,
            $receptiveLanguageScore,
            $expressiveLanguageScore,
            $cognitiveScore,
            $socioEmotionalScore,
            $totalScore
        );
        
        // Save recommendation to database
        $query = "SELECT id FROM recommendation 
                  WHERE student_id = :student_id AND evaluation_period = :evaluation_period";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':student_id', $studentId, PDO::PARAM_INT);
        $stmt->bindParam(':evaluation_period', $evaluationPeriod);
        $stmt->execute();
        $existingRecommendation = $stmt->fetch();
        
        if ($existingRecommendation) {
            // Update existing recommendation
            $query = "UPDATE recommendation SET 
                      recommendation = :recommendation
                      WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':recommendation', $recommendation);
            $stmt->bindParam(':id', $existingRecommendation['id'], PDO::PARAM_INT);
            $stmt->execute();
        } else {
            // Insert new recommendation
            $query = "INSERT INTO recommendation 
                      (student_id, evaluation_period, recommendation) 
                      VALUES 
                      (:student_id, :evaluation_period, :recommendation)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':student_id', $studentId, PDO::PARAM_INT);
            $stmt->bindParam(':evaluation_period', $evaluationPeriod);
            $stmt->bindParam(':recommendation', $recommendation);
            $stmt->execute();
        }
        
        // Commit transaction
        $pdo->commit();
        
        // Set success message
        $message = "Grades for " . $evaluationPeriod . " evaluation period updated successfully!";
        $messageType = "success";
        $showAlert = true;
        
        // Refresh data
        if ($evaluationPeriod === '1st') {
            // Refresh first evaluation data
            $query = "SELECT * FROM student_evaluation 
                      WHERE student_id = :student_id AND evaluation_period = '1st'";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':student_id', $studentId, PDO::PARAM_INT);
            $stmt->execute();
            $firstEvaluation = $stmt->fetch();
        } else {
            // Refresh second evaluation data
            $query = "SELECT * FROM student_evaluation 
                      WHERE student_id = :student_id AND evaluation_period = '2nd'";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':student_id', $studentId, PDO::PARAM_INT);
            $stmt->execute();
            $secondEvaluation = $stmt->fetch();
        }
        
    } catch (Exception $e) {
        // Rollback transaction on error
        $pdo->rollBack();
        
        $message = "Error: " . $e->getMessage();
        $messageType = "error";
        $showAlert = true;
    }
}

// Function to generate AI recommendation using Gemini API
function generateAIRecommendation($studentName, $kinderLevel, $evaluationPeriod, 
                                 $grossMotorScore, $fineMotorScore, $selfHelpScore, 
                                 $receptiveLanguageScore, $expressiveLanguageScore, 
                                 $cognitiveScore, $socioEmotionalScore, $totalScore) {
    
    // In a real implementation, you would call the Gemini API here
    // For this example, we'll simulate a response based on the scores
    
    $areas = [];
    $strengths = [];
    
    // Identify areas of strength and improvement
    if ($grossMotorScore < 7) $areas[] = "gross motor skills";
    else $strengths[] = "gross motor skills";
    
    if ($fineMotorScore < 7) $areas[] = "fine motor skills";
    else $strengths[] = "fine motor skills";
    
    if ($selfHelpScore < 7) $areas[] = "self-help skills";
    else $strengths[] = "self-help skills";
    
    if ($receptiveLanguageScore < 7) $areas[] = "receptive language";
    else $strengths[] = "receptive language";
    
    if ($expressiveLanguageScore < 7) $areas[] = "expressive language";
    else $strengths[] = "expressive language";
    
    if ($cognitiveScore < 7) $areas[] = "cognitive skills";
    else $strengths[] = "cognitive skills";
    
    if ($socioEmotionalScore < 7) $areas[] = "socio-emotional skills";
    else $strengths[] = "socio-emotional skills";
    
    // Generate recommendation
    $recommendation = "Evaluation Report for $studentName ($kinderLevel) - $evaluationPeriod Evaluation Period\n\n";
    
    $recommendation .= "Overall Assessment:\n";
    if ($totalScore >= 40) {
        $recommendation .= "The student is showing excellent progress across most developmental areas. ";
    } elseif ($totalScore >= 30) {
        $recommendation .= "The student is showing good progress in many developmental areas. ";
    } else {
        $recommendation .= "The student needs additional support in several developmental areas. ";
    }
    
    if (!empty($strengths)) {
        $recommendation .= "\n\nStrengths:\n";
        $recommendation .= "The student demonstrates strong abilities in " . implode(", ", $strengths) . ". ";
        $recommendation .= "Continue to provide opportunities to further develop these skills.";
    }
    
    if (!empty($areas)) {
        $recommendation .= "\n\nAreas for Improvement:\n";
        $recommendation .= "The student would benefit from additional support in " . implode(", ", $areas) . ". ";
        
        // Add specific recommendations based on areas needing improvement
        foreach ($areas as $area) {
            $recommendation .= "\n\n" . getSpecificRecommendation($area, $kinderLevel);
        }
    }
    
    $recommendation .= "\n\nNext Steps:\n";
    $recommendation .= "1. Continue to monitor progress in all developmental areas.\n";
    $recommendation .= "2. Implement the suggested activities to support areas needing improvement.\n";
    $recommendation .= "3. Maintain regular communication with parents/guardians about the student's progress.\n";
    $recommendation .= "4. Consider a follow-up assessment in 2-3 months to track improvement.";
    
    return $recommendation;
}

// Helper function to provide specific recommendations by area
function getSpecificRecommendation($area, $kinderLevel) {
    $recommendations = [
        "gross motor skills" => "Incorporate more physical activities like obstacle courses, ball games, and dancing. These activities help develop coordination, balance, and strength.",
        
        "fine motor skills" => "Provide opportunities for drawing, cutting with scissors, stringing beads, and manipulating small objects. These activities help develop hand-eye coordination and finger dexterity.",
        
        "self-help skills" => "Encourage independence in daily routines like dressing, eating, and personal hygiene. Break tasks into smaller steps and provide positive reinforcement.",
        
        "receptive language" => "Read books together daily, play listening games, and give clear, simple instructions. Ensure the student understands by asking them to repeat or demonstrate understanding.",
        
        "expressive language" => "Engage in conversations, ask open-ended questions, and encourage the student to describe activities, feelings, and experiences. Model correct language use without criticism.",
        
        "cognitive skills" => "Introduce puzzles, sorting activities, and simple problem-solving games. Ask questions that promote critical thinking and provide opportunities for exploration and discovery.",
        
        "socio-emotional skills" => "Create opportunities for cooperative play, teach emotional vocabulary, and model appropriate ways to express feelings. Use role-play to practice social situations."
    ];
    
    return $recommendations[$area] ?? "Provide additional support and practice in this area.";
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

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-block" onclick="clearAllNotifications()">Clear All</button>
            </div>
            </div>
        </div>
    </div>


    <!-- Page Content Here -->
    <div class="container-fluid py-3">
        <div class="container py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Update Student Grades</h2>
                <a href="grades.php" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i> Back to Grades
                </a>
            </div>
            
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Student Information</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <p><strong>Student ID:</strong> <?php echo htmlspecialchars($student['student_number']); ?></p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Name:</strong> <?php echo htmlspecialchars($student['full_name']); ?></p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Kinder Level:</strong> <?php echo htmlspecialchars($student['kinder_level']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Update Evaluation Scores</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="evaluation_period" class="form-label">Evaluation Period:</label>
                            <select class="form-select" id="evaluation_period" name="evaluation_period" required>
                                <option value="1st">1st Evaluation</option>
                                <option value="2nd">2nd Evaluation</option>
                            </select>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="gross_motor_score" class="form-label">Gross Motor Skills:</label>
                                <input type="number" class="form-control" id="gross_motor_score" name="gross_motor_score" min="0" max="100" required>
                            </div>
                            <div class="col-md-6">
                                <label for="fine_motor_score" class="form-label">Fine Motor Skills:</label>
                                <input type="number" class="form-control" id="fine_motor_score" name="fine_motor_score" min="0" max="100" required>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="self_help_score" class="form-label">Self-Help Skills:</label>
                                <input type="number" class="form-control" id="self_help_score" name="self_help_score" min="0" max="100" required>
                            </div>
                            <div class="col-md-6">
                                <label for="receptive_language_score" class="form-label">Receptive Language:</label>
                                <input type="number" class="form-control" id="receptive_language_score" name="receptive_language_score" min="0" max="100" required>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="expressive_language_score" class="form-label">Expressive Language:</label>
                                <input type="number" class="form-control" id="expressive_language_score" name="expressive_language_score" min="0" max="100" required>
                            </div>
                            <div class="col-md-6">
                                <label for="cognitive_score" class="form-label">Cognitive Skills:</label>
                                <input type="number" class="form-control" id="cognitive_score" name="cognitive_score" min="0" max="100" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="socio_emotional_score" class="form-label">Socio-Emotional Skills:</label>
                            <input type="number" class="form-control" id="socio_emotional_score" name="socio_emotional_score" min="0" max="100" required>
                        </div>
                        
                        <div class="alert alert-info">
                            <i class="fa-solid fa-info-circle"></i> After submitting the scores, an AI-powered recommendation will be automatically generated based on the student's performance.
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="view_grades.php?id=<?php echo $student['id']; ?>" class="btn btn-secondary">
                                <i class="fa-solid fa-eye"></i> View Current Grades
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-save"></i> Save and Generate Recommendation
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Load existing evaluation data when evaluation period changes
        $('#evaluation_period').change(function() {
            const period = $(this).val();
            
            if (period === '1st') {
                <?php if ($firstEvaluation): ?>
                $('#gross_motor_score').val(<?php echo $firstEvaluation['gross_motor_score']; ?>);
                $('#fine_motor_score').val(<?php echo $firstEvaluation['fine_motor_score']; ?>);
                $('#self_help_score').val(<?php echo $firstEvaluation['self_help_score']; ?>);
                $('#receptive_language_score').val(<?php echo $firstEvaluation['receptive_language_score']; ?>);
                $('#expressive_language_score').val(<?php echo $firstEvaluation['expressive_language_score']; ?>);
                $('#cognitive_score').val(<?php echo $firstEvaluation['cognitive_score']; ?>);
                $('#socio_emotional_score').val(<?php echo $firstEvaluation['socio_emotional_score']; ?>);
                <?php else: ?>
                // Clear form if no data exists
                $('form input[type="number"]').val('');
                <?php endif; ?>
            } else {
                <?php if ($secondEvaluation): ?>
                $('#gross_motor_score').val(<?php echo $secondEvaluation['gross_motor_score']; ?>);
                $('#fine_motor_score').val(<?php echo $secondEvaluation['fine_motor_score']; ?>);
                $('#self_help_score').val(<?php echo $secondEvaluation['self_help_score']; ?>);
                $('#receptive_language_score').val(<?php echo $secondEvaluation['receptive_language_score']; ?>);
                $('#expressive_language_score').val(<?php echo $secondEvaluation['expressive_language_score']; ?>);
                $('#cognitive_score').val(<?php echo $secondEvaluation['cognitive_score']; ?>);
                $('#socio_emotional_score').val(<?php echo $secondEvaluation['socio_emotional_score']; ?>);
                <?php else: ?>
                // Clear form if no data exists
                $('form input[type="number"]').val('');
                <?php endif; ?>
            }
        });
        
        // Trigger change event to load initial data
        $('#evaluation_period').trigger('change');
    });
    
    // Show alert if message exists
    <?php if ($showAlert): ?>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: '<?php echo $messageType === "success" ? "Success!" : "Error!"; ?>',
            text: '<?php echo addslashes($message); ?>',
            icon: '<?php echo $messageType; ?>',
            confirmButtonText: 'OK',
            confirmButtonColor: '<?php echo $messageType === "success" ? "#28a745" : "#dc3545"; ?>'
        });
    });
    <?php endif; ?>
</script>

<?php
include './includes/footer.php';

?>




