<?php

class UserModel {

    private $conn;
    private $table = "users";

    public function __construct($db) {
        $this->conn = $db;
    }

    // CREATE USER
    public function createUser($username, $email, $password) {
        $sql = "INSERT INTO $this->table (username, email, password) 
                VALUES (:username, :email, :password)";

        $stmt = $this->conn->prepare($sql);

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $hashedPassword);

        return $stmt->execute();
    }

    // GET USER BY EMAIL
    public function getUserByEmail($email) {
        $sql = "SELECT * FROM $this->table WHERE email = :email LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // VERIFY LOGIN
    public function verifyLogin($email, $password) {
        $user = $this->getUserByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            return $user; // login success
        }

        return false; // login failed
    }
}
