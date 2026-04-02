<?php
session_start();

if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['id_role'], [1, 2])) {
    header("Location: /auth.php?action=login");
    exit;
}

require_once __DIR__ . '/controllers/DashboardController.php';

$controller = new DashboardController();
$user       = $_SESSION['user'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'delete_review' && $user['id_role'] === 1) {
        $controller->deleteReview((int)$_POST['id_review']);
    }

    if ($action === 'pin_review' && $user['id_role'] === 1) {
        $controller->pinReview((int)$_POST['id_review']);
    }

    if ($action === 'delete_user' && $user['id_role'] === 1) {
        $controller->deleteUser((int)$_POST['id_user']);
    }

    if ($action === 'change_role' && $user['id_role'] === 1) {
        $controller->changeUserRole((int)$_POST['id_user'], (int)$_POST['id_role']);
    }

    if ($action === 'delete_own_review' && $user['id_role'] === 2) {
        $controller->deleteOwnReview((int)$_POST['id_review'], (int)$user['id']);
    }

    header("Location: /dashboard.php");
    exit;
}

if ($user['id_role'] === 1) {
    $allReviews = $controller->getAllReviews();
    $allUsers   = $controller->getAllUsers();
    $pageTitle  = 'Admin Dashboard — Revieweo';
    require_once __DIR__ . '/views/layout/header.php';
    require_once __DIR__ . '/views/dashboard/admin.php';
} else {
    $myReviews = $controller->getMyReviews((int)$user['id']);
    $pageTitle = 'My Dashboard — Revieweo';
    require_once __DIR__ . '/views/layout/header.php';
    require_once __DIR__ . '/views/dashboard/critic.php';
}

require_once __DIR__ . '/views/layout/footer.php';

