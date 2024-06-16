<?php

session_start();
?>

<!doctype html>
<html lang="en">
<head>


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
              integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
              crossorigin="anonymous" referrerpolicy="no-referrer"/>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Brainster Library</title>

        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <link rel="stylesheet" href="./style.css">
    </head>
    <body class="scroll-smooth dark:bg-gray-900">


<!--Nav Bar -->
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
                    echo '<a href="./adminPanel"
                   class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Admin
                </a>';

                }
                echo

                '<a href="./logOut.php"
                   class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Logout
                </a>';

            } else {
                echo '   <a href="signUp.php"
                   class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Sign Up
                </a>
                <a href="login.php"
                   class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Log In
                </a>';
            }
            ?>

        </div>
    </div>
</nav>

<!--Header section -->

<header class="div">
    <div class="bg-cover bg-center min-h-screen flex justify-center items-center">
        <div class="flex flex-col justify-center items-center">
            <a href="./login.php"><h1
                        class="text-white text-7xl text-center font-bold bg-dark-900 py-10 px-5  rounded underline"></a>
            WELCOME TO THE BRAINSTER LIBRARY</h1>
        </div>
        <button class="btn" id="scrollDownBtn"><i class="fa-solid fa-chevron-down fa-4x text-white"></i></button>
    </div>
</header>


<!--filters -->

<div class="flex flex-col items-center justify-center p-5 ">
    <button id="dropdownDefault" data-dropdown-toggle="dropdown"
            class=" text-white bg-blue-700 hover:bg-blue-800  hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
            type="button">
        Filter by category
        <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24"
             xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>

    <!-- Dropdown menu -->
    <div id="dropdown" class="z-10 hidden w-56 p-3 bg-white rounded-lg shadow dark:bg-gray-700 mt-5">
        <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">
            Category
        </h6>
        <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
            <li class="flex items-center">
                <input id="apple" type="checkbox" value=""
                       class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"/>

                <label for="apple" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                    HTML
                </label>
            </li>

            <li class="flex items-center">
                <input id="fitbit" type="checkbox" value=""
                       class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"/>

                <label for="fitbit" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                    CSS
                </label>
            </li>

            <li class="flex items-center">
                <input id="dell" type="checkbox" value=""
                       class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"/>

                <label for="dell" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                    PHP
                </label>
            </li>

            <li class="flex items-center">
                <input id="asus" type="checkbox" value="" checked
                       class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"/>

                <label for="asus" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                    JavaScript
                </label>
            </li>

            <li class="flex items-center">
                <input id="logitech" type="checkbox" value="" checked
                       class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"/>

                <label for="logitech" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                    Laravel
                </label>
            </li>

            <li class="flex items-center">
                <input id="msi" type="checkbox" value="" checked
                       class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"/>

                <label for="msi" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                    Java
                </label>
            </li>

            <li class="flex items-center">
                <input id="bosch" type="checkbox" value="" checked
                       class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"/>

                <label for="bosch" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                    C#
                </label>
            </li>

        </ul>
    </div>
</div>
<!--book  section -->

<div class="dark:bg-gray-900 header md:flex-wrap">
    <div class=" gap-10 flex flex-row  justify-center items-center">
        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="#">
                <img class="rounded-t-lg" src="./img/dw.webp" alt=""/>
