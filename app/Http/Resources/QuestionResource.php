<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Features\Resources\Traits\WithRelations;
use App\Features\Resources\Traits\WithStatusCode;

class QuestionResource extends JsonResource
{
    use WithRelations, WithStatusCode;
    
    protected $relationResource = [
        'exam' => ExamResource::class,
        'answers' => AnswerResource::class
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
            'type'          =>  'questions',
            'id'            =>  $this->id,
            'attributes'    =>  [
                'body'              =>  $this->body,
                'exam_id'           =>  $this->exam_id,
                'answers_count'     =>  $this->when($this->answers_count, $this->answers_count),
                'created'           =>  $this->created_at->toDateTimeString(),
                'updated'           =>  $this->updated_at->toDateTimeString()
            ],
            "relationships" =>  $this->getRelationships()
        ];
    }
}
