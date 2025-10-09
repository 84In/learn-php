import mysql.connector
from faker import Faker
import random
import time

# ✅ Cấu hình kết nối MySQL
conn = mysql.connector.connect(
    host="localhost",
    user="todo_user123",
    password="todo_pass123",      # sửa nếu MySQL có mật khẩu
    database="todo_app"   # sửa theo tên DB của bạn
)
cursor = conn.cursor()

fake = Faker()
total_records = 1_000_000
batch_size = 10_000  # chia nhỏ để insert nhanh hơn, tránh quá tải

start_time = time.time()
print(f"🚀 Bắt đầu tạo {total_records:,} records...")

# ✅ Sinh dữ liệu và chèn theo batch
for batch_start in range(0, total_records, batch_size):
    data = []
    for _ in range(batch_size):
        title = fake.sentence(nb_words=random.randint(3, 6))
        desc = fake.text(max_nb_chars=200)
        data.append((title, desc))

    cursor.executemany(
        "INSERT INTO todos (title, description) VALUES (%s, %s)", data
    )
    conn.commit()

    done = batch_start + batch_size
    print(f"✅ Đã insert {done:,}/{total_records:,} records")

end_time = time.time()
print(f"🎯 Hoàn tất trong {end_time - start_time:.2f} giây")

cursor.close()
conn.close()
