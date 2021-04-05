<?php

namespace App\Http\Controllers\Api;

use App\Features\Filters\QuestionFilter;
use App\Features\Includes\QuestionInclude;
use App\Http\Resources\QuestionResource;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends ApiController
{
    public function store(Request $request)
    {
        $request->validate([
            'body'      =>  'required|max:1000',
            'exam_id'   =>  'required|exists:exams,id'
        ]);

        $question               = new Question;
        $question->body         = $request->body;
        $question->exam_id      = $request->exam_id;
        $question->save();

        return new QuestionResource($question, 201);
    }

    public function show(QuestionInclude $includes, QuestionFilter $filters, $id)
    {
        $question = Question::filter($filters)->where('id', $id)->firstOrFail();

        $includes->applyOn($question);

        return new QuestionResource($question);
    }

    public function update(Request $request, Question $question)
    {
        $request->validate([
            'body'      =>  'required|max:1000',
        ]);

        $question->body     = $request->body;
        $question->save();

        return new QuestionResource($question);
    }

    public function destroy(Question $question)
    {
        $question->delete();

        return $this->respondDeleted();
    }
}
