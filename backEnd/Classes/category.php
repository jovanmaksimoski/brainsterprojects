<?php
namespace backEnd\Classes;

require_once 'Backend/Classes/DbConnection.php';


namespace backEnd\Classes;

class Category
{
    protected \PDO $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function createCategory($category)
    {
        if ($this->categoryExists($category)) {
            throw new \Exception("Category already exists.");
        }

        $sql = "INSERT INTO category (category) VALUES (:category)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':category' => $category]);
    }

    public function getCategories()
    {
        $sql = "SELECT * FROM category WHERE soft_delete = 0";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function updateCategory($id, $category)
    {
        $sql = "UPDATE category SET category = :category WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':category' => $category, ':id' => $id]);
    }

    public function deleteCategory($id)
    {
        $sql = "UPDATE category SET soft_delete = 1 WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
    }

    private function categoryExists($category)
    {
        $sql = "SELECT COUNT(*) FROM category WHERE category = :category AND soft_delete = 0";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':category' => $category]);
        return $stmt->fetchColumn() > 0;
    }
}