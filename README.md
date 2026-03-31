# 🚀 Laravel Practice – Student Management System (Full 5 Modules)

Ứng dụng được xây dựng bằng Laravel nhằm thực hành các kiến thức quan trọng: MVC, Migration, Validation, CRUD, và xử lý logic thực tế.

---

## 📌 Giới thiệu

Project gồm 5 module chính:

1. 🎓 Quản lý sinh viên
2. 📦 Quản lý sản phẩm
3. 📘 Đăng ký môn học
4. 🛒 Hệ thống đơn hàng
5. 📅 Hệ thống đặt lịch

Mỗi module đều áp dụng đầy đủ:

- MVC (Model – View – Controller)
- Validation
- Database Migration
- UI Bootstrap

---

## 🛠️ Công nghệ sử dụng

- Laravel
- PHP
- MySQL
- Blade Template
- Bootstrap 5
- Faker (Factory)

---

## ⚙️ Cài đặt project

### 1. Clone project

```bash
git clone -b bai2_2 https://github.com/NguyenDung04/laravel-3155-nguyen-tri-dung.git bai2_2
cd .\bai2_2\
```

---

### 2. Cài dependencies

```bash
composer install
```

---

### 3. Cấu hình môi trường

```bash
cp .env.example .env
```

Sửa database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_2_2
DB_USERNAME=root
DB_PASSWORD=
```

---

### 4. Chạy migration + seed mẫu

```bash
php artisan migrate:fresh --seed
```

---

### 5. Chạy server

```bash
php artisan serve
```

---

👉 Truy cập:

```
http://127.0.0.1:8000
```

---

## 📂 Cấu trúc project

```
app/
 ├── Models/
 ├── Http/Controllers/

database/
 ├── migrations/
 ├── factories/
 ├── seeders/

resources/views/
 ├── students/
 ├── products/
 ├── courses/
 ├── orders/
 ├── bookings/
 ├── layouts/
```

---

## 🔄 Kiến trúc hệ thống

```
User → Route → Controller → Model → Database → View
```

---

# 🎓 Module 1: Quản lý sinh viên

### Chức năng:

- Thêm sinh viên
- Hiển thị danh sách
- Tìm kiếm theo tên
- Sắp xếp A-Z / Z-A
- Phân trang

### Validation:

- Email không trùng

### Database:

```
students: id, name, major, email
```

---

# 📦 Module 2: Quản lý sản phẩm

### Chức năng:

- Thêm sản phẩm
- Xóa sản phẩm
- Cập nhật tồn kho
- Tìm kiếm

### Trạng thái:

- Hết hàng
- Sắp hết (<5)
- Còn hàng

### Database:

```
products: id, name, price, quantity, category
```

---

# 📘 Module 3: Đăng ký môn học

### Chức năng:

- Thêm môn học
- Đăng ký môn
- Hiển thị danh sách

### Logic:

- Không đăng ký trùng
- Tối đa 18 tín chỉ

### Database:

```
students
courses (credits)
enrollments
```

---

# 🛒 Module 4: Hệ thống đơn hàng

### Chức năng:

- Tạo đơn hàng (nhiều sản phẩm)
- Xem chi tiết đơn
- Tính tổng tiền

### Trạng thái:

- pending
- processing
- completed

### Database:

```
orders
order_items
```

---

# 📅 Module 5: Hệ thống đặt lịch

### Chức năng:

- Đặt lịch
- Hủy lịch
- Hiển thị danh sách

### Logic:

- Không trùng giờ
- Không đặt quá khứ

### Database:

```
appointments: date, time
```

---

## 🎨 Giao diện

- Sử dụng Bootstrap 5
- Theme sáng (white + blue)
- UI/UX hiện đại

---

## 🔥 Dữ liệu mẫu (Factory)

- Faker locale: `vi_VN`
- Sinh dữ liệu:
    - Tên tiếng Việt
    - Sản phẩm thực tế
    - Đơn hàng liên kết
    - Lịch không trùng

---

## ✅ Tiêu chí đạt được

| Tiêu chí   | Trạng thái |
| ---------- | ---------- |
| MVC        | ✅         |
| Migration  | ✅         |
| CRUD       | ✅         |
| Validation | ✅         |
| UI         | ✅         |

---

## ⚠️ Lưu ý

- Không viết HTML trong Controller
- Bắt buộc dùng `@csrf`
- Sử dụng Factory để tạo dữ liệu

---

## 👨‍💻 Tác giả

- Họ và tên: Nguyễn Trí Dũng
- Mã sinh viên: 20223155

---

## 📄 License

Dự án phục vụ mục đích học tập.
