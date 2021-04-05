<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Features\Models\Traits\WithFilters;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory, WithFilters;

    protected $casts = [
        'exam_id' => 'integer'
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
