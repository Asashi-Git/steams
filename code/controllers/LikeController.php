<?php

session_start();

require_once __DIR__ . '/../models/Database.php';

header('Content-Type: application/json');

// Must be logged in
if (!isset($_SESSION['user'])) {
    echo json_encode(['error' => 'unauthenticated']);
    exit;
}

// Must receive a valid id_game
if (!isset($_POST['id_game']) || !is_numeric($_POST['id_game'])) {
    echo json_encode(['error' => 'invalid_game']);
    exit;
}

$idGame = (int)$_POST['id_game'];
$idUser = (int)$_SESSION['user']['id'];

$db = Database::getInstance();

// Check if like already exists
$stmt = $db->prepare("SELECT 1 FROM likes WHERE id_game = :g AND id_user = :u");
$stmt->execute([':g' => $idGame, ':u' => $idUser]);
$exists = (bool)$stmt->fetch();

if ($exists) {
    // Unlike
    $db->prepare("DELETE FROM likes WHERE id_game = :g AND id_user = :u")
       ->execute([':g' => $idGame, ':u' => $idUser]);
    $liked = false;
} else {
    // Like
    $db->prepare("INSERT INTO likes (id_game, id_user) VALUES (:g, :u)")
       ->execute([':g' => $idGame, ':u' => $idUser]);
    $liked = true;
}

// Return new count and state
$stmt = $db->prepare("SELECT COUNT(*) FROM likes WHERE id_game = :g");
$stmt->execute([':g' => $idGame]);
$count = (int)$stmt->fetchColumn();

echo json_encode(['liked' => $liked, 'count' => $count]);

