<?php
session_start();

require_once 'backEnd/Classes/DbConnection.php';
require_once 'backEnd/Classes/Books.php';

use backEnd\Classes\DbConnection;
use backEnd\Classes\Books;

$dbConnection = new DbConnection();
$db = $dbConnection->getDbConnection();

$bookService = new Books($db);

$authors = $bookService->getAuthors();
$categories = $bookService->getCategories();


$books = $bookService->getAllBooks();

$isEditing = isset($_GET['id']);
$editingBook = $isEditing ? $bookService->getBookById($_GET['id']) : null;

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Book</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script

    <link rel="stylesheet" href="./style.css">
</head>
<body class="dark:bg-gray-700">
<div class="max-w-6xl p-10 mx-auto bg-indigo-600 rounded-md shadow-md dark:bg-gray-800 mt-5">
    <h1 class="text-xl font-bold text-white capitalize text-center dark:text-white">Add Books</h1>

    <div class="flex justify-between py-5">

        <a href="index.php"
           class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Home</a>
        <a href="adminComments.php"
           class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Comments</a>
        <a href="author.php"
           class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Author</a>
        <a href="category.php"
           class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Category</a>
    </div>

    <form method="POST" action="handleBooks.php">
        <hr class="h-1 mx-auto bg-gray-100 border-0 rounded md:my-10 dark:bg-gray-700">

        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="bg-red-500 text-white px-4 py-2 my-4 rounded-md text-center">
                <?= $_SESSION['error_message'] ?>
            </div>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="text-green-500 text-center py-3">
                <?= $_SESSION['success_message'] ?>
            </div>
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>

        <div class="grid grid-cols-2 gap-10 mt-4 sm:grid-cols-1 mt-5">
            <div>
                <label class="text-white dark:text-gray-200" for="title">Book Title</label>
                <input id="title" name="title" type="text"
                       value="<?= $isEditing ? htmlspecialchars($editingBook['title']) : '' ?>"
                       class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
            </div>

            <div>
                <label class="text-white dark:text-gray-200" for="cover">Image Url</label>
                <input id="cover" name="cover" type="text"
                       value="<?= $isEditing ? htmlspecialchars($editingBook['cover']) : '' ?>"
                       class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
            </div>

            <div>
                <label class="text-white dark:text-gray-200" for="pages">Pages</label>
                <input id="pages" name="pages" type="number"
                       value="<?= $isEditing ? htmlspecialchars($editingBook['pages']) : '' ?>"
                       class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
            </div>

            <div>
                <label class="text-white dark:text-gray-200" for="year_publication">Published</label>
                <input id="year_publication" name="year_publication" type="number"
                       value="<?= $isEditing ? htmlspecialchars($editingBook['year_publication']) : '' ?>"
                       class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
            </div>

            <div>
                <label class="text-white dark:text-gray-200" for="author_id">Author</label>
                <select id="author_id" name="author_id"
                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                    <?php
                    $authors = $bookService->getAuthors();
                    foreach ($authors as $author) {
                        $selected = $isEditing && $editingBook['author_id'] == $author['id'] ? 'selected' : '';
                        echo "<option value='{$author['id']}' {$selected}>{$author['author_name']} {$author['author_lastname']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div>
                <label class="text-white dark:text-gray-200" for="category_id">Category</label>
                <select id="category_id" name="category_id"
                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                    <?php
                    $categories = $bookService->getCategories();
                    foreach ($categories as $category) {
                        $selected = $isEditing && $editingBook['category_id'] == $category['id'] ? 'selected' : '';
                        echo "<option value='{$category['id']}' {$selected}>{$category['category']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mt-8">
                <input type="hidden" name="book_id"
                       value="<?= $isEditing ? htmlspecialchars($editingBook['id']) : '' ?>">
                <input type="submit" name="action" value="<?= $isEditing ? 'Edit Book' : 'Add Book' ?>"
                       class="cursor-pointer text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            </div>
    </form>

    <div>
        <h2 class="text-gray-800 dark:text-white text-center text-lg font-semibold mb-4">Existing Books:</h2>
        <ul>
            <?php if (!empty($books)): ?>
                <ul class="text-white">
                    <?php foreach ($books as $book): ?>
                        <hr class="h-1 bg-gray-200 dark:bg-gray-600 border-0 rounded my-4">
                        <li class="flex justify-between items-center">
                            <span class="text-gray-800 dark:text-white"><?= htmlspecialchars($book['title']) ?></span>
                            <div class="flex items-center">
                                <form action="handleBooks.php" method="POST" class="mr-2">
                                    <input type="hidden" name="book_id" value="<?= htmlspecialchars($book['id']) ?>">
                                    <input type="submit" name="action" value="Delete" id="Delete"
                                           class="cursor-pointer text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                </form>
                                <a href="adminPanel.php?id=<?= htmlspecialchars($book['id']) ?>"
                                   class="cursor-pointer text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit</a>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-gray-800 dark:text-white text-center mt-4">No books found.</p>
            <?php endif; ?>
        </ul>
    </div>
</div>
<script src="javaScript/sweetAlert.js"></script>
</body>
</html>
