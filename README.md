# 🚀 Laravel Mini Project – Course Management System

Ứng dụng được xây dựng bằng Laravel nhằm thực hành các kiến thức: MVC, Model, Migration, CRUD, Relationship, Pagination, Search, Upload và Dashboard.

---

## 📌 Giới thiệu

Project mô phỏng hệ thống quản lý khóa học trực tuyến (Course Management System).

Gồm các chức năng chính:

1. 📚 Quản lý khóa học (Course)
2. 🎬 Quản lý bài học (Lesson)
3. 👨‍🎓 Quản lý học viên (Student)
4. 📝 Đăng ký khóa học (Enrollment)
5. 📊 Dashboard thống kê

Áp dụng:

- MVC (Model – View – Controller)
- ORM (Eloquent)
- Migration
- Blade Template
- Pagination
- Search & Filter
- Upload ảnh
- Soft Delete
- Form Request Validation

---

## 🛠️ Công nghệ sử dụng

- Laravel
- PHP
- MySQL
- Blade Template
- Bootstrap / Tailwind (tuỳ chọn)

---

## ⚙️ Cài đặt project

### 1. Clone project

```bash
git clone -b bai3 https://github.com/NguyenDung04/laravel-3155-nguyen-tri-dung.git bai3
```

```bash
cd bai3
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
DB_DATABASE=laravel_3
DB_USERNAME=root
DB_PASSWORD=
```

---

### 4. Generate key

```bash
php artisan key:generate
```

---

### 5. Chạy migration

```bash
php artisan migrate
```

---

### 6. Link storage (upload ảnh)

```bash
php artisan storage:link
```

---

### 7. Chạy server

```bash
php artisan serve
```

---

👉 Truy cập:

```
http://127.0.0.1:8000/courses
```

---

## 📂 Cấu trúc project

```
app/
 ├── Models/
 │    ├── Course.php
 │    ├── Lesson.php
 │    ├── Student.php
 │    └── Enrollment.php
 ├── Http/Controllers/
 │    ├── CourseController.php
 │    ├── LessonController.php
 │    └── EnrollmentController.php

database/
 ├── migrations/

resources/views/
 ├── courses/
 ├── lessons/
 ├── enrollments/
 ├── layouts/
 ├── components/
 └── dashboard.blade.php
```

---

## 🔄 Kiến trúc hệ thống

```
User → Route → Controller → Model → Database → View
```

---

# 📚 Module 1: Quản lý khóa học

### Chức năng:

- Thêm khóa học
- Hiển thị danh sách
- Cập nhật khóa học
- Xóa mềm (Soft Delete)
- Khôi phục khóa học
- Phân trang

### Database:

```
courses: id, name, slug, price, description, image, status, deleted_at
```

---

# 🎬 Module 2: Quản lý bài học

### Chức năng:

- Thêm bài học theo khóa học
- Hiển thị danh sách bài học theo khóa
- Sắp xếp theo thứ tự (order)
- Cập nhật / Xóa bài học

### Database:

```
lessons: id, course_id, title, content, video_url, order
```

---

# 👨‍🎓 Module 3: Quản lý học viên

### Chức năng:

- Thêm học viên
- Lưu thông tin: tên, email

### Database:

```
students: id, name, email
```

---

# 📝 Module 4: Đăng ký khóa học

### Chức năng:

- Đăng ký học viên vào khóa học
- Hiển thị danh sách học viên theo khóa
- Đếm số lượng học viên

### Database:

```
enrollments: id, course_id, student_id
```

---

# 🔗 Module 5: Quan hệ Model

### Quan hệ:

- Course hasMany Lesson
- Course hasMany Enrollment
- Student hasMany Enrollment
- Course belongsToMany Student (qua enrollments)

### Ví dụ:

```blade
{{ $course->lessons->count() }}
{{ $course->students->count() }}
```

---

# 📄 Module 6: CRUD hoàn chỉnh

### Chức năng:

- Create
- Read
- Update
- Delete (Soft Delete)

### Route:

```php
Route::resource('courses', CourseController::class);
```

---

# 📊 Module 7: Dashboard

### Hiển thị:

- Tổng số khóa học
- Tổng số học viên
- Tổng doanh thu
- Khóa học nhiều học viên nhất
- 5 khóa học mới

### Controller:

```php
$totalCourses = Course::count();
$totalStudents = Student::count();
$totalRevenue = Course::sum('price');

$topCourse = Course::withCount('enrollments')
    ->orderByDesc('enrollments_count')
    ->first();

$newCourses = Course::latest()->take(5)->get();
```

---

# 🔍 Module 8: Tìm kiếm & Lọc

### Tìm kiếm:

```php
$query->where('name', 'like', '%' . $request->name . '%');
```

### Lọc:

```php
$query->where('status', $request->status);
```

### Khoảng giá:

```php
$query->whereBetween('price', [$min, $max]);
```

---

# ⚡ Tối ưu dữ liệu

```php
Course::with(['lessons', 'enrollments'])->paginate(10);
```

👉 Tránh lỗi N+1 query

---

# 🧠 Scope (Advanced)

```php
public function scopePublished($query)
{
    return $query->where('status', 'published');
}

public function scopePriceBetween($query, $min, $max)
{
    return $query->whereBetween('price', [$min, $max]);
}
```

---

# 🧾 Form Request Validation

```bash
php artisan make:request CourseRequest
```

```php
'name' => 'required',
'price' => 'required|numeric|min:1'
```

---

# 🖼️ Upload ảnh

- Lưu ảnh vào `storage/app/public/courses`

### Hiển thị:

```blade
<img src="{{ asset('storage/'.$course->image) }}">
```

---

# 🎨 Giao diện

- Layout master
- Sidebar (Courses, Lessons, Enrollments)
- Component:
    - Alert
    - Card
    - Badge
    - Table

---

# 🔥 ORM vs SQL

### ORM:

```php
Course::where('price', '>', 100)->get();
```

### SQL:

```sql
SELECT * FROM courses WHERE price > 100;
```

### So sánh:

- ORM: dễ viết, dễ bảo trì
- SQL: tối ưu hơn trong một số trường hợp

---

## ✅ Tiêu chí đạt được

| Tiêu chí           | Trạng thái |
| ------------------ | ---------- |
| MVC                | ✅         |
| Migration          | ✅         |
| CRUD               | ✅         |
| Relationship       | ✅         |
| Pagination         | ✅         |
| Dashboard          | ✅         |
| Search/Filter      | ✅         |
| Upload ảnh         | ✅         |
| Soft Delete        | ✅         |
| Form Request       | ✅         |
| Optimization (N+1) | ✅         |

---

## ⚠️ Lưu ý

- Phải khai báo `$fillable` trong Model
- Không viết logic trong View
- Luôn dùng `@csrf` trong form
- Kiểm tra null:

```blade
{{ $course->image ?? 'no-image.png' }}
```

---

## 👨‍💻 Tác giả

- Họ và tên: Nguyễn Trí Dũng
- Mã sinh viên: 20223155

---

## 📄 License

Dự án phục vụ mục đích học tập.
