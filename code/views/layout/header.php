<?php
// Safety: session must already be started by the calling controller
$currentUser = $_SESSION['user'] ?? null;
$pageTitle   = $pageTitle ?? 'Revieweo';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link rel="icon" href="data:,">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/index.php">Revieweo</a>
        <div class="ms-auto d-flex gap-2">
            <?php if ($currentUser): ?>
                <span class="navbar-text text-light me-3">
                    <?= htmlspecialchars($currentUser['pseudo']) ?>
                </span>
                <a href="/controllers/AuthController.php?action=logout"
                   class="btn btn-outline-light btn-sm">Logout</a>
            <?php else: ?>
                <a href="/views/auth/login.php"
                   class="btn btn-outline-light btn-sm">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="container">

