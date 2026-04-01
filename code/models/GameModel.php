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
     * Fetch all games, ordered by title.
     */
    public function findAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM games ORDER BY title ASC");
        return $stmt->fetchAll();
    }

    /**
     * Fetch a single game by its ID.
     */
    public function findById(int $id): array|false
    {
        $stmt = $this->db->prepare("SELECT * FROM games WHERE id_game = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Fetch a game with its categories and platforms.
     */
    public function findWithDetails(int $id): array|false
    {
        $stmt = $this->db->prepare("
            SELECT
                g.*,
                GROUP_CONCAT(DISTINCT c.name ORDER BY c.name SEPARATOR ', ') AS categories,
                GROUP_CONCAT(DISTINCT p.name ORDER BY p.name SEPARATOR ', ') AS platforms
            FROM games g
            LEFT JOIN belongs       b  ON b.id_game      = g.id_game
            LEFT JOIN categories    c  ON c.id_category  = b.id_category
            LEFT JOIN available_on  ao ON ao.id_game     = g.id_game
            LEFT JOIN platforms     p  ON p.id_platform  = ao.id_platform
            WHERE g.id_game = :id
            GROUP BY g.id_game
        ");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Insert a game coming from the RAWG API.
     */
    public function createFromApi(string $title, ?string $description, ?string $releaseDate, ?string $coverImage): int
    {
        $stmt = $this->db->prepare("
            INSERT INTO games (title, description, release_date, cover_image)
            VALUES (:title, :description, :release_date, :cover_image)
        ");
        $stmt->execute([
            ':title'        => $title,
            ':description'  => $description,
            ':release_date' => $releaseDate,
            ':cover_image'  => $coverImage
        ]);
        return (int) $this->db->lastInsertId();
    }
}

