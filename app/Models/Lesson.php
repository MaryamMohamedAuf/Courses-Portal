<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 
        'course_id',
    ];

    /**
     * Get the course that owns the lesson.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function user()
    {
    return $this->belongsToMany(User::class, 'user_lesson')->withTimestamps();
    }
    
// 'lesson_user':This is the name of the pivot table that connects the lessons and users tables.
// In a many-to-many relationship, Laravel expects a pivot table to store the relationships between the two models.
// The convention is to use the singular form of both table names and combine them alphabetically (lesson_user). 
//So, lesson_user would store data to link lessons and users together.

}
