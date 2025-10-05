<?php

namespace App\Core;

class Router
{
    # Mảng lưu trữ các route
    private $routes = [
        'GET' => [],
        'POST' => []
    ];

    # Định nghĩa route cho phương thức GET và POST
    public function get($uri, $action)
    {
        # Lưu route vào mảng
        $this->routes['GET'][$uri] = $action;
    }

    public function post($uri, $action)
    {
        $this->routes['POST'][$uri] = $action;
    }

    # Phương thức xử lý request và gọi controller tương ứng
    public function dispatch()
    {
        # parse_url để lấy đường dẫn (không bao gồm query string)
        # $_SERVER['REQUEST_URI'] để lấy đường dẫn hiện tại
        # $_SERVER['REQUEST_METHOD'] để lấy phương thức hiện tại
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        # Kiểm tra route có tồn tại không
        if (isset($this->routes[$method][$uri])) {
            # Tách chuỗi action thành controller và phương thức
            [$controller, $methodName] = explode('@', $this->routes[$method][$uri]);
            # Khởi tạo controller và gọi phương thức
            $instance = new $controller();
            # Gọi phương thức
            call_user_func([$instance, $methodName]);
        } else {
            # Nếu route không tồn tại thì hiển thị lỗi 404
            http_response_code(404);
            echo "404 - Không tìm thấy route cho {$uri}";
        }
    }
}
