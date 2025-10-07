<?php
// Bật hiển thị lỗi (debug dev mode)
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Autoload class
require_once __DIR__ . '/../vendor/autoload.php';

// Nạp file Router
require_once __DIR__ . '/../app/Core/Router.php';


use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();


// Cấu hình Router
use App\Core\Router;

// Khởi tạo router
$router = new Router();


// Định nghĩa route
$router->get('/', 'App\Controllers\TodoController@index');
$router->get('/todos', 'App\Controllers\TodoController@index');
$router->get('/todos/create', 'App\Controllers\TodoController@create');
$router->post('/todos/store', 'App\Controllers\TodoController@store');
$router->get('/todos/delete/{id}', 'App\Controllers\TodoController@delete');
$router->get('/todos/edit/{id}', 'App\Controllers\TodoController@edit');
$router->post('/todos/update/{id}', 'App\Controllers\TodoController@update');

// Chạy router
$router->dispatch();
