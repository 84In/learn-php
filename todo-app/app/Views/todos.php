<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách công việc</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
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
                        <td>
                            <div class="action-menu">
                                <button class="menu-trigger"><i class="fa-solid fa-ellipsis"></i></button>
                                <div class="menu-box">
                                    <button class="btn-edit" onclick="window.location.href='/todos/edit/<?= htmlspecialchars($todo['id']) ?>'">
                                        <i class="fa-solid fa-pen-to-square"></i> Sửa
                                    </button>
                                    <button class="btn-delete" onclick="window.location.href='/todos/delete/<?= htmlspecialchars($todo['id']) ?>'">
                                        <i class="fa-solid fa-trash"></i> Xóa
                                    </button>
                                </div>
                            </div>
                        </td>
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