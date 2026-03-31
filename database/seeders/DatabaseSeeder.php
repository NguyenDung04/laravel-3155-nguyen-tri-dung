<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Product;
use App\Models\Course;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Appointment;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 🎓 sinh viên
        Student::factory()->count(10)->create();

        // 📦 sản phẩm
        Product::factory()->count(10)->create();

        // 📘 môn học
        Course::factory()->count(5)->create();

        // 📅 lịch hẹn
        Appointment::factory()->count(5)->create();

        // 🛒 đơn hàng + chi tiết
        Order::factory()->count(5)->create()->each(function ($order) {
            for ($i = 0; $i < rand(2,4); $i++) {
                OrderItem::factory()->create([
                    'order_id' => $order->id
                ]);
            }
        });

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
