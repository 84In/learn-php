<?php

namespace App\Services;

# Nhập các class cần thiết
use App\Models\Todo as TodoModel;
use Exception;
use InvalidArgumentException;

class Todo
{
    private $todoModel;

    public function __construct($config)
    {
        $this->todoModel = new TodoModel($config);
    }

    # Lấy tất cả công việc
    public function getAllTodos()
    {
        try {
            $result = $this->todoModel->getAll();
            return $result;
        } catch (Exception $e) {
            error_log("Service Error [getAllTodos]: " . $e->getMessage());
            return [];
        }
    }

    # Lấy công việc theo ID
    public function getTodoById($id)
    {
        try {
            if (!is_numeric($id) || $id <= 0) {
                throw new InvalidArgumentException("Invalid ID provided.");
            }
            $result = $this->todoModel->getById($id);
            if (!$result) {
                return ['error' => 'Todo not found.'];
            }
            return  $result;
        } catch (Exception | InvalidArgumentException $e) {
            error_log("Validation Error [getTodoById]: " . $e->getMessage());
            return ['error' => 'There was a validation error: ' . $e->getMessage()];
        }
    }

    # Tạo công việc mới
    public function createTodo($title, $description)
    {

        try {
            if (empty($title)) {
                throw new InvalidArgumentException("Title cannot be empty.");
            }
            $result = $this->todoModel->createTodo($title, $description);
            if ($result === false) {
                throw new Exception("Failed to create todo.");
            }
            return ['success' => 'Todo created successfully.', $result];
        } catch (Exception | InvalidArgumentException $e) {
            error_log("Validation Error [createTodo]: " . $e->getMessage());
            return ['error' => 'There was a validation error: ' . $e->getMessage()];
        }
    }

    # Cập nhật công việc theo ID
    public function updateTodo($id, $title, $description)
    {
        try {
            if (!is_numeric($id) || $id <= 0) {
                throw new InvalidArgumentException("Invalid ID provided.");
            }
            if (empty($title)) {
                throw new InvalidArgumentException("Title cannot be empty.");
            }
            $existingTodo = $this->todoModel->getById($id);
            if (!$existingTodo) {
                return ['error' => 'Todo not found.'];
            }
            $result = $this->todoModel->updateTodo($id, $title, $description);
            if ($result === false) {
                throw new Exception("Failed to update todo.");
            }
            return ['success' => 'Todo updated successfully.', $result];
        } catch (Exception | InvalidArgumentException $e) {
            error_log("Validation Error [updateTodo]: " . $e->getMessage());
            return ['error' => 'There was a validation error: ' . $e->getMessage()];
        }
    }

    # Xoá công việc theo ID
    public function deleteTodo($id)
    {
        try {
            if (!is_numeric($id) || $id <= 0) {
                throw new InvalidArgumentException("Invalid ID provided.");
            }
            $existingTodo = $this->todoModel->getById($id);
            if (!$existingTodo) {
                return ['error' => 'Todo not found.'];
            }
            $result = $this->todoModel->deleteTodo($id);
            if ($result === false) {
                throw new Exception("Failed to delete todo.");
            }
            return ['success' => 'Todo deleted successfully.'];
        } catch (Exception | InvalidArgumentException $e) {
            error_log("Validation Error [deleteTodo]: " . $e->getMessage());
            return ['error' => 'There was a validation error: ' . $e->getMessage()];
        }
    }
}
