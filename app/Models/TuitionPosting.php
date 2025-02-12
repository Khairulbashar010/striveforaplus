<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TuitionPosting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'school_level_id',
        'subject',
        'fee',
        'max_students',
        'description',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schoolLevel()
    {
        return $this->belongsTo(SchoolLevel::class);
    }
}

