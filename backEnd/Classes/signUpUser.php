<?php

namespace backEnd\Classes;

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


