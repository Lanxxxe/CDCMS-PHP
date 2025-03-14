<?php
// Common functions

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function hasRole($role) {
    return isset($_SESSION['role']) && $_SESSION['role'] === $role;
}

function sanitize($input) {
    return htmlspecialchars(strip_tags($input), ENT_QUOTES, 'UTF-8');
}

function isActivePage($page) {
    return basename($_SERVER['PHP_SELF']) === $page;
}

function maskEmail($email) {
    $parts = explode("@", $email);
    $name = $parts[0];
    $domain = $parts[1];

    // Show only the first two characters of the name, mask the rest
    $maskedName = substr($name, 0, 2) . str_repeat("*", max(0, strlen($name) - 2));

    return $maskedName . "@" . $domain;
}

function validateEmail($email) {
    if (filter_var(trim($email), FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function sanitizeString($str) {
    return filter_var(trim($str), FILTER_SANITIZE_SPECIAL_CHARS);
}

function initializeLoginUser($email, $password) {
    global $pdo;

    try {
        $stmt = $pdo->prepare("SELECT id, first_name, middle_name, last_name, role, birthday, address, email, password FROM user WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['middle_name'] = $row['middle_name'];
            $_SESSION['last_name'] = $row['last_name'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['birthday'] = $row['birthday'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['address'] = $row['address'];

            if ($row['role'] === 'teacher') {
                header('Location: ./dashboard.php');
            }
        } else {
            $_SESSION['login_error'] = 'Invalid email or password!';
            header('Location: login.php');
        }
        exit;

    } catch (PDOException $e) {
        echo 'Internal Sever Error';
        exit;
    }
}


function initializeGuardianUser($email, $password) {
    global $pdo;

    try {
        $api_url = "https://smartbarangayconnect.com/api_get_registerlanding.php";
        $response = file_get_contents($api_url);
        $data = json_decode($response, true);

        // ✅ Clear old data in subdomain database
        $pdo->exec("TRUNCATE TABLE registerlanding");

        // ✅ Insert new data into subdomain database
        $sql = "INSERT INTO registerlanding 
        (id, email, first_name, last_name, session_token, picture_pic, birth_date, sex, mobile, working, occupation, house, street, barangay, city, password) 
        VALUES (:id, :email, :first_name, :last_name, :session_token, :picture_pic, :birth_date, :sex, :mobile, :working, :occupation, :house, :street, :barangay, :city, :password)";

        $stmt = $pdo->prepare($sql);

        foreach ($data as $row) {
        $stmt->execute([
                ':id' => $row['id'],
                ':email' => $row['email'],
                ':first_name' => $row['first_name'],
                ':last_name' => $row['last_name'],
                ':session_token' => $row['session_token'],
                ':picture_pic' => $row['picture_pic'] ?? null,
                ':birth_date' => $row['birth_date'],
                ':sex' => $row['sex'],
                ':mobile' => $row['mobile'],
                ':working' => $row['working'],
                ':occupation' => $row['occupation'],
                ':house' => $row['house'],
                ':street' => $row['street'],
                ':barangay' => $row['barangay'],
                ':city' => $row['city'],
                ':password' => $row['password']
            ]);
        }

        $stmt = $pdo->prepare("SELECT id, first_name, last_name, birthday, address, email, password FROM registerlanding WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password, $row['password'])) {
        // if ($password === 'pass') {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['last_name'] = $row['last_name'];
            $_SESSION['role'] = 'guardian';
            $_SESSION['birthday'] = $row['birthday'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['address'] = $row['address'];

            if ($row['role'] === 'teacher') {
                header('Location: index.php');
            } else {
                header('Location: index.php ');
            }
        } else {
            $_SESSION['login_error'] = 'Invalid email or password!';
            header('Location: login.php');
        }
        exit;

    } catch (PDOException $e) {
        echo 'Internal Sever Error';
        header('Location: login.php');
        exit;
    }
}


// Fallback function that uses the original recommendation logic
function generateFallbackRecommendation($studentName, $kinderLevel, $evaluationPeriod, 
                                      $grossMotorScore, $fineMotorScore, $selfHelpScore, 
                                      $receptiveLanguageScore, $expressiveLanguageScore, 
                                      $cognitiveScore, $socioEmotionalScore, $totalScore) {
    
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

// Function to generate AI recommendation using external API
function generateAIRecommendation($studentName, $kinderLevel, $evaluationPeriod, 
                                 $grossMotorScore, $fineMotorScore, $selfHelpScore, 
                                 $receptiveLanguageScore, $expressiveLanguageScore, 
                                 $cognitiveScore, $socioEmotionalScore, $totalScore) {
    
    // API endpoint
    $url = 'https://lanxe05.pythonanywhere.com/recommendation';
    
    if ($evaluationPeriod == '1st') {
        // Standard scores for first evaluation period
        $standardScores = [
            "Gross Motor" => 8,
            "Fine Motor" => 8,
            "Self Help" => 19,
            "Receptive Language" => 4,
            "Expressive Language" => 6,
            "Cognitive" => 19,
            "Socio-Emotional" => 20
        ];
    } else if ($evaluationPeriod == '2nd') {
        // Standard scores for second evaluation period (higher expectations)
        $standardScores = [
            "Gross Motor" => 13,
            "Fine Motor" => 1,
            "Self Help" => 26,
            "Receptive Language" => 5,
            "Expressive Language" => 8,
            "Cognitive" => 21,
            "Socio-Emotional" => 24
        ];
    } else {
        // Default standard scores for any other evaluation period
        $standardScores = [
            "Gross Motor" => 50,
            "Fine Motor" => 50,
            "Self Help" => 50,
            "Receptive Language" => 50,
            "Expressive Language" => 50,
            "Cognitive" => 50,
            "Socio-Emotional" => 50
        ];
    }
    
    // Construct the JSON payload
    $payload = [
        "st" => $studentName,
        "semester" => $evaluationPeriod,
        "student_grades" => [
            "Gross Motor" => $grossMotorScore,
            "Fine Motor" => $fineMotorScore,
            "Self Help" => $selfHelpScore,
            "Receptive Language" => $receptiveLanguageScore,
            "Expressive Language" => $expressiveLanguageScore,
            "Cognitive" => $cognitiveScore,
            "Socio-Emotional" => $socioEmotionalScore
        ],
        "standard_raw_scores" => $standardScores
    ];
    
    // Convert payload to JSON
    $jsonPayload = json_encode($payload);
    
    // Initialize cURL session
    $ch = curl_init($url);
    
    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        // 'Content-Length: ' . strlen($jsonPayload)
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPayload);
    
    // Execute cURL request
    $response = curl_exec($ch);
    
    // Check for errors
    if (curl_errno($ch)) {
        curl_close($ch);

        // Handle error - for now, fall back to the original recommendation generator
        return generateFallbackRecommendation($studentName, $kinderLevel, $evaluationPeriod, 
                                            $grossMotorScore, $fineMotorScore, $selfHelpScore, 
                                            $receptiveLanguageScore, $expressiveLanguageScore, 
                                            $cognitiveScore, $socioEmotionalScore, $totalScore);
    }
    
    // Close cURL session
    curl_close($ch);
    
    // Decode the JSON response
    $responseData = json_decode($response, true);
    
    // Check if the response contains a recommendation
    if (isset($responseData['recommendation'])) {
        return $responseData['recommendation'];
    } else {
        // Fall back to the original recommendation generator if the API response is invalid
        return generateFallbackRecommendation($studentName, $kinderLevel, $evaluationPeriod, 
                                            $grossMotorScore, $fineMotorScore, $selfHelpScore, 
                                            $receptiveLanguageScore, $expressiveLanguageScore, 
                                            $cognitiveScore, $socioEmotionalScore, $totalScore);
    }
}


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


