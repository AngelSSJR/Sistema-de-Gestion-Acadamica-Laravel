<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [
            'users.view', 'users.create', 'users.edit', 'users.delete',
            'teachers.view', 'teachers.create', 'teachers.edit', 'teachers.delete',
            'students.view', 'students.create', 'students.edit', 'students.delete',
            'courses.view', 'courses.create', 'courses.edit', 'courses.delete',
            'subjects.view', 'subjects.create', 'subjects.edit', 'subjects.delete',
            'schedules.view', 'schedules.create', 'schedules.edit', 'schedules.delete',
            'enrollments.view', 'enrollments.create', 'enrollments.edit', 'enrollments.delete',
            'grades.view', 'grades.create', 'grades.edit', 'grades.delete',
            'attendance.view', 'attendance.create', 'attendance.edit',
            'reports.view',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission, 'web');
        }

        // 1. Desarrollador/Administrador — todos los permisos
        $devAdmin = Role::findOrCreate('dev_admin', 'web');
        $devAdmin->givePermissionTo(Permission::all());

        // 2. Secretaría Académica
        $secretary = Role::findOrCreate('secretary', 'web');
        $secretary->givePermissionTo([
            'students.view', 'students.create', 'students.edit', 'students.delete',
            'enrollments.view', 'enrollments.create', 'enrollments.edit', 'enrollments.delete',
            'schedules.view',
            'grades.view',
            'attendance.view',
        ]);

        // 3. Coordinador Académico
        $coordinator = Role::findOrCreate('coordinator', 'web');
        $coordinator->givePermissionTo([
            'courses.view', 'courses.create', 'courses.edit', 'courses.delete',
            'subjects.view', 'subjects.create', 'subjects.edit', 'subjects.delete',
            'schedules.view', 'schedules.create', 'schedules.edit', 'schedules.delete',
            'teachers.view',
            'students.view',
            'enrollments.view',
            'grades.view',
            'attendance.view',
            'reports.view',
        ]);

        // 4. Profesor
        $teacher = Role::findOrCreate('teacher', 'web');
        $teacher->givePermissionTo([
            'subjects.view',
            'schedules.view',
            'students.view',
            'grades.view', 'grades.create', 'grades.edit',
            'attendance.view', 'attendance.create', 'attendance.edit',
        ]);

        // 5. Estudiante
        $student = Role::findOrCreate('student', 'web');
        $student->givePermissionTo([
            'subjects.view',
            'schedules.view',
            'grades.view',
        ]);

        // 6. Rector/Dirección — solo lectura
        $viewPerms = Permission::all()->pluck('name')->filter(fn($p) => str_ends_with($p, '.view'));
        $rector = Role::findOrCreate('rector', 'web');
        $rector->givePermissionTo($viewPerms);
    }
}
