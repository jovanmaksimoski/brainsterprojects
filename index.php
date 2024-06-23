<?php
session_start();
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Brainster Library</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!--    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>-->
    <link rel="stylesheet" href="./style.css">
</head>
<body class="scroll-smooth dark:bg-gray-900">

<!-- Nav Bar -->
<nav class="bg-white border-gray-200 dark:bg-gray-900">
    <div class="flex flex-wrap items-center justify-between p-4">
        <?php
        if (isset($_SESSION['success_message'])) {
            echo '<div class="text-green-500">' . $_SESSION['success_message'] . '</div>';
            unset($_SESSION['success_message']);
        }
        ?>
        <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="./img/dw.webp" class="h-12" alt="Brainster Logo"/>
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Brainster Library</span>
        </a>
        <div class="flex md:order-2 space-x-5 rtl:space-x-reverse">
            <?php
            if (isset($_SESSION['loggedIn'])) {
                if (isset($_SESSION['admin'])) {
                    echo '<a href="adminPanel.php" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Admin</a>';
                }
                echo '<a href="./logOut.php" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Logout</a>';
            } else {
                echo '<a href="signUp.php" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Sign Up</a>
                      <a href="login.php" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Log In</a>';
            }
            ?>
        </div>
    </div>
</nav>

<!-- Header section -->
<header class="div">
    <div class="bg-cover bg-center min-h-screen flex justify-center items-center">
        <div class="flex flex-col justify-center items-center">
            <a href="./login.php">
                <h1 class="text-white text-7xl text-center font-bold bg-dark-900 py-10 px-5 rounded underline">WELCOME TO THE BRAINSTER LIBRARY</h1>
            </a>
        </div>
        <button class="btn" id="scrollDownBtn"><i class="fa-solid fa-chevron-down fa-4x text-white"></i></button>
    </div>
</header>

<!-- Filters -->
<div class="flex flex-col items-center justify-center p-5 ">
    <button id="dropdownDefault" data-dropdown-toggle="dropdown" class="text-white bg-blue-700 hover:bg-blue-800 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800" type="button">
        Filter by category
        <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>
    <!-- Dropdown menu -->
    <div id="dropdown" class="z-10 hidden w-56 p-3 bg-white rounded-lg shadow dark:bg-gray-700 mt-5">
        <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Category</h6>
        <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
            <!-- Add more categories as needed -->
            <li class="flex items-center">
                <input id="html" type="checkbox" value="HTML" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"/>
                <label for="html" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">HTML</label>
            </li>
            <!-- Repeat for other categories -->
        </ul>
    </div>
</div>

<!-- Books section -->
<div class="dark:bg-gray-900 header md:flex-wrap cursor-pointer">

    <div class="gap-10 flex flex-row justify-center items-center img">
        <?php foreach ($books as $book) : ?>
            <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 book-card" data-book='<?= json_encode($book) ?>'>
                <a >
                    <img class="rounded-t-lg" src="<?= htmlspecialchars($book['cover']) ?>" alt=""/>
                </a>
                <hr>
                <div class="p-5">
                    <a >
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center"><?= htmlspecialchars($book['title']) ?></h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Author: <?= htmlspecialchars($book['author_name']) . ' ' . htmlspecialchars($book['author_lastname']) ?></p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Category: <?= htmlspecialchars($book['category']) ?></p>
<!--                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Published: --><?php //= htmlspecialchars($book['year_publication']) ?><!--</p>-->
<!--                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Pages: --><?php //= htmlspecialchars($book['pages']) ?><!--</p>-->
                </div>
                <div class="flex justify-end p-5">
                    <a id="cart-button" href="viewCart.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">View Cart</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>



<div id="cart-modal" class="fixed z-50 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg p-10 max-w-4xl w-full">
            <div class="flex justify-end">
                <button id="close-modal" class="text-red-500 font-bold">X</button>
            </div>
            <div id="cart-content" class="mt-5">
                <!-- Existing modal content -->
                <div id="comment-list">
                    <!-- Fetch comments using book id -->
                    <?php
                    // Assuming $comment is already instantiated and you have the book ID
                    // $comments = $comment->getCommentsByBookId($bookId);
                    // Display comments here
                    ?>
                </div>
            </div>
            <div class="mt-5">
                <button id="add-comment" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Comment</button>
                <button id="add-note" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Note</button>
            </div>

            <form id="comment-form" class="mt-5 hidden text-white" action="saveComment.php" method="POST">
                <label for="comment-text">Leave a comment</label>
                <textarea id="comment-text" name="commentary" class="w-full p-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white"></textarea>
                <input type="hidden" id="comment-book-id" name="book_id" value="">
                <input type="hidden" name="user_id" value="<?= htmlspecialchars($_SESSION['userId']) ?>">
                <button type="submit" name="action" value="create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-3">Submit Comment</button>
            </form>
            <form id="note-form" class="mt-5 hidden text-white" action="saveNote.php" method="POST">
                <label for="note-text">Note</label>
                <textarea id="note-text" name="note-text" class="w-full p-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white"></textarea>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-3">Submit Note</button>
            </form>
        </div>
    </div>
</div>
<!-- Meta tags, Tailwind CSS, jQuery -->
<!-- footer -->
<footer class="bg-white rounded-lg shadow dark:bg-gray-900 m-4">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8"></div>
    <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8"/>
    <div id="quote" class="text-sm text-gray-500 sm:text-center dark:text-gray-400 text-center"></div>
</footer>

<script src="javaScript/chervronAnimate.js"></script>
<script src="javaScript/filter.js"></script>
<script src="javaScript/quote.js"></script>
</body>
</html>
