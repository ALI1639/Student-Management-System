<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $guarded = [];

    public function scopeForStudent($query)
    {
        $user = auth()->user();

        if (!$user || strtolower($user->role) !== 'student') {
            return $query;
        }

        return $query->whereHas('student', function ($query) use ($user) {
            $query->where('email', $user->email);
        });
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
