<?php
session_start();

session_destroy();

$_SESSION['success_message'] = "<div class='bg-white py-2 px-2 rounded'>Logged out successfully</div>";
header("Location: ./index.php");
