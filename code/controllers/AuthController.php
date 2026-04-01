<?php

session_start();

require_once __DIR__ . '/../models/UserModel.php';

$action = $_GET['action'] ?? 'login';
$model  = new UserModel();
$error  = null;

// --- Logout
if ($action === 'logout') {
    session_destroy();
    header("Location: /auth.php?action=login");
    exit;
}

// --- Login
if ($action === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $email    = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email) || empty($password)) {
        $error = "All fields are required.";
    } else {
        $user = $model->findByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            $error = "Invalid email or password.";
        } else {
            $_SESSION['user'] = [
                'id'         => $user['id_user'],
                'username'   => $user['username'],
                'email'      => $user['email'],
                'id_role'    => $user['id_role'],
                'role_title' => $user['role_title'],
            ];

            // Redirect based on role
            if ($user['id_role'] === 1) {
                header("Location: /admin.php");
            } elseif ($user['id_role'] === 2) {
                header("Location: /dashboard.php");
            } else {
                header("Location: /index.php");
            }
            exit;
        }
    }
}

// --- Register
if ($action === 'register' && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm  = trim($_POST['confirm'] ?? '');

    if (empty($username) || empty($email) || empty($password) || empty($confirm)) {
        $error = "All fields are required.";
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match.";
    } elseif (strlen($password) < 8) {
        $error = "Password must be at least 8 characters.";
    } elseif ($model->emailExists($email)) {
        $error = "This email is already registered.";
    } elseif ($model->usernameExists($username)) {
        $error = "This username is already taken.";
    } else {
        $model->create($username, $email, $password);
        header("Location: /auth.php?action=login&registered=1");
        exit;
    }
}

