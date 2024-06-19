<?php

session_start();

require_once 'Backend/Classes/DbConnection.php';
require_once 'Backend/Classes/category.php';

use backEnd\Classes\DbConnection;

$dbConnection = new DbConnection();
$db = $dbConnection->getDbConnection();
$categoryService = new \backEnd\Classes\Category($db);

$action = $_POST['action'] ?? '';
$categoryName = $_POST['category'] ?? '';
$categoryId = $_POST['category_id'] ?? '';

try {
    if ($action === 'Create' && $categoryName) {
        $categoryService->createCategory($categoryName);
        $_SESSION['success_message'] = "Category '{$categoryName}' created successfully.";
    } elseif ($action === 'Edit' && $categoryId && $categoryName) {
        $categoryService->updateCategory($categoryId, $categoryName);
        $_SESSION['success_message'] = "Category '{$categoryName}' updated successfully.";
    } elseif ($action === 'Delete' && $categoryId) {
        $categoryService->deleteCategory($categoryId);
        $_SESSION['success_message'] = "Category deleted successfully.";
    }

    header('Location: category.php');
    exit;
} catch (\Exception $e) {
    $_SESSION['error_message'] = $e->getMessage();
    error_log($e->getMessage());
    header("Location: category.php");
    exit;
}