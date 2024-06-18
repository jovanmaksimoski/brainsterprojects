<?php

namespace backEnd\Classes;

require_once ('backEnd/Classes/dbConnection.php');

class Author
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createAuthor($author_name)
    {
        $sql = "INSERT INTO `author` (author_name) VALUES (:author_name)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':author_name', $author_name);
        $stmt->execute();
    }

    public function getAuthors()
    {
        $sql = "SELECT id, author_name FROM `author` WHERE soft_delete = 0"; // Assuming soft_delete column is used for soft deletes
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function deleteAuthor($id)
    {
        $sql = "UPDATE `author` SET soft_delete = 1 WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function updateAuthor($id, $author_name)
    {
        $sql = "UPDATE `author` SET author_name = :author_name WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':author_name', $author_name);
        $stmt->execute();
    }
}

