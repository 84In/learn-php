<?php

namespace App\Controllers;

# Nhập các class cần thiết
use App\Services\Todo as TodoService;

class TodoController
{
    #Khai báo thuộc tính
    private $todoService;

    #Khởi tạo
    public function __construct()
    {
        # Lấy cấu hình DB từ file config
        $config = require __DIR__ . '/../../config/config.php';
        # Khởi tạo service
        $this->todoService = new TodoService($config['db']);
    }

    # Phương thức hiển thị danh sách công việc
    public function index()
    {
        $todos = $this->todoService->getAllTodos();
        require __DIR__ . '/../Views/todos.php';
    }

    # Phương thức hiển thị form tạo công việc
    public function create()
    {
        require __DIR__ . '/../Views/create.php';
    }

    # Phương thức xử lý lưu công việc mới
    public function store()
    {
        try {
            $this->todoService->createTodo($_POST['title'], $_POST['description']);
            header("Location: /todos");
            exit;
        } catch (\Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
}
