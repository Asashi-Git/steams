<?php

header("Content-Type: application/json");

require_once __DIR__ . '/services/RawgService.php';

if (!isset($_GET['q']) || empty(trim($_GET['q']))) {
    http_response_code(400);
    echo json_encode(["error" => "Aucune recherche fournie."]);
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
    echo json_encode(["error" => "Erreur API externe."]);
}

