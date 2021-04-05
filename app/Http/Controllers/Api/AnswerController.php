<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Resources\AnswerResource;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;

class AnswerController extends ApiController
{
    public function store(Request $request, Question $question)
    {
        $request->validate([
            'body'      => 'required|max:1000',
            'status'    => 'required|in:right,wrong'
        ]);

        $answer                 = new Answer;
        $answer->body           = $request->body;
        $answer->status         = $request->status == 'right' ? true : false;
        $answer->question_id    = $question->id;
        $answer->save();

        return new AnswerResource($answer, 201);
    }

    public function destroy(Question $question, Answer $answer)
    {
        $answer->delete();

        return $this->respondDeleted();
    }
}
