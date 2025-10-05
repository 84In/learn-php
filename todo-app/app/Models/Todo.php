<?php

namespace App\Models;

#Sử dụng class Database để kết nối CSDL
use App\Core\Database;
use PDO;

class Todo
{
    # Kết nối CSDL
    private $db;

    # Hàm khởi tạo kết nối CSDL
    public function __construct($config)
    {
        $this->db = Database::getInstance($config);
    }

    # Lấy tất cả công việc
    public function getAll()
    {
        try {
            $stmt = $this->db->query("SELECT * FROM todos");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Database error [getAll]: " . $e->getMessage());
            return [];
        }
    }

    # Lấy công việc theo ID
    public function getByID($id)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM todos WHERE id = :id");
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Database error [getByID]: " . $e->getMessage());
            return null;
        }
    }

    # Cập nhật công việc theo ID
    public function updateTodo($id, $title, $description)
    {
        try {
            $stmt = $this->db->prepare("UPDATE todos SET title = :title, description = :description WHERE id = :id");
            return $stmt->execute(['id' => $id, 'title' => $title, 'description' => $description]);
        } catch (\PDOException $e) {
            error_log("Database error [updateTodo]: " . $e->getMessage());
            return false;
        }
    }

    # Tạo công việc mới
    public function createTodo($title, $description)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO todos (title, description) VALUES (:title, :description)");
            $stmt->execute(['title' => $title, 'description' => $description]);
            return $this->db->lastInsertId();
        } catch (\PDOException $e) {
            error_log("Database error [createTodo]: " . $e->getMessage());
            return false;
        }
    }

    # Xoá công việc theo ID
    public function deleteTodo($id)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM todos WHERE id = :id");
            return $stmt->execute(['id' => $id]);
        } catch (\PDOException $e) {
            error_log("Database error [deleteTodo]: " . $e->getMessage());
            return false;
        }
    }
}
