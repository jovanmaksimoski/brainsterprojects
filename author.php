<?php
require_once 'backEnd/Classes/DbConnection.php';
require_once 'backEnd/Classes/Author.php';

$db = (new \backEnd\Classes\DbConnection())->getDbConnection();
$authorObj = new \backEnd\Classes\Author($db);

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create'])) {
        $name = $_POST['name'];
        $authorObj->createAuthor($name);
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $authorObj->deleteAuthor($id);
    } elseif (isset($_POST['edit'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $authorObj->updateAuthor($id, $name);
    }
}

// Fetch authors from database
$authors = $authorObj->getAuthors();
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

<!-- component -->
<section class="max-w-6xl p-10 mx-auto bg-indigo-600 rounded-md shadow-md dark:bg-gray-800 mt-20 ">
    <h1 class="text-xl font-bold text-white capitalize  text-center dark:text-white">Author</h1>
    <hr class=" h-1 mx-auto bg-gray-100 border-0 rounded md:my-10 dark:bg-gray-700">
    <div class="flex justify-between ">

        <a href="index.php"
           class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Home</a>
        <a href="category.php"
           class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Category</a>
        <a href="adminPanel.php"
           class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add
            Book</a>

    </div>

    <form class="w-full ">
        <div class="mt-10">
            <div class="col-4">
                <label class="text-white dark:text-gray-200" for="book">Name</label>
                <input id="author_name" type="text"
                       class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
            </div>

            <div>
                <label class="text-white dark:text-gray-200" for="emailAddress">Last Name</label>
                <input id="author_lastname" type="text"
                       class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
            </div>

            <div>
                <label class="text-white dark:text-gray-200" for="password">Biography</label>
                <input id="biography" type="text"
                       class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
            </div>

        </div>


        <input type="submit" value="Create author"
               class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm py-2 px-2 mt-5   text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        <input type="submit" value="Delete"
               class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm py-2 px-5 mt-5   text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">

        <input type="submit" value="Edit"
               class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm py-2 px-5 mt-5   text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">


    </form>
</section>


</body>
</html>
