<?php

namespace backEnd\Classes;

require_once("dbConnection.php");

class LoginUser
{
    protected \PDO $_db;

    public function __construct(\PDO $db)
    {
        $this->_db = $db;
    }

    public function login($email, $password)
    {

        $adminEmail = "admin@admin.com";
        $adminPasswordHash = password_hash("Admin1234a", PASSWORD_DEFAULT);

        if ($email === $adminEmail) {
            if (password_verify($password, $adminPasswordHash)) {
                return true;
            } else {
                return "Incorrect password";
            }
        }

        $stmt = $this->_db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$user) {
            return "User not found";
        }

        if (password_verify($password, $user['password'])) {

            return true;
        }
        return "Incorrect password";


    }
}
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $dbConnection = new DbConnection();
    $db = $dbConnection->getDbConnection();
    $loginUser = new LoginUser($db);
    $email = $_POST["email"];
    $password = $_POST["password"];
    $result = $loginUser->login($email, $password);

    if ($result === true) {
        $_SESSION['success_message'] = "Logged in successfully";
        header("Location: ../../index.php");
    } else {
        $_SESSION['error_message'] = $result;
        header("Location: ../../login.php");
    } exit;


}

