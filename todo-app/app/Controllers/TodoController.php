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

    #Xoá công việc
    public function delete($id)
    {
        try {
            $this->todoService->deleteTodo($id);
            header("Location: /todos");
            exit;
        } catch (\Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    # Chỉnh sửa công việc
    public function edit($id)
    {
        try {
            # Lấy thông tin công việc theo ID từ service
            $todo = $this->todoService->getTodoById($id);

            # Nếu không tìm thấy công việc, hiển thị thông báo lỗi
            if (!$todo) {
                echo "Công việc không tồn tại.";
                return;
            }

            # Gọi view edit.php và truyền biến $todo xuống
            require __DIR__ . '/../Views/edit.php';
        } catch (\Exception $e) {
            # Nếu có lỗi trong quá trình xử lý, hiển thị lỗi ra màn hình
            echo "Lỗi: " . $e->getMessage();
        }
    }


    public function update($id)
    {
        try {
            $this->todoService->updateTodo($id, $_POST['title'], $_POST['description']);
            header("Location: /todos");
            exit;
        } catch (\Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
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
