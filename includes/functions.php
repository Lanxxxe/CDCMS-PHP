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
            $_SESSION['last_name'] = $row['last_name'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['birthday'] = $row['birthday'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['address'] = $row['address'];

            if ($row['role'] === 'teacher') {
                header('Location: teacher/dashboard.php');
            } else {
                header('Location: guardian/dashboard.php');
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
