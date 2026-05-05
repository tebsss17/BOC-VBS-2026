<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    /** @use HasFactory<\Database\Factories\LessonFactory> */
    use HasFactory;

    protected $fillable = [
        'day',
        'title',
        'description',
        'memory_verse',
    ];

    public function teahcer(){
        return $this->belongsTo(User::class);
    }

    public function attendances(){
        return $this->hasMany(Attendance::class);
    }
}
