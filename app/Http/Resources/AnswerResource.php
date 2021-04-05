<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Features\Resources\Traits\WithStatusCode;

class AnswerResource extends JsonResource
{
    use WithStatusCode;
    
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type'          =>  'answers',
            'id'            =>  $this->id,
            'attributes'    =>  [
                'body'          =>  $this->body,
                'status'        =>  $this->status,
                'question_id'   =>  $this->question_id,
                'created'       =>  $this->created_at->toDateTimeString(),
                'updated'       =>  $this->updated_at->toDateTimeString()
            ]
        ];
    }
}
