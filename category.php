<?php
session_start();
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

    <link rel="stylesheet" href="./style.css">
</head>
<body class="dark:bg-gray-700">

<section class="max-w-6xl p-10 mx-auto bg-indigo-600 rounded-md shadow-md dark:bg-gray-800 mt-20">
    <h1 class="text-xl font-bold text-white capitalize text-center dark:text-white">Category</h1>
    <hr class="h-1 mx-auto bg-gray-100 border-0 rounded md:my-10 dark:bg-gray-700">
    <div class="flex justify-between">
        <a href="index.php"
           class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Home</a>
        <a href="author.php"
           class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Author</a>
        <a href="adminPanel.php"
           class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add
            Book</a>
    </div>

    <?php

    if (isset($_SESSION['error_message'])): ?>
        <div class=" mt-5 text-red-500 bg-white py-5 px-5 max-w-2xl gap-4 p-10 mx-auto text-center mt-20">
            <?php
            echo htmlspecialchars($_SESSION['error_message']);
            unset($_SESSION['error_message']);
            ?>
        </div>
    <?php endif; ?>

    <form action="handleCategory.php" method="post">
        <div class="mt-5">
            <label class="text-white dark:text-gray-200" for="category">Category</label>
            <input type="text" name="category" id="category"
                   class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
        </div>

        <input type="submit" name="action" value="Create"
               class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm py-2 px-2 mt-5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
    </form>

    <div class="mt-5">
        <h2 class="text-white text-center ">Existing Categories:</h2>
        <hr class="h-1 mx-auto bg-gray-100 border-0 rounded md:my-10 dark:bg-gray-700">

        <ul class="text-white">
            <?php
            require_once 'Backend/Classes/DbConnection.php';
            require_once 'Backend/Classes/Category.php';

            use backEnd\Classes\DbConnection;
            use backEnd\Classes\Category;

            $dbConnection = new DbConnection();
            $db = $dbConnection->getDbConnection();
            $categoryObj = new Category($db);
            $categories = $categoryObj->getCategories();

            if (!empty($categories)) {
                foreach ($categories as $cat) {
                    echo '<li class="flex justify-between mt-2">';
                    echo htmlspecialchars($cat['category']);
                    echo '<form action="handleCategory.php" method="post" class="flex items-center">';
                    echo '<input type="hidden" name="category_id" value="' . htmlspecialchars($cat['id']) . '">';
                    echo '<input type="hidden" name="category" value="' . htmlspecialchars($cat['category']) . '">';
                    echo '<input type="submit" name="action" value="Delete" class="ml-2 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm py-2 px-5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">';
                    echo '</form>';
                    echo '</li>';
                }
            } else {
                echo '<li>No categories found.</li>';
            }
            ?>
        </ul>
    </div>
</section>
</body>
</html>

</body>
</html>
