<?php

$action = $_GET['action'] ?? 'login';

require_once __DIR__ . '/controllers/AuthController.php';

if ($action === 'login') {
    require_once __DIR__ . '/views/auth/login.php';
} elseif ($action === 'register') {
    require_once __DIR__ . '/views/auth/register.php';
}

