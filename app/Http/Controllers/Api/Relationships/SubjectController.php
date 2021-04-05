<?php

namespace App\Http\Controllers\Api\Relationships;

use App\Features\Includes\QuestionInclude;
use App\Http\Resources\ExamResource;
use App\Features\Filters\ExamFilter;
use App\Http\Controllers\Controller;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function exams(ExamFilter $filters, QuestionInclude $includes, Subject $subject)
    {
        $exams = $subject->exams()->filter($filters)->paginate()->withQueryString();

        $includes->applyOn($exams);
        
        return ExamResource::collection($exams);
    }
}
