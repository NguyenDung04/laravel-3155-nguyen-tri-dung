<?php

namespace Database\Factories;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $used = [];

        do {
            $date = now()->addDays(rand(1,7))->toDateString();
            $time = fake()->randomElement([
                '08:00','09:00','10:00','14:00','15:00','16:00'
            ]);

            $key = $date . '-' . $time;

        } while (in_array($key, $used));

        $used[] = $key;

        return [
            'customer_name' => fake('vi_VN')->name(),
            'date' => $date,
            'time' => $time,
        ];
    }
}
