<?php

class Database
{
    private static ?PDO $instance = null;

    /**
     * Private constructor — nobody can do "new Database()" from outside.
     * This is the heart of the singleton pattern.
     */
    private function __construct() {}

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            $config = require __DIR__ . '/../config/database.php';

            $dsn = sprintf(
                "mysql:host=%s;dbname=%s;charset=%s",
                $config['host'],
                $config['dbname'],
                $config['charset']
            );

            try {
                self::$instance = new PDO($dsn, $config['user'], $config['pass'], [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false
                ]);
            } catch (PDOException $e) {
                // Never expose the real error to the browser in production
                error_log("Database connection failed: " . $e->getMessage());
                throw new RuntimeException("Database connection failed " . $e->getMessage());
            }
        }

        return self::$instance;
    }
}
