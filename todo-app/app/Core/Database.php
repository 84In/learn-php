<?php

# Đặt namespace cho file dùng phân biệt các class cùng tên
namespace App\Core;
# Sử dụng PDO để kết nối CSDL
use PDO;
# Sử dụng PDOException để bắt lỗi kết nối CSDL
use PDOException;
# Tạo class Database để quản lý kết nối CSDL
class Database
{
    # Singleton pattern để đảm bảo chỉ có một kết nối CSDL duy nhất
    private static $instance = null;
    # Kết nối PDO
    private $connection;
    # Hàm khởi tạo kết nối CSDL
    private function __construct($config)
    {
        # Thiết lập kết nối PDO
        try {
            # Tạo DSN (Data Source Name) có thể hiểu như là driver kết nối bên java
            $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['name']};charset=utf8mb4";
            # Tạo kết nối PDO
            $this->connection = new PDO($dsn, $config['user'], $config['pass']);
            # Thiết lập chế độ lỗi của PDO thành ngoại lệ
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            # Nếu kết nối thất bại thì hiển thị lỗi
            die("Database connection failed: " . $e->getMessage());
        }
    }

    # Hàm lấy kết nối PDO
    public static function getInstance($config)
    {
        # Nếu chưa có kết nối thì tạo mới
        if (self::$instance === null) {
            self::$instance = new self($config);
        }
        return self::$instance->connection;
    }
}
