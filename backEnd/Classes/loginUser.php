<?php

session_start();

require_once("dbConnection.php");

use backEnd\Classes\DbConnection;

class LoginUser
{
    protected \PDO $_db;

    public function __construct(\PDO $db)
    {
        $this->_db = $db;
    }

    public function login($email, $password)
    {
        $stmt = $this->_db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$user) {
            $_SESSION['error_message'] = "User not found";
            return false;
        }

        if ($user['email'] == 'admin@gmail.com') {
            $_SESSION['admin'] = true;
        }

        if (password_verify($password, $user['password'])) {

//            $_SESSION['userId'] = $user['id'];
//            $_SESSION['user'] = $user;
            return true;


        } else {
            $_SESSION['error_message'] = "Incorrect password";
            return false;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $dbConnection = new DbConnection();
    $db = $dbConnection->getDbConnection();
    $loginUser = new LoginUser($db);
    $email = $_POST["email"];
    $password = $_POST["password"];
    $result = $loginUser->login($email, $password);


    if ($result === true) {
        $_SESSION['success_message'] = "<div class='bg-white py-2 px-2 rounded'>Logged in successfully</div>";
        $_SESSION['loggedIn'] = true;
        header("Location: ../../index.php");
        exit();
    } else {
        header("Location: ../../login.php");
        exit();
    }
}


