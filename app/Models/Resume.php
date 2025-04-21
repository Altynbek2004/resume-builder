<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'address',
        'full_name',
        'phone',
        'email',
        'about',
        'position',
        'photo_path',
    ];

    /**
     * Get the user that owns the resume.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the educations for the resume.
     */
    public function educations()
    {
        return $this->hasMany(Education::class);
    }

    /**
     * Get the experiences for the resume.
     */
    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    /**
     * Get the skills for the resume.
     */
    public function skills()
    {
        return $this->hasMany(Skill::class);
    }
}
