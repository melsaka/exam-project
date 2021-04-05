<?php

namespace App\Features\Resources\Traits;

use Illuminate\Support\Str;

trait WithRelations
{
    protected function getRelationships()
    {
        return $this->when($this->isHavingRelationshipsProperty(), function () {
            return $this->loadRelationships();
        });
    }

    protected function loadRelationships()
    {
        $relationships = [];

        foreach ($this->relationships as $relationship => $data) {
            $relationships[$relationship] = $this->getRelatedResource($relationship, $data);
        }

        return $relationships;
    }

    protected function getRelatedResource($relationship, $data)
    {
        if (Str::endsWith($relationship, 's')) {
            return $this->relationResource[$relationship]::collection($data)
                        ->response()
                        ->getData(true);
        }
        
        return (new $this->relationResource[$relationship]($data))
                        ->response()
                        ->getData(true);
    }

    protected function isHavingRelationshipsProperty()
    {
        return $this->relationships ? true : false;
    }
}
