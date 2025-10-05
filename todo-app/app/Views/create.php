<!DOCTYPE html>
<html>

<head>
    <title>Thêm công việc</title>
</head>

<body>
    <h1>Thêm công việc mới</h1>
    <form method="POST" action="/todos/store">
        <label>Tiêu đề:</label><br>
        <input type="text" name="title" required><br><br>

        <label>Mô tả:</label><br>
        <textarea name="description"></textarea><br><br>

        <button type="submit">Lưu</button>
    </form>

    <p><a href="/todos">← Quay lại danh sách</a></p>
</body>

</html>