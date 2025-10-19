<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('vi_VN');
        
        // Tạo admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Tạo user thường
        User::create([
            'name' => 'Người dùng',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Tạo nhiều organizations
        $organizationNames = [
            'Tổ chức ABC',
            'Tổ chức XYZ',
            'Hội sinh viên Khoa CNTT',
            'Câu lạc bộ Tiếng Anh',
            'Đoàn Thanh niên',
            'Hội Sinh viên',
            'Câu lạc bộ Khiêu vũ',
            'Tổ chức Tình nguyện',
            'Hội Sinh viên Khoa Kinh tế',
            'Câu lạc bộ Bóng đá',
            'Tổ chức Môi trường',
            'Hội Sinh viên Khoa Ngoại ngữ',
            'Câu lạc bộ Nhiếp ảnh',
            'Tổ chức Cộng đồng',
            'Hội Sinh viên Khoa Y',
        ];

        foreach ($organizationNames as $index => $name) {
            User::create([
                'name' => $name,
                'email' => 'org' . ($index + 1) . '@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'organization',
            ]);
        }
    }
}
