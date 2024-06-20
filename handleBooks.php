<?php

session_start();

require_once 'backEnd/Classes/DbConnection.php';
require_once 'backEnd/Classes/Books.php';

use backEnd\Classes\DbConnection;
use backEnd\Classes\Books;

$dbConnection = new DbConnection();
$db = $dbConnection->getDbConnection();
$bookService = new Books($db);

$action = $_POST['action'] ?? '';

try {
    if ($action === 'Add Book') {
        $title = $_POST['title'] ?? '';
        $author_id = $_POST['author_id'] ?? '';
        $category_id = $_POST['category_id'] ?? '';
        $pages = $_POST['pages'] ?? '';
        $cover = $_POST['cover'] ?? '';
        $year_publication = $_POST['year_publication'] ?? '';

        if (empty($title) || empty($author_id) || empty($category_id) || empty($pages) || empty($cover) || empty($year_publication)) {
            throw new \Exception("All fields are required.");
        }

        if ($bookService->isBookExistsByTitle($title)) {
            throw new \Exception("A book with the title '{$title}' already exists.");
        }

        $bookService->createBook($title, $author_id, $category_id, $pages, $cover, $year_publication);
        $_SESSION['success_message'] = "Book '{$title}' added successfully.";
    } elseif ($action === 'Delete') {
        $book_id = $_POST['book_id'] ?? '';

        if (empty($book_id)) {
            throw new \Exception("Invalid request. Book ID is missing.");
        }

        if (!$bookService->isBookExists($book_id)) {
            throw new \Exception("The book does not exist.");
        }

        if ($bookService->isBookSoftDeleted($book_id)) {
            throw new \Exception("The book has already been soft deleted.");
        }

        $bookService->deleteBook($book_id);
        $_SESSION['success_message'] = "Book deleted successfully.";
    } elseif ($action === 'Edit Book') {
        $book_id = $_POST['book_id'] ?? '';
        $title = $_POST['title'] ?? '';
        $author_id = $_POST['author_id'] ?? '';
        $category_id = $_POST['category_id'] ?? '';
        $pages = $_POST['pages'] ?? '';
        $cover = $_POST['cover'] ?? '';
        $year_publication = $_POST['year_publication'] ?? '';

        if (empty($book_id) || empty($title) || empty($author_id) || empty($category_id) || empty($pages) || empty($cover) || empty($year_publication)) {
            throw new \Exception("All fields are required for editing.");
        }

        $bookService->updateBook($book_id, $title, $author_id, $category_id, $pages, $cover, $year_publication);
        $_SESSION['success_message'] = "Book '{$title}' updated successfully.";
    }

    header('Location: adminPanel.php');
} catch (\Exception $e) {
    $_SESSION['error_message'] = $e->getMessage();
    error_log($e->getMessage());
    header("Location: adminPanel.php");

}
