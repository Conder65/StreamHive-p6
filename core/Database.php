<?php
// Database.php

class Database
{
    private static ?PDO $pdo = null;

    public static function getConnection(): PDO
    {
        if (self::$pdo !== null) {
            return self::$pdo;
        }

        // XAMPP defaults (adjust dbname!)
        $host = '127.0.0.1';
        $db   = 'streamhive project';
        $user = 'root';
        $pass = ''; // often empty in XAMPP

        // Always include charset in DSN
        $dsn = "mysql:host={$host};dbname={$db};charset=utf8mb4";

        $options = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
            // If you want explicit exceptions (helpful in dev):
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        ];

        try {
            self::$pdo = new PDO($dsn, $user, $pass, $options);
            return self::$pdo;
        } catch (PDOException $e) {
            // Log the real error; don't show it to the browser
            error_log("DB connection failed: " . $e->getMessage());
            throw new RuntimeException("Database connection failed.");
        }
    }
}