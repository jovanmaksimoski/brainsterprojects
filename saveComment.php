<?php
session_start();

require_once 'backEnd/Classes/DbConnection.php';
require_once 'backEnd/Classes/Comment.php';

use backEnd\Classes\DbConnection;
use backEnd\Classes\Comment;

$dbConnection = new DbConnection();
$db = $dbConnection->getDbConnection();


$comment = new Comment($db);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}


$action = $_POST['action'];

if ($action === 'create') {
    $commentary = $_POST['commentary'];
    $userId = $_POST['user_id'];
    $bookId = $_POST['book_id'];

    if ($comment->createComment($commentary, $userId, $bookId)) {
        echo "Comment created successfully!";
        header('Location: index.php');
    } else {
        echo "Failed to create comment.";
    }

} elseif ($action === 'read') {
    $commentId = $_POST['comment_id'];
    $commentData = $comment->getComment($commentId);

    if ($commentData) {
        echo json_encode($commentData);
    } else {
        echo "Comment not found.";
    }
} elseif ($action === 'update') {
    $commentId = $_POST['comment_id'];
    $commentary = $_POST['commentary'];
    $statusComm = $_POST['status_comm'];

    if ($comment->updateComment($commentId, $commentary, $statusComm)) {
        echo "Comment updated successfully!";
    } else {
        echo "Failed to update comment.";
    }
} elseif ($action === 'delete') {
    $commentId = $_POST['comment_id'];

    if ($comment->deleteComment($commentId)) {
        echo "Comment deleted successfully!";
        return header('Location: index.php');
    } else {
        echo "Failed to delete comment.";
    }
} else {
    echo "Invalid action.";
}






