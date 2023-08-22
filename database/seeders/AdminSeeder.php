<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => fake()->name(),
            'surname' => fake()->lastName(),
            'phone' => 5432931414,
            'profile_picture' => "http://127.0.0.1:8000/images/avatar.png",
            'username' => "Öğrenci",
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'status' => 1,
        ])->assignRole('Öğrenci');

        $student = Student::create([
            'student_number' => 959,
            'internship_start_date' => '2023-06-09',
            'internship_end_date' => '2023-09-09',
            'internship_status' => 1,
            'internship_type' => 1,
            'user_id' => 1
        ]);

        $user = User::create([
            'name' => fake()->name(),
            'surname' => fake()->lastName(),
            'phone' => 5432931414,
            'profile_picture' => "http://127.0.0.1:8000/images/user.jpg",
            'username' => 'Yetkili',
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'status' => 1,
        ])->assignRole('Yetkili');


        $user = User::create([
            'name' => fake()->name(),
            'surname' => fake()->lastName(),
            'phone' => 5432931414,
            'profile_picture' => "http://127.0.0.1:8000/images/user.jpg",
            'username' => 'Yönetici',
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'status' => 1,
        ])->assignRole('Yönetici');


        //        ])->assignRole('Yönetici', 'Yetkili', 'Öğrenci');
    }
}
