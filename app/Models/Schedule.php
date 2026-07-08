<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'subject_id',
        'teacher_id',
        'day_of_week',
        'start_time',
        'end_time',
        'room_id',
        'room',
        'academic_period',
    ];

    protected function casts(): array
    {
        return [
            'start_time' => 'string',
            'end_time' => 'string',
        ];
    }

    public function getDayOfWeekAttribute($value): array
    {
        $decoded = json_decode($value, true);
        return is_array($decoded) ? $decoded : [$value];
    }

    public function setDayOfWeekAttribute($value): void
    {
        $this->attributes['day_of_week'] = is_array($value) ? json_encode($value) : $value;
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function roomModel()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
