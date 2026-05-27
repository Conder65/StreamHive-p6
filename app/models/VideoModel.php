<?php

class VideoModel 
{
    private $conn;
    private $table = "videos";

    public function __construct($db) {
        $this->conn = $db;
    }

    // upload video
    public function uploadVideo($title, $description, $filename, $userId) {
        $sql = "INSERT INTO $this->table (title, description, filename, user_id) 
                VALUES (:title, :description, :filename, :user_id)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":filename", $filename);
        $stmt->bindParam(":user_id", $userId);

        return $stmt->execute();
    }
}