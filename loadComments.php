<?php
require_once 'backEnd/Classes/DbConnection.php';
require_once ("backEnd/Classes/Comment.php");

use backEnd\Classes\DbConnection;
use backEnd\Classes\Books;

$dbConnection = new DbConnection();
$db = $dbConnection->getDbConnection();


$comment = new \backEnd\Classes\Comment($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['book_id'])) {
        $bookId = $_POST['book_id'];
        $comments = $comment->getCommentsByBookId($bookId);
        echo json_encode($comments);
        exit;
    }
};


