<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use App\Models\Payment;
use App\Models\Attendance;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@innovior.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Reception User
        User::create([
            'name' => 'Reception User',
            'email' => 'reception@innovior.com',
            'password' => Hash::make('password'),
            'role' => 'reception',
        ]);

        // Create Sample Students
        $courses = ['Computer Science', 'Business Administration', 'Engineering', 'Medicine', 'Law'];
        
        for ($i = 1; $i <= 20; $i++) {
            $studentId = 'STU' . str_pad($i, 6, '0', STR_PAD_LEFT);
            
            $student = Student::create([
                'student_id' => $studentId,
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'phone' => fake()->phoneNumber(),
                'address' => fake()->address(),
                'date_of_birth' => fake()->date('Y-m-d', '-18 years'),
                'enrollment_date' => fake()->dateTimeBetween('-2 years', 'now'),
                'course' => $courses[array_rand($courses)],
                'status' => fake()->randomElement(['active', 'active', 'active', 'inactive']),
            ]);

            // Generate QR code
            $qrCode = base64_encode(QrCode::format('png')->size(200)->generate($student->student_id));
            $student->update(['qr_code' => $qrCode]);

            // Create payments for each student
            $paymentCount = rand(1, 5);
            for ($j = 0; $j < $paymentCount; $j++) {
                Payment::create([
                    'student_id' => $student->id,
                    'amount' => fake()->randomFloat(2, 100, 5000),
                    'payment_date' => fake()->dateTimeBetween('-1 year', 'now'),
                    'payment_type' => fake()->randomElement(['tuition', 'registration', 'exam', 'library', 'other']),
                    'status' => fake()->randomElement(['paid', 'paid', 'paid', 'pending', 'overdue']),
                    'reference_number' => 'PAY' . time() . rand(1000, 9999),
                    'notes' => fake()->optional()->sentence(),
                    'processed_by' => 2, // Reception user
                ]);
            }

            // Create attendance records
            $attendanceCount = rand(5, 30);
            for ($k = 0; $k < $attendanceCount; $k++) {
                $attendanceDate = fake()->dateTimeBetween('-3 months', 'now');
                Attendance::create([
                    'student_id' => $student->id,
                    'attendance_date' => $attendanceDate,
                    'check_in_time' => $attendanceDate->setTime(8, rand(0, 59)),
                    'check_out_time' => fake()->optional(0.8)->dateTime($attendanceDate->setTime(16, rand(0, 59))),
                    'status' => fake()->randomElement(['present', 'present', 'present', 'late', 'absent']),
                    'notes' => fake()->optional()->sentence(),
                    'scanned_by' => 2,
                ]);
            }
        }
    }
}
