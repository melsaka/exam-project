<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Features\Resources\Traits\WithRelations;
use App\Features\Resources\Traits\WithStatusCode;

class SubjectResource extends JsonResource
{
    use WithRelations, WithStatusCode;
    
    protected $relationResource = [
        'exams' => ExamResource::class
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
            'type'          =>  'subjects',
            'id'            =>  $this->id,
            'attributes'    =>  [
                'name'          =>  $this->name,
                'description'   =>  $this->description,
                'exams_count'   =>  $this->when($this->exams_count, $this->exams_count),
                'created'       =>  $this->created_at->toDateTimeString(),
                'updated'       =>  $this->updated_at->toDateTimeString()
            ],
            "relationships" =>  $this->getRelationships()
        ];
    }
}
