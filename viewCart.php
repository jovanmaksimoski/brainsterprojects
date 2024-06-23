<?php
require_once 'backEnd/Classes/DbConnection.php';
require_once 'backEnd/Classes/Books.php';
require_once ('backEnd/Classes/Comment.php');


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

$books = $book->getAllBooks();

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
    <?php foreach ($books as $book) : ?>
        <div class="max-w-sm bg-white border img border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700" data-book='<?= json_encode($book['id']) ?>'>
            <a href="#">
                <img class="rounded-t-lg img" src="<?= htmlspecialchars($book['cover']) ?>" alt="Book Cover"/>
            </a>

            <div class="p-5 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 text-center">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><?= htmlspecialchars($book['title']) ?></h5>
                </a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Author: <?= htmlspecialchars($book['author_name']) . ' ' . htmlspecialchars($book['author_lastname']) ?></p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Category: <?= htmlspecialchars($book['category']) ?></p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Published: <?= htmlspecialchars($book['year_publication']) ?></p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Pages: <?= htmlspecialchars($book['pages']) ?></p>

                <button class="add-comment-btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Comment</button>
                <button class="add-note-btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Note</button>

                <!-- Comment form (initially hidden) -->
                <form class="comment-form mt-5 hidden text-white" action="saveComment.php" method="POST">
                    <label for="comment-text">Leave a comment</label>
                    <textarea id="comment-text" name="commentary" class="w-full p-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white"></textarea>
                    <input type="hidden" class="comment-book-id" name="book_id" value="<?= htmlspecialchars($book['id']) ?>">
                    <input type="hidden" name="user_id" value="<?= htmlspecialchars($_SESSION['user_id']) ?>">
                    <button type="submit" name="action" value="create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-3">Submit Comment</button>
                </form>

                <!-- Note form (initially hidden) -->
                <form class="note-form mt-5 hidden text-white" action="saveNote.php" method="POST">
                    <label for="note-text">Note</label>
                    <textarea id="note-text" name="note-text" class="w-full p-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white"></textarea>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-3">Submit Note</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addCommentBtns = document.querySelectorAll('.add-comment-btn');
        const addNoteBtns = document.querySelectorAll('.add-note-btn');
        const commentForms = document.querySelectorAll('.comment-form');
        const noteForms = document.querySelectorAll('.note-form');

        addCommentBtns.forEach((btn, index) => {
            btn.addEventListener('click', function (event) {
                event.preventDefault();
                commentForms[index].classList.toggle('hidden');
            });
        });

        addNoteBtns.forEach((btn, index) => {
            btn.addEventListener('click', function (event) {
                event.preventDefault();
                noteForms[index].classList.toggle('hidden');
            });
        });
    });
</script>

<!--    <div id="cart-modal" class="fixed z-50 inset-0 overflow-y-auto hidden">-->
<!---->
<!---->
<!---->
<!--        <div class="flex items-center justify-center min-h-screen">-->
<!---->
<!--            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg p-10 max-w-4xl w-full">-->
<!--                <div class="flex justify-end">-->
<!---->
<!--                    <button id="close-modal" class="text-red-500 font-bold">X</button>-->
<!--                </div>-->
<!--                <div id="cart-content" class="mt-5">-->
<!---->
<!--                    <!-- Existing modal content -->-->
<!--                    <div id="comment-list">-->
<!--                        <!-- Fetch comments using book id -->-->
<!--                        --><?php
//                        // Assuming $comment is already instantiated and you have the book ID
//                         $comments = $comment->getCommentsByBookId($bookId);
//                        // Display comments here
//                        ?>
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="mt-5">-->
<!--                    <button id="add-comment" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Comment</button>-->
<!--                    <button id="add-note" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Note</button>-->
<!--                </div>-->
<!---->
<!---->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<!--<div class="gap-10 flex flex-row justify-center items-center img dark:bg-gray-900 header md:flex-wrap cursor-pointer">-->
<!---->
<!---->
<!---->
<!--</div>-->

</body>
</html>
