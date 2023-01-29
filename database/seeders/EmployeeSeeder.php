<?php

namespace Database\Seeders;

use App\Models\Employee;
use Database\Factories\EmployeeFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Employee();
        $admin->username = 'admin';
        $admin->password = 'admin123';
        $admin->name = 'ADMIN';
        $admin->role = 'admin';
        $admin->save();

        $employees = Employee::factory()->count(70)->create();
    }
}