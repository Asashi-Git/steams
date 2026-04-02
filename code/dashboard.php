<?php
session_start();

// --- Guard: must be connected and have a role <= 2 (admin or reviewer)
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['id_role'], [1, 2])) {
    header("Location: /auth.php?action=login");
    exit;
}

require_once __DIR__ . '/controllers/DashboardController.php';

$controller = new DashboardController();
$user       = $_SESSION['user'];

// --- Handle POST actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    // Admin deletes any review
    if ($action === 'delete_review' && $user['id_role'] === 1) {
        $controller->deleteReview((int)$_POST['id_review']);
    }

    // Admin pins a review
    if ($action === 'pin_review' && $user['id_role'] === 1) {
        $controller->pinReview((int)$_POST['id_review']);
    }

    // Admin deletes a user
    if ($action === 'delete_user' && $user['id_role'] === 1) {
        $controller->deleteUser((int)$_POST['id_user']);
    }

    // Reviewer deletes their own review
    if ($action === 'delete_own_review' && $user['id_role'] === 2) {
        $controller->deleteOwnReview((int)$_POST['id_review'], (int)$user['id_user']);
    }

    header("Location: /dashboard.php");
    exit;
}

// --- Load data depending on role
if ($user['id_role'] === 1) {
    $allReviews = $controller->getAllReviews();
    $allUsers   = $controller->getAllUsers();
    $pageTitle  = 'Admin Dashboard — Revieweo';
    require_once __DIR__ . '/views/layout/header.php';
    require_once __DIR__ . '/views/dashboard/admin.php';
} else {
    $myReviews = $controller->getMyReviews((int)$user['id_user']);
    $pageTitle = 'My Dashboard — Revieweo';
    require_once __DIR__ . '/views/layout/header.php';
    require_once __DIR__ . '/views/dashboard/critic.php';
}

require_once __DIR__ . '/views/layout/footer.php';

