<?php
include_once './includes/functions.php';
include_once './config/database.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize inputs
    $lName = sanitize($_POST['lName']);
    $fName = sanitize($_POST['fName']);
    $mName = sanitize($_POST['mName'] ?? '');
    $suffix = sanitize($_POST['suffix'] ?? '');
    $bDay = sanitize($_POST['bDay']);
    $age = (int)$_POST['age'];
    $sex = sanitize($_POST['sex']);
    $healthHistory = sanitize($_POST['healthHistory'] ?? '');
    
    // Address
    $addressNumber = sanitize($_POST['addressNumber']);
    $brgy = sanitize($_POST['brgy']);
    $municipality = sanitize($_POST['municipality']);
    
    // Father's info
    $fatherLName = sanitize($_POST['fatherLName']);
    $fatherFName = sanitize($_POST['fatherFName']);
    $fatherMName = sanitize($_POST['fatherMName'] ?? '');
    $fatherContactNo = sanitize($_POST['fatherContactNo']);
    
    // Mother's info
    $motherLName = sanitize($_POST['motherLName']);
    $motherFName = sanitize($_POST['motherFName']);
    $motherMName = sanitize($_POST['motherMName'] ?? '');
    $motherContactNo = sanitize($_POST['motherContactNo']);
    
    // Guardian info
    $guardian_type = sanitize($_POST['guardian_type']);
    $guardianLName = sanitize($_POST['guardianLName']);
    $guardianFName = sanitize($_POST['guardianFName']);
    $guardianMName = sanitize($_POST['guardianMName'] ?? '');
    $guardianContactNo = sanitize($_POST['guardianContactNo']);
    $guardianRelationship = sanitize($_POST['guardianRelationship']);
    $guardianEmail = sanitize($_POST['guardianEmail']);
    $guardianOccupation = sanitize($_POST['guardianOccupation']);
    
    // Schedule
    $schedule = sanitize($_POST['schedule']);
    
    // Basic validation
    $errors = [];
    
    if (empty($lName) || empty($fName)) {
        $errors[] = "Name fields are required";
    }
    
    if (empty($bDay) || $age < 3 || $age > 5) {
        $errors[] = "Valid birthdate is required (age must be 3-5)";
    }
    
    if (empty($guardianEmail) || !validateEmail($guardianEmail)) {
        $errors[] = "Valid guardian email is required";
    }
    
    // Handle file uploads
    $psa = $_FILES['psa'] ?? null;
    $immunizationCard = $_FILES['immunizationCard'] ?? null;
    $recentPhoto = $_FILES['recentPhoto'] ?? null;
    $guardianQCID = $_FILES['guardianQCID'] ?? null;
    
    // Validate required files
    if (!isset($psa) || $psa['error'] !== UPLOAD_ERR_OK) {
        $errors[] = "PSA Birth Certificate is required";
    }
    
    if (!isset($guardianQCID) || $guardianQCID['error'] !== UPLOAD_ERR_OK) {
        $errors[] = "Guardian's QC ID is required";
    }
    
    // If no errors, process the enrollment
    if (empty($errors)) {
        try {
            $pdo->beginTransaction();
            
            // Generate student ID
            $year = date('Y');
            $stmt = $pdo->prepare("SELECT MAX(CAST(SUBSTRING(student_id, 6) AS UNSIGNED)) as max_id FROM students WHERE student_id LIKE ?");
            $stmt->execute([$year . '%']);
            $result = $stmt->fetch();
            $next_id = ($result['max_id'] ?? 0) + 1;
            $student_id = $year . str_pad($next_id, 4, '0', STR_PAD_LEFT);
            
            // Insert student
            $stmt = $pdo->prepare("INSERT INTO students (student_id, firstName, lastName, middleName, suffix, birthDate, age, sex, healthHistory, addressNumber, brgy, municipality) 
                                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $student_id, $fName, $lName, $mName, $suffix, $bDay, $age, $sex, $healthHistory, 
                $addressNumber, $brgy, $municipality
            ]);
            $student_db_id = $pdo->lastInsertId();
            
            // Insert guardian
            $stmt = $pdo->prepare("INSERT INTO guardians (student_id, relationship, firstName, lastName, middleName, contact_number, email, occupation) 
                                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $student_db_id, $guardianRelationship, $guardianFName, $guardianLName, $guardianMName, 
                $guardianContactNo, $guardianEmail, $guardianOccupation
            ]);
            
            // Insert enrollment
            $stmt = $pdo->prepare("INSERT INTO enrollment (student_id, schedule, enrollment_date) VALUES (?, ?, NOW())");
            $stmt->execute([$student_db_id, $schedule]);
            
            // Handle file uploads
            $upload_dir = 'uploads/files/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            // Function to handle file upload
            function uploadFile($file, $upload_dir, $prefix) {
                if ($file['error'] === UPLOAD_ERR_OK) {
                    $tmp_name = $file['tmp_name'];
                    $name = basename($file['name']);
                    $extension = pathinfo($name, PATHINFO_EXTENSION);
                    $new_name = $prefix . '_' . uniqid() . '.' . $extension;
                    $destination = $upload_dir . $new_name;
                    
                    if (move_uploaded_file($tmp_name, $destination)) {
                        return $new_name;
                    }
                }
                return null;
            }
            
            // Upload files and save to database
            $psa_file = uploadFile($psa, $upload_dir, 'psa');
            $immunization_file = isset($immunizationCard) && $immunizationCard['error'] === UPLOAD_ERR_OK ? 
                                uploadFile($immunizationCard, $upload_dir, 'immunization') : null;
            $photo_file = isset($recentPhoto) && $recentPhoto['error'] === UPLOAD_ERR_OK ? 
                         uploadFile($recentPhoto, $upload_dir, 'photo') : null;
            $qcid_file = uploadFile($guardianQCID, $upload_dir, 'qcid');
            
            // Insert requirements
            $stmt = $pdo->prepare("INSERT INTO requirements (student_id, psa, immunization_card, recent_photo, guardian_qcid) 
                                  VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$student_db_id, $psa_file, $immunization_file, $photo_file, $qcid_file]);
            
            $pdo->commit();
            
            // Send email with student ID
            // This would be implemented with a proper email library like PHPMailer
            
            displayAlert("Enrollment successful!", "success");
            header("Location: index.php");
            exit;
            
        } catch (PDOException $e) {
            $pdo->rollBack();
            displayAlert("Enrollment failed: " . $e->getMessage(), "danger");
        }
    } else {
        // Display errors
        $error_message = implode("<br>", $errors);
        displayAlert($error_message, "danger");
    }
}