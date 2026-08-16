<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public function scopeForStudent($query)
    {
        $user = auth()->user();

        if (!$user || strtolower($user->role) !== 'student') {
            return $query;
        }

        $student = Student::where('email', $user->email)->first();

        if (!$student) {
            return $query->whereRaw('1 = 0');
        }

        return $query->where('student_id', $student->id);
    }



    protected $guarded = [];

    protected $casts = [
        'attendance_date' => 'date',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
