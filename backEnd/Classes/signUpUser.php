<?php

namespace backEnd\Classes;

require_once ("backEnd/Classes/dbConnection.php");
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
        $stmt->execute([$email, $hashedPassword]);

        return true;

//        echo  "User registered successfully";

    }
}

//if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create"])) {
//    $dbConnection = new DbConnection();
//    $db = $dbConnection->getDbConnection();
//    $signUp = new SignUpUser($db);
//    $email = $_POST["email"];
//    $password = $_POST["password"];
//    $result = $signUp->signUp($email, $password);
//
//    return $result;
//}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create"])) {
    $dbConnection = new DbConnection();
    $db = $dbConnection->getDbConnection();
    $signUp = new SignUpUser($db);
    $email = $_POST["email"];
    $password = $_POST["password"];
    $result = $signUp->signUp($email, $password);

    if ($result === true) {
        // Redirect to index page on successful sign-up
       return header("Location: ./index.php?");

    }
}