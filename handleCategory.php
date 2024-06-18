<?php

//require_once 'Backend/Classes/DbConnection.php';
//require_once 'Backend/Classes/Category.php';
//
//use backEnd\Classes\DbConnection;
//use backEnd\Classes\Category;
//
//$dbConnection = new DbConnection();
//$db = $dbConnection->getDbConnection();
//$category = new Category($db);
//
//$action = $_POST['action'];
//$categoryName = $_POST['category'] ?? null;
//$categoryId = $_POST['category_id'] ?? null;
//
//try {
//    if ($action === 'Create' && $categoryName) {
//        $category->createCategory($categoryName);
//    } elseif ($action === 'Edit' && $categoryId && $categoryName) {
//        $category->updateCategory($categoryId, $categoryName);
//    } elseif ($action === 'Delete' && $categoryId) {
//        $category->deleteCategory($categoryId);
//    }
//
//    header('Location category.php');
//    exit;
//} catch (\Exception $e) {
//    $errorMessage = $e->getMessage();
//    error_log($errorMessage);
//    header("Location: category.php?error=" . urlencode($errorMessage));
//    exit;
//}

session_start();

require_once 'Backend/Classes/DbConnection.php';
require_once 'Backend/Classes/Category.php';

use backEnd\Classes\DbConnection;
use backEnd\Classes\Category;

$dbConnection = new DbConnection();
$db = $dbConnection->getDbConnection();
$category = new Category($db);

$action = $_POST['action'];
$categoryName = $_POST['category'] ?? null;
$categoryId = $_POST['category_id'] ?? null;

try {
    if ($action === 'Create' && $categoryName) {
        $category->createCategory($categoryName);
    } elseif ($action === 'Edit' && $categoryId && $categoryName) {
        $category->updateCategory($categoryId, $categoryName);
    } elseif ($action === 'Delete' && $categoryId) {
        $category->deleteCategory($categoryId);
    }

    header('Location: category.php');
    exit;
} catch (\Exception $e) {
    $_SESSION['error_message'] = $e->getMessage();
    error_log($e->getMessage());
    header("Location: category.php");
    exit;
}