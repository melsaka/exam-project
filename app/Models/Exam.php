<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Features\Models\Traits\WithFilters;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory, WithFilters;

    protected $casts = [
        'subject_id' => 'integer'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function answers()
    {
        return $this->hasManyThrough(Answer::class, Question::class);
    }
}
