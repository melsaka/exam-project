<?php

namespace App\Http\Controllers\Api\Relationships;

use App\Features\Includes\QuestionInclude;
use App\Features\Filters\SubjectFilter;
use App\Features\Filters\QuestionFilter;
use App\Http\Resources\QuestionResource;
use App\Http\Resources\SubjectResource;
use App\Http\Controllers\Controller;
use App\Models\Exam;

class ExamController extends Controller
{
    public function subject(SubjectFilter $filters, Exam $exam)
    {
        $subject = $exam->subject()->filter($filters)->firstOrFail();

        return new SubjectResource($subject);
    }

    public function questions(QuestionFilter $filters, QuestionInclude $includes, Exam $exam)
    {
        $questions = $exam->questions()->filter($filters)->get();
        
        $includes->applyOn($questions);

        return QuestionResource::collection($questions);
    }
}
