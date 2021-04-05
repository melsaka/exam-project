<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Features\Resources\Traits\WithStatusCode;

class UserResource extends JsonResource
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
            'type'          =>  'users',
            'id'            =>  $this->id,
            'attributes'    =>  [
                'name'              =>  $this->name,
                'username'          =>  $this->username,
                'email'             =>  $this->email,
                'email_verified_at' =>  $this->email_verified_at,
                'created'           =>  $this->created_at->toDateTimeString(),
                'updated'           =>  $this->updated_at->toDateTimeString()
            ]
        ];
    }
}
