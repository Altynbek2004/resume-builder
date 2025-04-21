<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'educations';

    protected $fillable = [
        'resume_id',
        'institution',
        'degree',
        'field_of_study',
        'start_date',
        'end_date',
        'description',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * Get the resume that owns the education.
     */
    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}
