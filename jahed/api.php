<?php

header("Content-Type: application/json");

$apiKey = "je t'envoie en privé pour pas que tout le monde puisse l'utiliser"; 

// Gestion d'erreur
if (!isset($_GET['q']) || empty($_GET['q'])) {
    echo json_encode(["error" => "Aucune recherche fournie"]);
    exit;
}

$search = urlencode($_GET['q']);

// URL de l'API RAWG
$url = "https://api.rawg.io/api/games?key=$apiKey&search=$search&page_size=10";

// fetch API
$response = file_get_contents($url);

if ($response === false) {
    echo json_encode(["error" => "Erreur API"]);
    exit;
}

// Convertir le json en tableau PHP
$data = json_decode($response, true);

// Renvoyer juste les résultats
echo json_encode($data['results'] ?? []);