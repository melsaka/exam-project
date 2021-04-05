<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Features\Models\Traits\WithFilters;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory, WithFilters;

    // Relationships
    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
}
