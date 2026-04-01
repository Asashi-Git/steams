<?php

require_once __DIR__ . '/Database.php';

class UserModel {

    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function findByEmail(string $email): array|false {
        $stmt = $this->db->prepare("
            SELECT u.*, r.title as role_title
            FROM users u
            JOIN roles r ON u.id_role = r.id_role
            WHERE u.email = :email
            LIMIT 1
        ");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findById(int $id): array|false {
        $stmt = $this->db->prepare("
            SELECT u.*, r.title as role_title
            FROM users u
            JOIN roles r ON u.id_role = r.id_role
            WHERE u.id_user = :id
            LIMIT 1
        ");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function emailExists(string $email): bool {
        $stmt = $this->db->prepare("SELECT id_user FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch() !== false;
    }

    public function usernameExists(string $username): bool {
        $stmt = $this->db->prepare("SELECT id_user FROM users WHERE username = :username");
        $stmt->execute([':username' => $username]);
        return $stmt->fetch() !== false;
    }

    // Default role: 3 (member)
    public function create(string $username, string $email, string $password): bool {
        $hashed = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $this->db->prepare("
            INSERT INTO users (username, email, password, id_role)
            VALUES (:username, :email, :password, 3)
        ");

        return $stmt->execute([
            ':username' => $username,
            ':email'    => $email,
            ':password' => $hashed,
        ]);
    }
}

