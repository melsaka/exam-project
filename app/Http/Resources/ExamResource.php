<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Features\Resources\Traits\WithRelations;
use App\Features\Resources\Traits\WithStatusCode;

class ExamResource extends JsonResource
{
    use WithRelations, WithStatusCode;
    
    protected $relationResource = [
        'subject'   => SubjectResource::class,
        'questions' => QuestionResource::class
    ];

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type'          =>  'exams',
            'id'            =>  $this->id,
            'attributes'    =>  [
                'name'              =>  $this->name,
                'description'       =>  $this->description,
                'subject_id'        =>  $this->subject_id,
                'questions_count'   =>  $this->when($this->questions_count, $this->questions_count),
                'created'           =>  $this->created_at->toDateTimeString(),
                'updated'           =>  $this->updated_at->toDateTimeString()
            ],
            "relationships" =>  $this->getRelationships()
        ];
    }
}
