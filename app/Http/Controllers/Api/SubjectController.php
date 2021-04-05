<?php

namespace App\Http\Controllers\Api;

use App\Features\Includes\SubjectInclude;
use App\Http\Controllers\ApiController;
use App\Http\Resources\SubjectResource;
use App\Features\Filters\SubjectFilter;
use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends ApiController
{
    public function index(SubjectFilter $filters, SubjectInclude $includes)
    {
        $subjects = Subject::filter($filters)->get();
        
        $includes->applyOn($subjects);
        
        return SubjectResource::collection($subjects);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          =>  'required|max:255',
            'description'   =>  'required|max:255',
        ]);

        $subject                = new Subject;
        $subject->name          = $request->name;
        $subject->description   = $request->description;
        $subject->save();

        return new SubjectResource($subject, 201);
    }

    public function show(SubjectInclude $includes, SubjectFilter $filters, $id)
    {
        $subject = Subject::filter($filters)->where('id', $id)->firstOrFail();

        $includes->applyOn($subject);

        return new SubjectResource($subject);
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name'          =>  'required|max:255',
            'description'   =>  'required|max:255',
        ]);

        $subject->name          = $request->name;
        $subject->description   = $request->description;
        $subject->save();

        return new SubjectResource($subject);
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();

        return $this->respondDeleted();
    }
}
