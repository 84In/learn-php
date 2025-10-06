<!-- app/Views/todos.php -->
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách công việc</title>
    <link rel="stylesheet" href="/css/base.css">
</head>

<body>
    <div class="container">
        <h1 class="heading">Danh sách công việc</h1>
        <div class="button-container">
            <button class="button button-add" onclick="window.location.href='/todos/create'">+ Thêm công việc</button>
        </div>
        <table>
            <tr>
                <th>Công việc</th>
                <th>Mô tả công việc</th>
                <th>Thời gian khởi tạo</th>
                <th>Chỉnh sửa</th>
            </tr>
            <?php if (!empty($todos) && is_array($todos)): ?>
                <?php foreach ($todos as $todo): ?>
                    <tr>
                        <td><?= htmlspecialchars($todo['title']) ?></td>
                        <td><?= htmlspecialchars($todo['description']) ?></td>
                        <td><?= htmlspecialchars($todo['created_at']) ?></td>
                        <td><a href="#"><?= htmlspecialchars($todo['id']) ?></a></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">Không có công việc nào.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>

</html>