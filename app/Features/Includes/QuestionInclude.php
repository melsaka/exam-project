<?php

namespace App\Features\Includes;

class QuestionInclude extends QueryInclude
{
    protected $relationships = ['exam', 'answers'];
}
