<?php

namespace backEnd\Classes;
session_start();

require_once("./dbConnection.php");

class SignUpUser
{
    protected \PDO $_db;

    public function __construct(\PDO $db)
    {
        $this->_db = $db;
    }

    public function signUp($email, $password)
    {

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Invalid email format";
        }


        if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/", $password)) {
            return "Invalid password format. Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number";
        }


        $stmt = $this->_db->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $count = $stmt->fetchColumn();
        if ($count > 0) {
            return "Email already exists";
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


        $stmt = $this->_db->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        if (!$stmt->execute([$email, $hashedPassword])) {
            return "Failed to register user. Please try again later.";
        }

        return true;
    }
}




if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create"])) {
    $dbConnection = new DbConnection();
    $db = $dbConnection->getDbConnection();
    $signUp = new SignUpUser($db);
    $email = $_POST["email"];
    $password = $_POST["password"];
    $result = $signUp->signUp($email, $password);

    if ($result === true) {
        $_SESSION['success_message'] = "<div class='bg-white py-2 px-2 rounded'>Successfully signed up. Welcome!</div>";
        header("Location: ../../index.php");
        exit;
    } else {
        $_SESSION['error_message'] = $result;
        header("Location: ../../signup.php");
        exit;
    }
}


