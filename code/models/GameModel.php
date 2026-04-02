<?php

require_once __DIR__ . '/Database.php';

class GameModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Return every game stored locally.
     */
    public function findAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM games ORDER BY title ASC");
        return $stmt->fetchAll();
    }

    /**
     * Find a game by its local primary key.
     */
    public function findById(int $id): array|false
    {
        $stmt = $this->db->prepare("SELECT * FROM games WHERE id_game = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Find a game already stored locally by its RAWG id.
     */
    public function findByRawgId(int $rawgId): array|false
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM games WHERE rawg_id = :rawg_id"
        );
        $stmt->execute([':rawg_id' => $rawgId]);
        return $stmt->fetch();
    }

    /**
     * Insert a game coming from the RAWG API.
     * Returns the new local id_game.
     */
    public function createFromApi(array $formatted): int
    {
        $stmt = $this->db->prepare("
            INSERT INTO games (rawg_id, title, description, release_date, cover_image)
            VALUES (:rawg_id, :title, :description, :release_date, :cover_image)
        ");

        $stmt->execute([
            ':rawg_id'      => $formatted['rawg_id'],
            ':title'        => $formatted['title'],
            ':description'  => $formatted['description'],
            ':release_date' => $formatted['release_date'],
            ':cover_image'  => $formatted['cover_image'],
        ]);

        return (int) $this->db->lastInsertId();
    }


    public function findAllWithStats(): array
    {
        $stmt = $this->db->query("
            SELECT
                g.*,
                ROUND(AVG(r.note), 1)  AS avg_score,
                COUNT(r.id_critique)   AS review_count
            FROM games g
            LEFT JOIN critiques r ON r.id_game = g.id_game
            GROUP BY g.id_game
            ORDER BY g.title ASC
        ");
        return $stmt->fetchAll();
    }
}

