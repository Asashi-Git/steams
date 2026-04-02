<?php

require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/GameModel.php';
require_once __DIR__ . '/../services/RawgService.php';

class GameController
{
    private GameModel   $gameModel;
    private RawgService $rawg;

    public function __construct()
    {
        $this->gameModel = new GameModel();
        $this->rawg      = new RawgService();
    }

    /**
     * The central method.
     * Given a RAWG id, guarantee the game exists locally and return it.
     */
    public function findOrCreate(int $rawgId): array|false
    {
        // 1. Already in our database? Return immediately.
        $game = $this->gameModel->findByRawgId($rawgId);

        if ($game !== false) {
            return $game;
        }

        // 2. Not found locally — fetch full details from RAWG.
        $formatted = $this->rawg->getGameById($rawgId);

        if ($formatted === null) {
            return false; // RAWG did not respond
        }

        // 3. Persist it, then return the freshly created row.
        $newId = $this->gameModel->createFromApi($formatted);
        return $this->gameModel->findById($newId);
    }

    /**
     * Fetch all reviews for a given game (by local id_game).
     */
    public function getReviews(int $gameId): array
    {
        $db   = Database::getInstance();
        $stmt = $db->prepare("
            SELECT r.*, u.username
            FROM reviews r
            JOIN users u ON u.id_user = r.id_user
            WHERE r.id_game = :id_game
            ORDER BY r.creation_date DESC
        ");
        $stmt->execute([':id_game' => $gameId]);
        return $stmt->fetchAll();
    }
    public function getLikeCount(int $idGame): int
    {
        $db   = Database::getInstance();
        $stmt = $db->prepare("SELECT COUNT(*) FROM likes WHERE id_game = :id_game");
        $stmt->execute([':id_game' => $idGame]);
        return (int)$stmt->fetchColumn();
    }

    public function userHasLiked(int $idGame, int $idUser): bool
    {
        $db   = Database::getInstance();
        $stmt = $db->prepare("
            SELECT 1 FROM likes
            WHERE id_game = :id_game AND id_user = :id_user
        ");
        $stmt->execute([':id_game' => $idGame, ':id_user' => $idUser]);
        return (bool)$stmt->fetch();
    }

}
