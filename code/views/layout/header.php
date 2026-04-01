<?php
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
        <div class="ms-auto d-flex gap-2 align-items-center">
            <?php if ($currentUser): ?>
                <span class="navbar-text text-light me-2">
                    <?= htmlspecialchars($currentUser['username']) ?>
                    <span class="badge bg-secondary ms-1">
                        <?= htmlspecialchars($currentUser['role_title']) ?>
                    </span>
                </span>
                <?php if (in_array($currentUser['id_role'], [1, 2])): ?>
                    <a href="/dashboard.php" class="btn btn-outline-light btn-sm">Dashboard</a>
                <?php endif; ?>
                <a href="/auth.php?action=logout" class="btn btn-outline-danger btn-sm">Logout</a>
            <?php else: ?>
                <a href="/auth.php?action=login" class="btn btn-outline-light btn-sm">Login</a>
                <a href="/auth.php?action=register" class="btn btn-primary btn-sm">Register</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="container">

