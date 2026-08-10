<?php

namespace App\Models;

use App\Models\Attendance;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
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

        return $query->where('department_id', $student->department_id)
            ->where('course_id', $student->course_id);
    }




    public function scopeSearch($query, $search)
    {
        if (!$search) {
            return $query;
        }

        return $query->where(function ($q) use ($search) {

            $q->where('name', 'like', "%{$search}%")
                ->orWhere('code', 'like', "%{$search}%")
                ->orWhere('semester', 'like', "%{$search}%")
                ->orWhereHas('department', function ($department) use ($search) {
                    $department->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('course', function ($course) use ($search) {
                    $course->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('teachers', function ($teacher) use ($search) {
                    $teacher->where('name', 'like', "%{$search}%");
                });
        });
    }

    public function scopeForTeacher($query)
    {
        $user = auth()->user();

        if (!$user || strtolower($user->role) !== 'teacher') {
            return $query;
        }

        $teacher = Teacher::where('email', $user->email)->first();

        if (!$teacher) {
            return $query->whereRaw('1 = 0');
        }

        return $query
            ->whereHas('teachers', function ($q) use ($teacher) {
                $q->where('teachers.id', $teacher->id);
            })
            ->with('attendances');
    }



    public $timestamps = false;

    protected $guarded = [];

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'subject_teacher');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function Course()
    {
        return $this->belongsTo(Course::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }
}
