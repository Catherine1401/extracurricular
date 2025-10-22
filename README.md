# Extracurricular Manager

Hệ thống quản lý hoạt động ngoại khóa bằng Laravel.

## Cài đặt

```bash
# Clone project
git clone git@github.com:Catherine1401/extracurricular.git
cd extracurricular

# Cài đặt dependencies
composer install
npm install

# Tạo database và dữ liệu mẫu
php artisan migrate:fresh --seed

# Build assets
npm run build

# Chạy server
php artisan serve
```

Truy cập: `http://localhost:8000`

## Tài khoản test

- **Admin**: admin@gmail.com / password
- **Organization**: org1@gmail.com / password  
- **User**: user@gmail.com / password

## Tính năng

- Quản lý người dùng (Admin, Organization, User)
- Quản lý hoạt động ngoại khóa
- Quản lý danh mục
- Đăng ký tham gia hoạt động
- Trạng thái tự động (mở/đóng theo ngày)

## Công nghệ

- Laravel 11
- PHP 8.1+
- SQLite
- Tailwind CSS
- Material Design