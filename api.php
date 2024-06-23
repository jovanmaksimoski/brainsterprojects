<?php

require_once("backEnd/Classes/dbConnection.php");

use backend\Classes\DbConnection;

$dbConnection = new DbConnection();
$db = $dbConnection->getDbConnection();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT id, commentary, user_id, book_id FROM personal_comments";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        $comments = array();
        while ($row = $result->fetch_assoc()) {
            $comments[] = $row;
        }
        header('Content-Type: application/json');
        echo json_encode($comments);
    } else {
        echo json_encode(array());
    }
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    if (isset($input['commentary']) && isset($input['user_id']) && isset($input['book_id'])) {
        $commentary = $input['commentary'];
        $user_id = $input['user_id'];
        $book_id = $input['book_id'];

        $sql = "INSERT INTO personal_comments (commentary, user_id, book_id) VALUES ('$commentary', '$user_id', '$book_id')";

        if ($db->query($sql) === TRUE) {
            $newCommentId = $db->insert_id;
            $newComment = array(
                'id' => $newCommentId,
                'commentary' => $commentary,
                'user_id' => $user_id,
                'book_id' => $book_id
            );
            header('Content-Type: application/json');
            echo json_encode(array('message' => 'Comment added successfully', 'comment' => $newComment));
        } else {
            http_response_code(500); // Internal Server Error
            echo json_encode(array('error' => 'Error adding comment: ' . $db->error));
        }
    } else {
        http_response_code(400); // Bad Request
        echo json_encode(array('error' => 'Invalid request. Missing required parameters.'));
    }
    exit();
}


http_response_code(405);
echo json_encode(array('error' => 'Method Not Allowed'));
exit();



