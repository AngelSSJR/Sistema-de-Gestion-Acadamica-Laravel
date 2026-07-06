<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enrollment_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete();
            $table->foreignId('teacher_id')->constrained()->cascadeOnDelete();
            $table->integer('period');
            $table->decimal('grade_value', 5, 2)->nullable();
            $table->text('comment')->nullable();
            $table->string('academic_period', 20)->nullable();
            $table->timestamps();

            $table->unique(['enrollment_id', 'subject_id', 'period'], 'grade_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
