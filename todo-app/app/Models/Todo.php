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
        $stmt = $this->db->query("SELECT * FROM todos");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    # Tạo công việc mới
    public function creatTodo($title, $description)
    {
        $stmt = $this->db->prepare("INSERT INTO todos (title, description) VALUES (:title, :description)");
        return $stmt->execute(['title' => $title, 'description' => $description]);
    }
}
