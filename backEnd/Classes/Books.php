<?php

namespace backEnd\Classes;

require_once 'DbConnection.php';

class Book
{
    protected $db;

    public function __construct()
    {
        $this->db = (new DbConnection())->getDbConnection();
    }

    public function createBook($title, $cover_url, $biography, $pages, $year_publication, $author_id, $category_id)
    {
        $sql = "INSERT INTO `books` (title, cover_url, biography, pages, year_publication, author_id, category_id) VALUES (:title, :cover_url, :biography, :pages, :year_publication, :author_id, :category_id)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':title' => $title,
            ':cover_url' => $cover_url,
            ':biography' => $biography,
            ':pages' => $pages,
            ':year_publication' => $year_publication,
            ':author_id' => $author_id,
            ':category_id' => $category_id
        ]);
    }

    public function getBooks()
    {
        $sql = "SELECT * FROM `books`";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getBookById($id)
    {
        $sql = "SELECT * FROM `books` WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function updateBook($id, $title, $cover_url, $biography, $pages, $year_publication, $author_id, $category_id)
    {
        $sql = "UPDATE `books` SET title = :title, cover_url = :cover_url, biography = :biography, pages = :pages, year_publication = :year_publication, author_id = :author_id, category_id = :category_id WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':title' => $title,
            ':cover_url' => $cover_url,
            ':biography' => $biography,
            ':pages' => $pages,
            ':year_publication' => $year_publication,
            ':author_id' => $author_id,
            ':category_id' => $category_id,
            ':id' => $id
        ]);
    }

    public function deleteBook($id)
    {
        $sql = "DELETE FROM `books` WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
    }
}

