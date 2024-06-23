<?php

namespace backEnd\Classes;
require_once('dbConnection.php');

use backEnd\Classes\DbConnection;

class Comment
{
    protected $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function createComment($commentary, $userId, $bookId)
    {
//            $statusComm = 'pending';
//
//            $stmt = $this->db->prepare("INSERT INTO public_comments (commentary, user_id, status_comm, book_id)
//                                       VALUES (:commentary, :user_id, :status_comm, :book_id)");
//            $stmt->bindParam(':commentary', $commentary);
//            $stmt->bindParam(':user_id', $userId);
//            $stmt->bindParam(':status_comm', $statusComm);
//            $stmt->bindParam(':book_id', $bookId);
//
//            return $stmt->execute();

        $stmt = $this->db->prepare("SELECT COUNT(*) FROM public_comments WHERE id = :user_id");
        $stmt->bindParam(':user_id', $userId, \PDO::PARAM_INT);
        $stmt->execute();
        $userExists = $stmt->fetchColumn();

        if (!$userExists) {
            // Handle the case where the user does not exist
            return false;
        }

        // Proceed with inserting the comment
//            $statusComm = 'pending';

        $stmt = $this->db->prepare("INSERT INTO public_comments (commentary, user_id, status_comm, book_id)
                               VALUES (:commentary, :user_id, :status_comm, :book_id)");
        $stmt->bindParam(':commentary', $commentary);
        $stmt->bindParam(':user_id', $userId, \PDO::PARAM_INT);
        $stmt->bindParam(':status_comm', $statusComm);
        $stmt->bindParam(':book_id', $bookId, \PDO::PARAM_INT);

        return $stmt->execute();


    }

    public function getComment($commentId)
    {
        $stmt = $this->db->prepare("SELECT * FROM public_comments WHERE id = :id");
        $stmt->bindParam(':id', $commentId);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function updateComment($commentId, $commentary, $statusComm)
    {
        $stmt = $this->db->prepare("UPDATE public_comments SET commentary = :commentary, status_comm = :status_comm WHERE id = :id");
        $stmt->bindParam(':commentary', $commentary);
        $stmt->bindParam(':status_comm', $statusComm);
        $stmt->bindParam(':id', $commentId);
        return $stmt->execute();
    }

    public function deleteComment($commentId)
    {
        $stmt = $this->db->prepare("DELETE FROM public_comments WHERE id = :id");
        $stmt->bindParam(':id', $commentId);
        return $stmt->execute();
    }

    public function getCommentsByBookId($bookId)
    {
        $query = "SELECT commentary FROM public_comments WHERE book_id = :book_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':book_id', $bookId, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}