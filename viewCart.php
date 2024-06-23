<?php
session_start();
require_once 'backEnd/Classes/DbConnection.php';
require_once 'backEnd/Classes/Books.php';
require_once('backEnd/Classes/Comment.php');


use backEnd\Classes\DbConnection;
use backEnd\Classes\Books;
use backEnd\Classes\Comment;


$dbConnection = new DbConnection();
$db = $dbConnection->getDbConnection();

$book = new Books($db);
$comment = new Comment($db);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                $book->createBook($_POST['title'], $_POST['cover'], $_POST['biography'], $_POST['pages'], $_POST['year_publication'], $_POST['author_id'], $_POST['category_id']);
                break;
            case 'edit':
                $book->updateBook($_POST['id'], $_POST['title'], $_POST['cover'], $_POST['biography'], $_POST['pages'], $_POST['year_publication'], $_POST['author_id'], $_POST['category_id']);
                break;
            case 'delete':
                $book->deleteBook($_POST['id']);
                break;
        }
    }
}

$books = $book->getBookById($_GET['id']);

$comments = $comment->getCommentsByBookId($_GET['id']);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="dark:bg-gray-900 header md:flex-wrap cursor-pointer">


<div class="dark:bg-gray-900 header cursor-pointer flex justify-center">
    <?php ?>
    <div class="max-w-sm bg-white border img border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
         data-book='<?= json_encode($books['id']) ?>'>
        <a href="#">
            <img class="rounded-t-lg img" src="<?= htmlspecialchars($books['cover']) ?>" alt="Book Cover"/>
        </a>

        <div class="p-5 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 text-center">
            <a href="#">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><?= htmlspecialchars($books['title']) ?></h5>
            </a>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                Author: <?= htmlspecialchars($books['author_name']) . ' ' . htmlspecialchars($books['author_lastname']) ?></p>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                Category: <?= htmlspecialchars($books['category']) ?></p>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                Published: <?= htmlspecialchars($books['year_publication']) ?></p>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                Pages: <?= htmlspecialchars($books['pages']) ?></p>

            <button class="add-comment-btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add
                Comment
            </button>
            <button class="add-note-btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Note
            </button>

            <form class="comment-form mt-5 hidden text-white" action="saveComment.php" method="POST">
                <label for="comment-text">Leave a comment</label>
                <textarea id="comment-text" name="commentary"
                          class="w-full p-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white"></textarea>
                <input type="hidden" class="comment-book-id" name="book_id"
                       value="<?= htmlspecialchars($books['id']) ?>">
                <input type="hidden" name="user_id" value="<?= $_SESSION['userId'] ?>">
                <button type="submit" name="action" value="create"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-3">Submit Comment
                </button>
            </form>

            <form class="note-form mt-5 hidden text-white" action="" method="POST">
                <label for="note-text">Note</label>
                <textarea id="note-text" name="note-text"
                          class="w-full p-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white"></textarea>
                <button id="note" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-3">
                    Submit Note
                </button>
            </form>
            <div id="display-note text-right  text-white mt-5">

            </div>
            <?php foreach ($comments as $comment): ?>

                <hr class="h-1 bg-gray-200 dark:bg-gray-600 border-0 rounded mb-8 mt-8">
                <p class="text-white text-left">UserID : <?= $comment['user_id'] ?></p>
                <p class="text-white text-left">Comment : <?= $comment['commentary'] ?></p>

                <?php
                $id = $comment['id'];

                ?>
                <form action="./saveComment.php" method="POST">

                    <input type="hidden" name="comment_id" value="<?= $id ?>">
                    <button type="submit" name="action" value="delete"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 flex flex-end rounded mt-3">
                        Delete Comment
                    </button>
                </form>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</div>
<script src="javaScript/notes.js"></script>
<script src="javaScript/viewCartButton.js"></script>


</body>
</html>
