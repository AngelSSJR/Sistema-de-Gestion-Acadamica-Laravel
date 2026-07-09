<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->index('day_of_week');
            $table->index('start_time');
            $table->index('end_time');
            $table->index(['course_id', 'subject_id']);
            $table->index(['teacher_id', 'day_of_week']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->index('name');
            $table->index('email');
            $table->index('phone');
        });

        Schema::table('students', function (Blueprint $table) {
            $table->index('student_code');
            $table->index('status');
        });

        Schema::table('teachers', function (Blueprint $table) {
            $table->index('employee_code');
            $table->index('specialty');
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->index('code');
            $table->index('name');
            $table->index('level');
            $table->index('is_active');
        });

        Schema::table('subjects', function (Blueprint $table) {
            $table->index('code');
            $table->index('name');
            $table->index('is_active');
        });

        Schema::table('rooms', function (Blueprint $table) {
            $table->index('code');
            $table->index('name');
            $table->index('is_active');
        });

        Schema::table('enrollments', function (Blueprint $table) {
            $table->index('academic_period');
            $table->index('status');
        });

        Schema::table('grades', function (Blueprint $table) {
            $table->index('period');
        });

        Schema::table('attendances', function (Blueprint $table) {
            $table->index('date');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropIndex(['day_of_week']);
            $table->dropIndex(['start_time']);
            $table->dropIndex(['end_time']);
            $table->dropIndex(['course_id', 'subject_id']);
            $table->dropIndex(['teacher_id', 'day_of_week']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['name']);
            $table->dropIndex(['email']);
            $table->dropIndex(['phone']);
        });

        Schema::table('students', function (Blueprint $table) {
            $table->dropIndex(['student_code']);
            $table->dropIndex(['status']);
        });

        Schema::table('teachers', function (Blueprint $table) {
            $table->dropIndex(['employee_code']);
            $table->dropIndex(['specialty']);
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->dropIndex(['code']);
            $table->dropIndex(['name']);
            $table->dropIndex(['level']);
            $table->dropIndex(['is_active']);
        });

        Schema::table('subjects', function (Blueprint $table) {
            $table->dropIndex(['code']);
            $table->dropIndex(['name']);
            $table->dropIndex(['is_active']);
        });

        Schema::table('rooms', function (Blueprint $table) {
            $table->dropIndex(['code']);
            $table->dropIndex(['name']);
            $table->dropIndex(['is_active']);
        });

        Schema::table('enrollments', function (Blueprint $table) {
            $table->dropIndex(['academic_period']);
            $table->dropIndex(['status']);
        });

        Schema::table('grades', function (Blueprint $table) {
            $table->dropIndex(['period']);
        });

        Schema::table('attendances', function (Blueprint $table) {
            $table->dropIndex(['date']);
            $table->dropIndex(['status']);
        });
    }
};
