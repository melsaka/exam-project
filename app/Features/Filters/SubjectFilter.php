<?php

namespace App\Features\Filters;

class SubjectFilter extends QueryFilter
{
    protected $relations = ['exams'];
}
