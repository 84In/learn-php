<?php

// namespace App\Core;

// class Router
// {
//     # Mảng lưu trữ các route
//     private $routes = [
//         'GET' => [],
//         'POST' => []
//     ];

//     # Định nghĩa route cho phương thức GET và POST
//     public function get($uri, $action)
//     {
//         # Lưu route vào mảng
//         $this->routes['GET'][$uri] = $action;
//     }

//     public function post($uri, $action)
//     {
//         $this->routes['POST'][$uri] = $action;
//     }

//     # Phương thức xử lý request và gọi controller tương ứng
//     public function dispatch()
//     {
//         # parse_url để lấy đường dẫn (không bao gồm query string)
//         # $_SERVER['REQUEST_URI'] để lấy đường dẫn hiện tại
//         # $_SERVER['REQUEST_METHOD'] để lấy phương thức hiện tại
//         $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
//         $method = $_SERVER['REQUEST_METHOD'];

//         # Kiểm tra route có tồn tại không
//         if (isset($this->routes[$method][$uri])) {
//             # Tách chuỗi action thành controller và phương thức
//             [$controller, $methodName] = explode('@', $this->routes[$method][$uri]);
//             # Khởi tạo controller và gọi phương thức
//             $instance = new $controller();
//             # Gọi phương thức
//             call_user_func([$instance, $methodName]);
//         } else {
//             # Nếu route không tồn tại thì hiển thị lỗi 404
//             http_response_code(404);
//             echo "404 - Không tìm thấy route cho {$uri}";
//         }
//     }
// }

namespace App\Core;

class Router
{
    # Mảng lưu trữ các route
    private $routes = [
        'GET' => [],
        'POST' => []
    ];

    # Định nghĩa route cho phương thức GET
    public function get($uri, $action)
    {
        # Lưu route vào mảng
        $this->routes['GET'][$uri] = $action;
    }

    # Định nghĩa route cho phương thức POST
    public function post($uri, $action)
    {
        $this->routes['POST'][$uri] = $action;
    }

    # Phương thức xử lý request và gọi controller tương ứng
    public function dispatch()
    {
        # Lấy đường dẫn hiện tại (không bao gồm query string)
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        # Lấy phương thức HTTP hiện tại (GET, POST, ...)
        $method = $_SERVER['REQUEST_METHOD'];

        # Biến kiểm tra xem route có khớp hay không
        $found = false;

        # Duyệt qua toàn bộ danh sách route theo phương thức hiện tại
        foreach ($this->routes[$method] as $route => $action) {
            # Chuyển các tham số động dạng {id} thành biểu thức chính quy
            # Ví dụ: /todos/delete/{id} -> /todos/delete/(\d+)
            $pattern = preg_replace('/\{[a-zA-Z_]+\}/', '(\d+)', $route);
            # Thêm ký tự bắt đầu và kết thúc để match chính xác đường dẫn
            $pattern = "#^" . $pattern . "$#";

            # Nếu đường dẫn hiện tại khớp với pattern
            if (preg_match($pattern, $uri, $matches)) {
                $found = true;

                # Loại bỏ phần match toàn bộ để chỉ giữ lại giá trị các tham số
                array_shift($matches);

                # Tách action thành controller và tên phương thức
                [$controller, $methodName] = explode('@', $action);

                # Khởi tạo controller tương ứng
                $instance = new $controller();

                # Gọi phương thức kèm theo các tham số động (nếu có)
                call_user_func_array([$instance, $methodName], $matches);

                # Dừng vòng lặp vì đã tìm thấy route phù hợp
                break;
            }
        }

        # Nếu không tìm thấy route phù hợp, hiển thị lỗi 404
        if (!$found) {
            http_response_code(404);
            echo "404 - Không tìm thấy route cho {$uri}";
        }
    }
}
