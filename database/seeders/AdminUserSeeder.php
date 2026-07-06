<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'Ángel Administrador', 'email' => 'angeladmin@gmail.com', 'phone' => '555-0100', 'role' => 'dev_admin'],
            ['name' => 'Secretaría Académica', 'email' => 'secretaria@sistema.test', 'phone' => '555-0200', 'role' => 'secretary'],
            ['name' => 'Coordinador Académico', 'email' => 'coordinador@sistema.test', 'phone' => '555-0300', 'role' => 'coordinator'],
            ['name' => 'Rector', 'email' => 'rector@sistema.test', 'phone' => '555-0400', 'role' => 'rector'],
        ];

        foreach ($users as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => bcrypt($data['role'] === 'dev_admin' ? 'angel2021' : 'password'),
                    'phone' => $data['phone'],
                    'is_active' => true,
                    'email_verified_at' => now(),
                ]
            );

            if (!$user->hasRole($data['role'])) {
                $user->assignRole($data['role']);
            }
        }
    }
}
