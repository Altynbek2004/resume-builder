<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'resume_id',
        'name',
        'level',
    ];

    /**
     * Get the resume that owns the skill.
     */
    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}
