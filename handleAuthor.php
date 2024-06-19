<?php
session_start();
require_once 'Backend/Classes/DbConnection.php';
require_once 'Backend/Classes/Author.php';

use backEnd\Classes\DbConnection;


$dbConnection = new DbConnection();
$db = $dbConnection->getDbConnection();
$authorService = new Author($db);

$action = $_POST['action'];
$author_name = $_POST['author_name'] ?? null;
$author_lastname = $_POST['author_lastname'] ?? null;
$biography = $_POST['biography'] ?? null;
$author_id = $_POST['author_id'] ?? null;

try {
    if ($action === 'Create Author' && $author_name && $author_lastname && $biography) {
        $authorService->createAuthor($author_name, $author_lastname, $biography);
        $_SESSION['success_message'] = "Author created successfully.";
    } elseif ($action === 'Update Author' && $author_id && $author_name && $author_lastname && $biography) {
        $authorService->updateAuthor($author_id, $author_name, $author_lastname, $biography);
        $_SESSION['success_message'] = "Author updated successfully.";
    } elseif ($action === 'Delete' && $author_id) {
        $authorService->deleteAuthor($author_id);
        $_SESSION['success_message'] = "Author deleted successfully.";
    }

    header('Location: author.php');
    exit;
} catch (\Exception $e) {
    $_SESSION['error_message'] = $e->getMessage();
    error_log($e->getMessage());
    header("Location: author.php");
    exit;
}

