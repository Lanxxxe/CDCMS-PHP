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

