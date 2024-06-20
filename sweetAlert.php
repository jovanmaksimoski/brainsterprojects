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
    if ($action === 'Delete') {
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

        $response = [
            'success' => true,
            'message' => "Book deleted successfully."
        ];
        echo json_encode($response);
        exit;

    } else {
        throw new \Exception("Invalid action.");
    }

} catch (\Exception $e) {
    error_log('Exception: ' . $e->getMessage());
    $response = [
        'success' => false,
        'message' => $e->getMessage()
    ];
    echo json_encode($response);
    exit;
}
