<?php

require_once __DIR__ . '/../models/Database.php';

class DashboardController
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    // --- Critic: fetch only their reviews
    public function getMyReviews(int $idUser): array
    {
        $stmt = $this->db->prepare("
            SELECT r.id_review, r.title, r.notation, r.creation_date,
                   g.title AS game_title, g.rawg_id
            FROM reviews r
            JOIN games g ON g.id_game = r.id_game
            WHERE r.id_user = :id_user
            ORDER BY r.creation_date DESC
        ");
        $stmt->execute([':id_user' => $idUser]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // --- Admin: fetch all reviews
    public function getAllReviews(): array
    {
        $stmt = $this->db->query("
            SELECT r.id_review, r.title, r.notation, r.creation_date, r.pinned,
                   g.title AS game_title, g.rawg_id,
                   u.username
            FROM reviews r
            JOIN games g ON g.id_game = r.id_game
            JOIN users u ON u.id_user = r.id_user
            ORDER BY r.pinned DESC, r.creation_date DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // --- Admin: fetch all users
    public function getAllUsers(): array
    {
        $stmt = $this->db->query("
            SELECT u.id_user, u.username, u.email, ro.title AS role_title
            FROM users u
            JOIN roles ro ON ro.id_role = u.id_role
            ORDER BY u.id_user ASC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // --- Admin: delete any review
    public function deleteReview(int $idReview): void
    {
        $stmt = $this->db->prepare("DELETE FROM reviews WHERE id_review = :id");
        $stmt->execute([':id' => $idReview]);
    }

    // --- Admin: toggle pin on a review
    public function pinReview(int $idReview): void
    {
        $stmt = $this->db->prepare("
            UPDATE reviews SET pinned = NOT pinned WHERE id_review = :id
        ");
        $stmt->execute([':id' => $idReview]);
    }

    // --- Admin: delete a user and all their reviews
    public function deleteUser(int $idUser): void
    {
        $stmt = $this->db->prepare("DELETE FROM reviews WHERE id_user = :id");
        $stmt->execute([':id' => $idUser]);

        $stmt = $this->db->prepare("DELETE FROM users WHERE id_user = :id");
        $stmt->execute([':id' => $idUser]);
    }

    // --- Critic: delete only their own review
    public function deleteOwnReview(int $idReview, int $idUser): void
    {
        $stmt = $this->db->prepare("
            DELETE FROM reviews WHERE id_review = :id_review AND id_user = :id_user
        ");
        $stmt->execute([
            ':id_review' => $idReview,
            ':id_user'   => $idUser,
        ]);
    }
}

