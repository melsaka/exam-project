<?php

namespace App\Features\Filters;

class QuestionFilter extends QueryFilter
{
    protected $relations = ['answers'];
}
