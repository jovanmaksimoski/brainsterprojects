<?php

namespace backEnd\Classes;



class logOut
{
    public function logout()
    {
        session_start();
        $_SESSION = array();
        session_destroy();
        header("Location: ../../login.php");
        exit;
    }
}
// Check if logout button is clicked
if (isset($_POST["logout"])) {
    $logoutUser = new logOut();
    $logoutUser->logout();
}

