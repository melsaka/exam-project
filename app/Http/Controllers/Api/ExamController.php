<?php

namespace App\Http\Controllers\Api;

use App\Features\Includes\ExamInclude;
use App\Http\Controllers\ApiController;
use App\Http\Resources\ExamResource;
use App\Features\Filters\ExamFilter;
use Illuminate\Http\Request;
use App\Models\Exam;

class ExamController extends ApiController
{
    public function index(ExamFilter $filters, ExamInclude $includes)
    {
        $exams = Exam::filter($filters)->paginate()->withQueryString();
        
        $includes->applyOn($exams);

        return ExamResource::collection($exams);
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject_id'    =>  'required|exists:subjects,id',
            'name'          =>  'required|max:255',
            'description'   =>  'required|max:255',
        ]);

        $exam               = new Exam;
        $exam->name         = $request->name;
        $exam->description  = $request->description;
        $exam->subject_id   = $request->subject_id;
        $exam->save();

        return new ExamResource($exam, 201);
    }

    public function show(ExamInclude $includes, ExamFilter $filters, $id)
    {
        $exam = Exam::filter($filters)->where('id', $id)->firstOrFail();

        $includes->applyOn($exam);
    
        return new ExamResource($exam);
    }

    public function update(Request $request, Exam $exam)
    {
        $request->validate([
            'subject_id'    =>  'required|exists:subjects,id',
            'name'          =>  'required|max:255',
            'description'   =>  'required|max:255',
        ]);

        $exam->name          = $request->name;
        $exam->description   = $request->description;
        $exam->subject_id    = $request->subject_id;
        $exam->save();

        return new ExamResource($exam);
    }

    public function destroy(Exam $exam)
    {
        $exam->delete();

        return $this->respondDeleted();
    }
}
