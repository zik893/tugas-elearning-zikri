<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'teacher_id',
        'category_id',
        'name',
        'slug',
        'thumbnail',
        'about',
        'difficulty',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function keypoints()
    {
        return $this->hasMany(CourseKeypoint::class);
    }

    public function students()
    {
        return $this->hasMany(CourseStudent::class);
    }

    public function videos()
    {
        return $this->hasMany(CourseVideo::class);
    }

    public function getPriceAttribute()
    {
        return 250000;
    }
}