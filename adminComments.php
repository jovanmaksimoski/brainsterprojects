<?php

session_start();


require_once 'backEnd/Classes/DbConnection.php';
require_once 'backEnd/Classes/Comment.php';

use backEnd\Classes\DbConnection;
use backEnd\Classes\Comment;

$dbConnection = new DbConnection();
$db = $dbConnection->getDbConnection();
$comment = new Comment($db);
$comments = $comment->getAllComments();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'approve' && isset($_GET['id'])) {
    $commentId = $_GET['id'];
    if ($comment->approveComment($commentId)) {
        $_SESSION['success_message'] = "Comment approved successfully!";
    } else {
        $_SESSION['error_message'] = "Failed to approve comment.";
    }
    header('Location: adminComments.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $commentId = $_GET['id'];
    if ($comment->deleteComment($commentId)) {
        $_SESSION['success_message'] = "Comment deleted successfully!";
    } else {
        $_SESSION['error_message'] = "Failed to delete comment.";
    }
    header('Location: adminComments.php');
    exit;
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comments</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script

    <link rel="stylesheet" href="./style.css">
</head>
<body class="dark:bg-gray-700">
<div class="max-w-6xl p-10 mx-auto bg-indigo-600 rounded-md shadow-md dark:bg-gray-800 mt-5">
    <h1 class="text-xl font-bold text-white capitalize text-center dark:text-white">Comments</h1>

    <div class="flex justify-between py-5 ">
        <a href="index.php"
           class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Home</a>

        <a href="index.php"
           class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add
            Book</a>
    </div>

    <hr class="h-1 mx-auto bg-gray-100 border-0 rounded md:my-10 dark:bg-gray-700">

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        Commentary

                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        User ID

                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        Status Comm

                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Edit</span>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($comments as $c): ?>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <?= $c['id'] ?>
                    </td>
                    <td class="px-6 py-4">
                        <?= $c['commentary'] ?>
                    </td>
                    <td class="px-6 py-4">
                        <?= $c['user_id'] ?>
                    </td>
                    <td class="px-6 py-4">
                        <?= $c['status_comm'] ?>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                           href="adminComments.php?action=approve&id=<?= $c['id'] ?>">Approve</a>
                        <a class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                           href="adminComments.php?action=delete&id=<?= $c['id'] ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div>
</body>
</html>
