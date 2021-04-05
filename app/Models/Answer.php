<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Features\Models\Traits\WithFilters;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory, WithFilters;

    protected $casts = [
        'question_id' 	=> 'integer',
        'status'		=> 'boolean'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
