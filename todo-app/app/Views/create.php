<!DOCTYPE html>
<html>

<head>
    <title>Thêm công việc</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/base.css">
</head>

<body>
    <div class="container-create">
        <h1>Thêm công việc mới</h1>
        <form method="POST" action="/todos/store">
            <label>Tiêu đề:</label><br>
            <input class="input" type="text" name="title" required><br><br>

            <label>Mô tả:</label><br>
            <textarea class="input" name="description"></textarea><br><br>

            <button class="button button-save" type="submit">Lưu</button>
        </form>

        <button class="button button-back" onclick="window.location.href='/todos'">Quay về danh sách công việc</button>
    </div>
</body>

</html>