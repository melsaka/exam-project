<?php

namespace App\Features\Includes;

class ExamInclude extends QueryInclude
{
    protected $relationships = ['subject', 'questions'];
}
