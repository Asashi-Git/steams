<?php

header("Content-Type: application/json");

session_start();

require_once __DIR__ . '/services/RawgService.php';
require_once __DIR__ . '/models/Database.php';

$action = $_GET['action'] ?? '';

// -------------------------------------------------------
// LIKE / UNLIKE
// -------------------------------------------------------
if ($action === 'like') {

    if (!isset($_SESSION['user'])) {
        http_response_code(401);
        echo json_encode(["error" => "Not connected."]);
        exit;
    }

    $idGame = isset($_POST['id_game']) ? (int)$_POST['id_game'] : 0;
    $idUser = (int)$_SESSION['user']['id_user'];

    if ($idGame <= 0) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid game id."]);
        exit;
    }

    try {
        $db = Database::getInstance();

        $check = $db->prepare("
            SELECT 1 FROM likes
            WHERE id_user = :id_user AND id_game = :id_game
        ");
        $check->execute([':id_user' => $idUser, ':id_game' => $idGame]);

        if ($check->fetch()) {
            $db->prepare("
                DELETE FROM likes
                WHERE id_user = :id_user AND id_game = :id_game
            ")->execute([':id_user' => $idUser, ':id_game' => $idGame]);

            $liked = false;

        } else {
            $db->prepare("
                INSERT INTO likes (id_user, id_game)
                VALUES (:id_user, :id_game)
            ")->execute([':id_user' => $idUser, ':id_game' => $idGame]);

            $liked = true;
        }

        $countStmt = $db->prepare("
            SELECT COUNT(*) FROM likes WHERE id_game = :id_game
        ");
        $countStmt->execute([':id_game' => $idGame]);
        $count = (int)$countStmt->fetchColumn();

        echo json_encode(['liked' => $liked, 'count' => $count]);

    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["error" => "Database error."]);
    }

    exit;
}

// -------------------------------------------------------
// SEARCH
// -------------------------------------------------------
if (!isset($_GET['q']) || empty(trim($_GET['q']))) {
    http_response_code(400);
    echo json_encode(["error" => "No search query provided."]);
    exit;
}

try {
    $service = new RawgService();
    $results = $service->searchGames($_GET['q']);
    echo json_encode($results);

} catch (InvalidArgumentException $e) {
    http_response_code(400);
    echo json_encode(["error" => $e->getMessage()]);

} catch (RuntimeException $e) {
    http_response_code(502);
    echo json_encode(["error" => "External API error."]);
}

