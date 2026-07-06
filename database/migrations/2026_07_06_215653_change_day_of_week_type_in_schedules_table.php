<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE schedules MODIFY COLUMN day_of_week VARCHAR(100)');
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE schedules MODIFY COLUMN day_of_week ENUM('monday','tuesday','wednesday','thursday','friday','saturday')");
    }
};
