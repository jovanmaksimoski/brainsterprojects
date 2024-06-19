<?php

require_once("backEnd/Classes/dbConnection.php");

use backEnd\Classes\DbConnection;

class Author
{
    protected \PDO $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }


    public function createAuthor($author_name, $author_lastname, $biography)
    {
        if ($this->authorExists($author_name, $author_lastname)) {
            if ($this->isAuthorSoftDeleted($author_name, $author_lastname)) {
                // Author exists but is soft-deleted, reactivate it
                $this->reactivateAuthor($author_name, $author_lastname);
            } else {
                throw new \Exception("Author '{$author_name} {$author_lastname}' already exists.");
            }
        } else {
            $this->insertAuthor($author_name, $author_lastname, $biography);
        }
    }

    public function updateAuthor($author_id, $author_name, $author_lastname, $biography)
    {
        $sql = "UPDATE author SET author_name = :author_name, author_lastname = :author_lastname, biography = :biography WHERE id = :author_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':author_name' => $author_name,
            ':author_lastname' => $author_lastname,
            ':biography' => $biography,
            ':author_id' => $author_id,
        ]);
    }

    public function deleteAuthor($author_id)
    {
        $sql = "UPDATE author SET soft_delete = 1 WHERE id = :author_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':author_id' => $author_id]);
    }

    public function recoverAuthor($author_id)
    {
        $sql = "UPDATE author SET soft_delete = 0 WHERE id = :author_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':author_id' => $author_id]);
    }

    public function getAllAuthors()
    {
        $sql = "SELECT * FROM author WHERE soft_delete = 0";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getAuthorById($author_id)
    {
        $sql = "SELECT * FROM author WHERE id = :author_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':author_id' => $author_id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    private function authorExists($author_name, $author_lastname)
    {
        $sql = "SELECT COUNT(*) FROM author WHERE author_name = :author_name AND author_lastname = :author_lastname";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':author_name' => $author_name,
            ':author_lastname' => $author_lastname,
        ]);
        return $stmt->fetchColumn() > 0;
    }


    private function insertAuthor($author_name, $author_lastname, $biography)
    {
        $sql = "INSERT INTO author (author_name, author_lastname, biography, soft_delete) VALUES (:author_name, :author_lastname, :biography, 0)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':author_name' => $author_name,
            ':author_lastname' => $author_lastname,
            ':biography' => $biography,
        ]);
    }

    private function reactivateAuthor($author_name, $author_lastname)
    {
        $sql = "UPDATE author SET soft_delete = 0 WHERE author_name = :author_name AND author_lastname = :author_lastname";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':author_name' => $author_name,
            ':author_lastname' => $author_lastname,
        ]);
    }

    private function isAuthorSoftDeleted($author_name, $author_lastname)
    {
        $sql = "SELECT soft_delete FROM author WHERE author_name = :author_name AND author_lastname = :author_lastname";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':author_name' => $author_name,
            ':author_lastname' => $author_lastname,
        ]);
        return $stmt->fetchColumn() == 1;
    }
}
