<?php

namespace App\Models;

use App\Models\Attendance;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model

{
    public function scopeSearch($query, $search)
    {
        if (!$search) {
            return $query;
        }

        return $query->where(function ($q) use ($search) {

            $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%")
                ->orWhere('qualification', 'like', "%{$search}%")
                ->orWhereHas('department', function ($department) use ($search) {
                    $department->where('name', 'like', "%{$search}%");
                });
        });
    }

    public $timestamps = false;

    protected $guarded = [];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function Attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'subject_teacher');
    }
}
