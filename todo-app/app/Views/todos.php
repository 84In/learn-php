<!-- app/Views/todos.php -->
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách công việc</title>
</head>

<body>
    <h1>Danh sách công việc</h1>

    <a href="/todos/create">+ Thêm công việc</a>
    <ul>
        <?php if (!empty($todos) && is_array($todos)): ?>
            <?php foreach ($todos as $todo): ?>
                <li>
                    <strong><?= htmlspecialchars($todo['title']) ?></strong><br>
                    <?= htmlspecialchars($todo['description']) ?>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>Không có công việc nào</li>
        <?php endif; ?>
    </ul>
</body>

</html>