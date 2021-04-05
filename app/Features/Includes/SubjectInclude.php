<?php

namespace App\Features\Includes;

class SubjectInclude extends QueryInclude
{
    protected $relationships = ['exams'];
}
