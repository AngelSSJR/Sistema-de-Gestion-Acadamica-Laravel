<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('attendances')->truncate();
        DB::table('grades')->truncate();
        DB::table('schedules')->truncate();
        DB::table('rooms')->truncate();
        DB::table('enrollments')->truncate();
        DB::table('course_subject')->truncate();
        DB::table('teacher_subject')->truncate();
        DB::table('students')->truncate();
        DB::table('teachers')->truncate();
        DB::table('subjects')->truncate();
        DB::table('courses')->truncate();
        DB::table('model_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('role_has_permissions')->truncate();
        DB::table('permissions')->truncate();
        DB::table('roles')->truncate();
        DB::table('users')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $this->call([
            RolePermissionSeeder::class,
            AdminUserSeeder::class,
            TestDataSeeder::class,
        ]);
    }
}
