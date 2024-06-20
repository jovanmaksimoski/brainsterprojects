<?php

namespace backEnd\Classes;

require_once('dbConnection.php');

class Books
{
    protected \PDO $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function getAuthors()
    {
        $sql = "SELECT id, author_name, author_lastname FROM author WHERE soft_delete = 0";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getCategories()
    {
        $sql = "SELECT id, category FROM category WHERE soft_delete = 0";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function createBook($title, $author_id, $category_id, $pages, $cover, $year_publication) {

        $sql = "SELECT id FROM books WHERE title = :title AND soft_delete = 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':title' => $title]);
        $existing_book_id = $stmt->fetchColumn();

        if ($existing_book_id) {
            $sql = "UPDATE books SET author_id = :author_id, category_id = :category_id, pages = :pages, cover = :cover, year_publication = :year_publication, soft_delete = 0 WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':author_id' => $author_id,
                ':category_id' => $category_id,
                ':pages' => $pages,
                ':cover' => $cover,
                ':year_publication' => $year_publication,
                ':id' => $existing_book_id
            ]);
        } else {
            $sql = "INSERT INTO books (title, author_id, category_id, pages, cover, year_publication, soft_delete) VALUES (:title, :author_id, :category_id, :pages, :cover, :year_publication, 0)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':title' => $title,
                ':author_id' => $author_id,
                ':category_id' => $category_id,
                ':pages' => $pages,
                ':cover' => $cover,
                ':year_publication' => $year_publication
            ]);
        }
    }


    public function updateBook($book_id, $title, $author_id, $category_id, $pages, $cover, $year_publication)
    {
        $sql = "UPDATE books SET title = :title, author_id = :author_id, category_id = :category_id, pages = :pages, cover = :cover, year_publication = :year_publication WHERE id = :book_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':book_id' => $book_id,
            ':title' => $title,
            ':author_id' => $author_id,
            ':category_id' => $category_id,
            ':pages' => $pages,
            ':cover' => $cover,
            ':year_publication' => $year_publication,
        ]);
    }

    public function deleteBook($book_id)
    {
        $sql = "UPDATE books SET soft_delete = 1 WHERE id = :book_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':book_id' => $book_id]);


    }

    public function getAllBooks()
    {
        $sql = "SELECT b.id, b.title, b.pages, b.cover, b.year_publication, a.author_name, a.author_lastname, c.category
                FROM books b
                INNER JOIN author a ON b.author_id = a.id
                INNER JOIN category c ON b.category_id = c.id
                WHERE b.soft_delete = 0";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    public function getBookById($book_id)
    {
        $sql = "SELECT b.id, b.title, b.pages, b.cover, b.year_publication, a.author_name, a.author_lastname, c.category
                FROM books b
                INNER JOIN author a ON b.author_id = a.id
                INNER JOIN category c ON b.category_id = c.id
                WHERE b.id = :book_id AND b.soft_delete = 0";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':book_id' => $book_id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function isBookExistsByTitle($title)
    {
        $sql = "SELECT COUNT(*) FROM books WHERE title = :title AND soft_delete = 0";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':title' => $title]);
        $count = $stmt->fetchColumn();
        return $count > 0;
    }

    public function isBookSoftDeleted($book_id)
    {
        $sql = "SELECT soft_delete FROM books WHERE id = :book_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':book_id' => $book_id]);
        return $stmt->fetchColumn() == 1;
    }

    public function isBookExists($book_id)
    {
        $sql = "SELECT COUNT(*) FROM books WHERE id = :book_id AND soft_delete = 0";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':book_id' => $book_id]);
        $count = $stmt->fetchColumn();
        return $count > 0;
    }
}


