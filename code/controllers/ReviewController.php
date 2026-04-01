<?php

session_start();

require_once __DIR__ . '/../models/Database.php';

// --- Guard: only POST requests are accepted
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../index.php");
    exit;
}

// --- Guard: user must be connected
if (!isset($_SESSION['user'])) {
    header("Location: ../views/auth/login.php");
    exit;
}

// --- Collect and sanitize inputs
$idGame   = isset($_POST['id_game'])  ? (int)   $_POST['id_game']           : 0;
$title    = isset($_POST['title'])    ? trim($_POST['title'])                : '';
$content  = isset($_POST['content'])  ? trim($_POST['content'])              : '';
$notation = isset($_POST['notation']) ? (int)   $_POST['notation']          : 0;
$idUser   = (int) $_SESSION['user']['id'];

// --- Validate inputs
$errors = [];

if ($idGame <= 0) {
    $errors[] = "Invalid game.";
}

if (empty($title)) {
    $errors[] = "Title cannot be empty.";
}

if (empty($content)) {
    $errors[] = "Review content cannot be empty.";
}

if ($notation < 1 || $notation > 10) {
    $errors[] = "Score must be between 1 and 10.";
}

if (!empty($errors)) {
    // Store errors in session and redirect back
    $_SESSION['form_errors'] = $errors;
    header("Location: ../game.php?rawg_id=" . $_GET['rawg_id'] ?? '');
    exit;
}

// --- Check the user has not already reviewed this game
try {
    $db   = Database::getInstance();

    $check = $db->prepare("
        SELECT id_review FROM reviews
        WHERE id_user = :id_user AND id_game = :id_game
    ");
    $check->execute([
        ':id_user' => $idUser,
        ':id_game' => $idGame,
    ]);

    if ($check->fetch()) {
        $_SESSION['form_errors'] = ["You already reviewed this game."];
        header("Location: ../game.php?rawg_id=" . ($_POST['rawg_id'] ?? ''));
        exit;
    }

    // --- Insert the review
    $stmt = $db->prepare("
        INSERT INTO reviews (title, content, notation, id_user, id_game)
        VALUES (:title, :content, :notation, :id_user, :id_game)
    ");

    $stmt->execute([
        ':title'    => $title,
        ':content'  => $content,
        ':notation' => $notation,
        ':id_user'  => $idUser,
        ':id_game'  => $idGame,
    ]);

    $_SESSION['form_success'] = "Your review has been published.";

} catch (PDOException $e) {
    $_SESSION['form_errors'] = ["A database error occurred. Error: " . $e->getMessage()];
}

// --- Redirect back to the game page
// We need the rawg_id to rebuild the URL — store it in the form as a hidden field
header("Location: ../game.php?rawg_id=" . ($_POST['rawg_id'] ?? ''));
exit;

