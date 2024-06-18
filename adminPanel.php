
<?php

//require_once 'category.php';

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
<!---->
<!--    <section class="max-w-6xl p-10 mx-auto bg-indigo-600 rounded-md shadow-md dark:bg-gray-800 mt-20">-->
<!--        <h1 class="text-xl font-bold text-white capitalize text-center dark:text-white">Add Book</h1>-->
<!--        <hr class="h-1 mx-auto bg-gray-100 border-0 rounded md:my-10 dark:bg-gray-700">-->
<!--        <div class="flex justify-between py-5">-->
<!--            <!-- Navigation buttons -->-->
<!--        </div>-->
<!--        <form method="post">-->
<!--            <!-- Form fields -->-->
<!--            <input type="hidden" name="action" value="add">-->
<!--            <input type="submit" value="Add book" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">-->
<!--        </form>-->
<!--    </section>-->





        <form class="max-w-6xl p-10 mx-auto bg-indigo-600 rounded-md shadow-md dark:bg-gray-800 mt-20" method="POST">
            <h1 class="text-xl font-bold text-white capitalize  text-center dark:text-white">Add Book</h1>
            <hr class=" h-1 mx-auto bg-gray-100 border-0 rounded md:my-10 dark:bg-gray-700">


            <div class="flex justify-between  py-5">

                <a href="index.php"
                   class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Home</a>
                <a href="author.php"
                   class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Author</a>
                <a href="category.php"
                   class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Category</a>
            </div>

            <div class=" grid-cols-2 gap-10 mt-4 sm:grid-cols-1 mt-5 ">
                <div>
                    <label class="text-white dark:text-gray-200" for="title">Book Title</label>
                    <input id="title" name="title" type="text"
                           class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                </div>

                <div>
                    <label class="text-white dark:text-gray-200" for="cover">Image Url</label>
                    <input id="cover" name="cover" type="text"
                           class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                </div>

                <div>
                    <label class="text-white dark:text-gray-200" for="biography">Biography</label>
                    <input id="biography" type="text"
                           class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                </div>

                <div>
                    <label class="text-white dark:text-gray-200" for="pages">Pages</label>
                    <input id="pages" name="pages" type="number"
                           class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                </div>

                <div>
                    <label class="text-white dark:text-gray-200" for="year_publication">Published</label>
                    <input id="year_publication" name="year_publication" type="number"
                           class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                </div>

                <div>
                    <label class="text-white dark:text-gray-200" for="author_id">Author</label>
                    <label>
                        <select id="author_id" name="author_id"
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                        </select>
                    </label>
                </div>

                <div>
                    <label class="text-white dark:text-gray-200" for="category_id">Category</label>
                    <label>
                        <select id="category_id" name="category_id"
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                        </select>
                    </label>
                </div>


                <input type="submit" value="Add book"
                       class="text-white  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <input type="submit" value="Delete"
                       class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm py-2 px-5 mt-5   text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <input type="submit" value="Edit"
                       class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm py-2 px-5 mt-5   text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">

        </form>



    </body>
    </html>