>>>>>>> login_page
            </a>
            <div class="flex md:order-2 space-x-5 rtl:space-x-reverse">
                <?php if (isset($_SESSION['user'])):
                    if (isset($_SESSION['success_message'])) {
                        echo '<div class="bg-green-200 text-green-800 p-4 mb-4">' . $_SESSION['success_message'] . '</div>';
                        unset($_SESSION['success_message']);
                    }
                    ?>
                    <a href="logOut.php"
                       class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Logout
                    </a>

                <?php else: ?>
                    <a href="signUp.php"
                       class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Sign Up
                    </a>
                    <a href="login.php"
                       class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Log In
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!--Header section -->

    <header class="div">
        <div class="bg-cover bg-center min-h-screen flex justify-center items-center">
            <div class="flex flex-col justify-center items-center">
                <a href="./login.php"><h1
                            class="text-white text-7xl text-center font-bold bg-dark-900 py-10 px-5  rounded underline"></a>
                WELCOME TO THE BRAINSTER LIBRARY</h1>
            </div>
            <button class="btn" id="scrollDownBtn"><i class="fa-solid fa-chevron-down fa-4x text-white"></i></button>
        </div>
    </header>



    <!--filters -->

    <div class="flex flex-col items-center justify-center p-5 ">
        <button id="dropdownDefault" data-dropdown-toggle="dropdown"
                class=" text-white bg-blue-700 hover:bg-blue-800  hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                type="button">
            Filter by category
            <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>

        <!-- Dropdown menu -->
        <div id="dropdown" class="z-10 hidden w-56 p-3 bg-white rounded-lg shadow dark:bg-gray-700 mt-5">
            <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">
                Category
            </h6>
            <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
                <li class="flex items-center">
                    <input id="apple" type="checkbox" value=""
                           class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"/>

                    <label for="apple" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                        HTML
                    </label>
                </li>

                <li class="flex items-center">
                    <input id="fitbit" type="checkbox" value=""
                           class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"/>

                    <label for="fitbit" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                        CSS
                    </label>
                </li>

                <li class="flex items-center">
                    <input id="dell" type="checkbox" value=""
                           class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"/>

                    <label for="dell" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                        PHP
                    </label>
                </li>

                <li class="flex items-center">
                    <input id="asus" type="checkbox" value="" checked
                           class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"/>

                    <label for="asus" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                        JavaScript
                    </label>
                </li>

                <li class="flex items-center">
                    <input id="logitech" type="checkbox" value="" checked
                           class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"/>

                    <label for="logitech" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                        Laravel
                    </label>
                </li>

                <li class="flex items-center">
                    <input id="msi" type="checkbox" value="" checked
                           class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"/>

                    <label for="msi" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                        Java
                    </label>
                </li>

                <li class="flex items-center">
                    <input id="bosch" type="checkbox" value="" checked
                           class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"/>

                    <label for="bosch" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                        C#
                    </label>
                </li>

            </ul>
        </div>
    </div>
    <!--book  section -->

    <div class="dark:bg-gray-900 header md:flex-wrap">
        <div class=" gap-10 flex flex-row  justify-center items-center">
            <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                    <img class="rounded-t-lg" src="./img/dw.webp" alt=""/>
                </a>
                <hr>

                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center">Book
                            Title</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Author:</p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Category:</p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Biography:</p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Published:</p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Pages:</p>
                </div>
            </div>


            <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                    <img class="rounded-t-lg" src="./img/dw.webp" alt=""/>
                </a>
                <hr>

                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center">Book
                            Title
                        </h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Author:</p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Category:</p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Biography:</p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Published:</p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Pages:</p>

                </div>
            </div>


            <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                    <img class="rounded-t-lg" src="./img/dw.webp" alt=""/>
                </a>
                <hr>

                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center">Book
                            Title
                        </h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Author:</p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Category:</p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Biography:</p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Published:</p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Pages:</p>
                </div>
            </div>


        </div>


        <div class="dark:bg-gray-900 header md:flex-wrap py-5">
            <div class=" gap-10 flex flex-row  justify-center items-center">
                <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 py-2">
                    <a href="#">
                        <img class="rounded-t-lg" src="./img/dw.webp" alt=""/>
                    </a>
                    <hr>
                    <div class="p-5">
                        <a href="#">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center">
                                Book Title</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Author:</p>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Category:</p>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Biography:</p>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Published:</p>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Pages:</p>
                    </div>
                </div>


                <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a href="#">
                        <img class="rounded-t-lg" src="./img/dw.webp" alt=""/>
                    </a>
                    <hr>

                    <div class="p-5">
                        <a href="#">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center">
                                Book Title
                            </h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Author:</p>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Category:</p>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Biography:</p>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Published:</p>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Pages:</p>

                    </div>
                </div>


                <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a href="#">
                        <img class="rounded-t-lg" src="./img/dw.webp" alt=""/>
                    </a>
                    <hr>

                    <div class="p-5">
                        <a href="#">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center">
                                Book Title
                            </h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Author:</p>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Category:</p>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Biography:</p>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Published:</p>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Pages:</p>
                    </div>
                </div>


            </div>

            <!--footer -->

            <footer class="bg-white rounded-lg shadow dark:bg-gray-900 m-4">
                <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
                </div>
                <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8"/>
                <div id="quote" class="text-sm text-gray-500 sm:text-center dark:text-gray-400 text-center"></div>
            </footer>


            <script src="javaScript/chervronAnimate.js"></script>
            <script src="javaScript/filter.js"></script>
            <script src="javaScript/quote.js"></script>

    </body>
    </html>

