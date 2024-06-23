<?php

session_start();
require_once 'Backend/Classes/DbConnection.php';
require_once 'Backend/Classes/Author.php';

use backEnd\Classes\DbConnection;

$dbConnection = new DbConnection();
$db = $dbConnection->getDbConnection();
$authorService = new Author($db);

$authors = $authorService->getAllAuthors();

$isEditing = isset($_GET['id']);
$editingAuthor = $isEditing ? $authorService->getAuthorById($_GET['id']) : null;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Author</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <link rel="stylesheet" href="./style.css">
</head>
<body class="dark:bg-gray-700">


<section class="max-w-6xl p-10 mx-auto bg-indigo-600 rounded-md shadow-md dark:bg-gray-800 mt-20 ">
    <h1 class="text-xl font-bold text-gray-800 dark:text-white capitalize text-center mb-6">Author </h1>
    <hr class="h-1 bg-gray-200 dark:bg-gray-600 border-0 rounded mb-8">

    <div class="flex justify-between py-5">
        <a href="index.php"
           class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Home</a>
        <a href="category.php"
           class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Category</a>
        <a href="adminPanel.php"
           class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add
            Book</a>
    </div>


    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="bg-red-500 text-white px-4 py-2 my-4 rounded-md text-center">
            <?= $_SESSION['error_message'] ?>
        </div>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

    <?php

    if (isset($_SESSION['success_message'])) {
        echo '<div class="text-green-500 text-center py-3 ">' . $_SESSION['success_message'] . '</div>';
        unset($_SESSION['success_message']);
    }

    ?>
    <!-- Author Form -->
    <form action="handleAuthor.php" method="POST" class="w-full mb-8">
        <input type="hidden" name="author_id" value="<?= $isEditing ? htmlspecialchars($editingAuthor['id']) : '' ?>">
        <div class="grid grid-cols-1 gap-y-4 sm:grid-cols-2 sm:gap-x-8">
            <div class="flex flex-col">
                <label for="author_name" class="text-gray-800 dark:text-gray-200">First Name</label>
                <input id="author_name" name="author_name" type="text"
                       value="<?= $isEditing ? htmlspecialchars($editingAuthor['author_name']) : '' ?>" required
                       class="block w-full px-4 py-2 mt-2 text-gray-800 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
            </div>

            <div class="flex flex-col">
                <label for="author_lastname" class="text-gray-800 dark:text-gray-200">Last Name</label>
                <input id="author_lastname" name="author_lastname" type="text"
                       value="<?= $isEditing ? htmlspecialchars($editingAuthor['author_lastname']) : '' ?>" required
                       class="block w-full px-4 py-2 mt-2 text-gray-800 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
            </div>

            <div class="col-span-2 flex flex-col">
                <label for="biography" class="text-gray-800 dark:text-gray-200">Biography</label>
                <textarea id="biography" name="biography" required
                          class="block w-full px-4 py-2 mt-2 text-gray-800 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring h-32"><?= $isEditing ? htmlspecialchars($editingAuthor['biography']) : '' ?></textarea>
            </div>
        </div>

        <div class="flex justify-end mt-6 space-x-4">
            <input type="submit" name="action" value="<?= $isEditing ? 'Update Author' : 'Create Author' ?>"
                   class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm py-2 px-5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 cursor-pointer">
        </div>
    </form>

    <div>
        <h2 class="text-gray-800 dark:text-white text-center text-lg font-semibold mb-4">Existing Authors:</h2>
        <ul>
            <?php if (!empty($authors)): ?>
                <ul class="text-white">
                    <?php foreach ($authors as $author): ?>
                        <hr class="h-1 bg-gray-200 dark:bg-gray-600 border-0 rounded my-4">
                        <li class="flex justify-between items-center">
                            <span class="text-gray-800 dark:text-white"><?= htmlspecialchars($author['author_name'] . ' ' . $author['author_lastname']) ?></span>
                            <div class="flex items-center">
                                <form action="handleAuthor.php" method="POST" class="mr-2">
                                    <input type="hidden" name="author_id"
                                           value="<?= htmlspecialchars($author['id']) ?>">
                                    <input type="submit" name="action" value="Delete"
                                           class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 cursor-pointer">
                                </form>
                                <a href="author.php?id=<?= htmlspecialchars($author['id']) ?>"
                                   class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 cursor-pointer">
                                    Edit
                                </a>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-gray-800 dark:text-white text-center mt-4">No authors found.</p>
            <?php endif; ?>
        </ul>
    </div>
</section>
</body>

</html>
