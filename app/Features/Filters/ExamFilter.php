<?php

namespace App\Features\Filters;

class ExamFilter extends QueryFilter
{
    protected $relations = ['questions'];
}
