<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::insert([
            [
                'department_id' => 1,
                'name' => 'Web Development',
                'code' => 'SE101',
                'credit_hours' => 3,
                'semester' => 1,
                'description' => 'Intro to Web Development',
                'status' => true
            ],
            [
                'department_id' => 1,
                'name' => 'App Development',
                'code' => 'SE102',
                'credit_hours' => 3,
                'semester' => 1,
                'description' => 'Intro to App Development',
                'status' => true
            ]

        ]);
    }
}
