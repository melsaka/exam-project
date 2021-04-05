<?php

namespace App\Http\Controllers\Api\Relationships;

use App\Http\Resources\AnswerResource;
use App\Features\Filters\AnswerFilter;
use App\Features\Filters\ExamFilter;
use App\Http\Resources\ExamResource;
use App\Http\Controllers\Controller;
use App\Models\Question;

class QuestionController extends Controller
{
    public function exam(ExamFilter $filters, Question $question)
    {
        $exam = $question->exam()->filter($filters)->firstOrFail();

        return new ExamResource($exam);
    }

    public function answers(AnswerFilter $filters, Question $question)
    {
        $answers = $question->answers()->filter($filters)->get();
        return AnswerResource::collection($answers);
    }
}
