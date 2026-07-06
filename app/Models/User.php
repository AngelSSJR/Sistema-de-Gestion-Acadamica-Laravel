<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, HasRoles, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function isDevAdmin(): bool
    {
        return $this->hasRole('dev_admin');
    }

    public function isSecretary(): bool
    {
        return $this->hasRole('secretary');
    }

    public function isCoordinator(): bool
    {
        return $this->hasRole('coordinator');
    }

    public function isTeacher(): bool
    {
        return $this->hasRole('teacher');
    }

    public function isStudent(): bool
    {
        return $this->hasRole('student');
    }

    public function isRector(): bool
    {
        return $this->hasRole('rector');
    }

    public function getRoleDisplayName(): string
    {
        return match (true) {
            $this->isDevAdmin() => 'Desarrollador/Administrador',
            $this->isSecretary() => 'Secretaría Académica',
            $this->isCoordinator() => 'Coordinador Académico',
            $this->isTeacher() => 'Profesor',
            $this->isStudent() => 'Estudiante',
            $this->isRector() => 'Rector/Dirección',
            default => 'Usuario',
        };
    }

    public function getDashboardRoute(): string
    {
        return match (true) {
            $this->isDevAdmin() => 'dev-admin.dashboard',
            $this->isSecretary() => 'secretary.dashboard',
            $this->isCoordinator() => 'coordinator.dashboard',
            $this->isTeacher() => 'teacher.dashboard',
            $this->isStudent() => 'student.dashboard',
            $this->isRector() => 'rector.dashboard',
            default => 'dashboard',
        };
    }
}
