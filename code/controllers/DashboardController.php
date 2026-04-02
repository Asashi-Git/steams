<?php

require_once __DIR__ . '/../models/Database.php';

class DashboardController
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

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

    public function getAllUsers(): array
    {
        $stmt = $this->db->query("
            SELECT u.id_user, u.username, u.email, u.id_role, ro.title AS role_title
            FROM users u
            JOIN roles ro ON ro.id_role = u.id_role
            ORDER BY u.id_user ASC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteReview(int $idReview): void
    {
        // Fetch the associated id_game first
        $stmt = $this->db->prepare("SELECT id_game FROM reviews WHERE id_review = :id");
        $stmt->execute([':id' => $idReview]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $stmt = $this->db->prepare("DELETE FROM likes WHERE id_game = :id_game");
            $stmt->execute([':id_game' => $row['id_game']]);
        }

        // Then delete the review
        $stmt = $this->db->prepare("DELETE FROM reviews WHERE id_review = :id");
        $stmt->execute([':id' => $idReview]);
    }

    public function pinReview(int $idReview): void
    {
        $stmt = $this->db->prepare("
            UPDATE reviews SET pinned = NOT pinned WHERE id_review = :id
        ");
        $stmt->execute([':id' => $idReview]);
    }

    public function deleteUser(int $idUser): void
    {
        // 1. Delete likes ON the user's reviews
        $stmt = $this->db->prepare("
            DELETE FROM likes 
            WHERE id_game IN (
                SELECT id_game FROM reviews WHERE id_user = :id_review
            )
            AND id_user = :id_like
        ");
        $stmt->execute([':id_review' => $idUser, ':id_like' => $idUser]);

        // 2. Delete the user's own likes
        $stmt = $this->db->prepare("DELETE FROM likes WHERE id_user = :id");
        $stmt->execute([':id' => $idUser]);

        // 3. Delete the user's reviews
        $stmt = $this->db->prepare("DELETE FROM reviews WHERE id_user = :id");
        $stmt->execute([':id' => $idUser]);

        // 4. Delete the user
        $stmt = $this->db->prepare("DELETE FROM users WHERE id_user = :id");
        $stmt->execute([':id' => $idUser]);
    }

    public function changeUserRole(int $idUser, int $idRole): void
    {
        $stmt = $this->db->prepare("
            UPDATE users SET id_role = :id_role WHERE id_user = :id_user
        ");
        $stmt->execute([
            ':id_role' => $idRole,
            ':id_user' => $idUser,
        ]);
    }

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

