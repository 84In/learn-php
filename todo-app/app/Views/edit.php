<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Chỉnh sửa công việc</title>
    <link rel="stylesheet" href="/css/base.css">
</head>

<body>
    <div class="container-create">
        <h1 class="heading">Chỉnh sửa công việc</h1>

        <!-- Gửi form tới route update -->
        <form method="POST" action="/todos/update/<?= htmlspecialchars($todo['id'] ?? '') ?>">

            <label>Tiêu đề:</label><br>
            <input
                class="input"
                type="text"
                name="title"
                required
                value="<?= htmlspecialchars($todo['title'] ?? '') ?>"><br><br>

            <label>Mô tả:</label><br>
            <textarea
                class="input"
                name="description"
                rows="4"><?= htmlspecialchars($todo['description'] ?? '') ?></textarea><br><br>

            <button class="button button-save" type="submit">Lưu cập nhật</button>
        </form>

        <button class="button button-back" onclick="window.location.href='/todos'">Huỷ cập nhật</button>
    </div>
</body>

</html>