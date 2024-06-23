<?php

require_once("backEnd/Classes/dbConnection.php");

use backend\Classes\DbConnection;

$dbConnection = new DbConnection();
$db = $dbConnection->getDbConnection();

header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT id, commentary FROM personal_comments";
    $stmt = $db->query($sql);

    $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($notes);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    if (isset($input['commentary'])) {
        $commentary = $input['commentary'];

        $sql = "INSERT INTO personal_comments (commentary) VALUES (:commentary)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':commentary', $commentary);

        if ($stmt->execute()) {
            $newNoteId = $db->lastInsertId();
            echo json_encode(array('message' => 'Note added successfully', 'id' => $newNoteId));
        } else {
            http_response_code(500);
            echo json_encode(array('error' => 'Error adding note'));
        }
    } else {
        http_response_code(400);
        echo json_encode(array('error' => 'Invalid request. Missing commentary'));
    }
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $input = json_decode(file_get_contents('php://input'), true);

    if (isset($_GET['id']) && isset($input['commentary'])) {
        $noteId = $_GET['id'];
        $commentary = $input['commentary'];

        $sql = "UPDATE personal_comments SET commentary = :commentary WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':commentary', $commentary);
        $stmt->bindParam(':id', $noteId);

        if ($stmt->execute()) {
            echo json_encode(array('message' => 'Note updated successfully'));
        } else {
            http_response_code(500);
            echo json_encode(array('error' => 'Error updating note'));
        }
    } else {
        http_response_code(400);
        echo json_encode(array('error' => 'Invalid request. Missing note ID or commentary'));
    }
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    if (isset($_GET['id'])) {
        $noteId = $_GET['id'];

        $sql = "DELETE FROM personal_comments WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $noteId);

        if ($stmt->execute()) {
            echo json_encode(array('message' => 'Note deleted successfully'));
        } else {
            http_response_code(500);
            echo json_encode(array('error' => 'Error deleting note'));
        }
    } else {
        http_response_code(400);
        echo json_encode(array('error' => 'Invalid request. Missing note ID'));
    }
    exit();
}


http_response_code(405);
echo json_encode(array('error' => 'Method Not Allowed'));
exit();
