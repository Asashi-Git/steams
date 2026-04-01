<?php

session_start();

require_once __DIR__ . '/controllers/GameController.php';

// --- Guard: rawg_id must be provided and numeric
if (!isset($_GET['rawg_id']) || !is_numeric($_GET['rawg_id'])) {
    header("Location: index.php");
    exit;
}

$rawgId     = (int) $_GET['rawg_id'];
$controller = new GameController();

// --- Find or create the game in our database
$game = $controller->findOrCreate($rawgId);

if ($game === false) {
    header("Location: index.php");
    exit;
}

// --- Load all reviews for this game
$reviews = $controller->getReviews($game['id_game']);

// --- Check if the connected user already posted a review
$userReview = null;

if (isset($_SESSION['user'])) {
    foreach ($reviews as $review) {
        if ((int)$review['id_user'] === (int)$_SESSION['user']['id_user']) {
            $userReview = $review;
            break;
        }
    }
}

// --- Pass everything to the view
require_once __DIR__ . '/views/game.php';

