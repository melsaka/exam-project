<?php

namespace App\Features\Includes;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

abstract class QueryInclude
{
    protected $request;

    protected $includes;

    protected $relationships = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->prepareIncludes()
            ->checkIfIncludesSupported();
    }

    public function applyOn($object)
    {
        if ($object instanceof LengthAwarePaginator || $object instanceof Collection) {
            return $this->iterateOver($object);
        }

        return $this->initRelationships($object);
    }

    protected function iterateOver($collection)
    {
        $collection->map(function ($model) {
            return $this->initRelationships($model);
        });
    }
    // This code needs cleanup [refactor]
    protected function initRelationships($model)
    {
        $relationships = [];

        foreach ($this->includes as $include) {
            if (Str::endsWith($include, 's')) {
                $relationships[$include] = $model->$include()
                                                ->orderBy('id', 'desc')
                                                ->paginate();
                $target = lcfirst(class_basename($model)) .'s';
                $relationships[$include]->withPath(url('/')."/api/{$target}/{$model->id}/relationships/{$include}");
                continue;
            }

            $relationships[$include] = $model->$include()->first();
        }

        !$relationships ?: $model->relationships = $relationships;
    }

    protected function prepareIncludes()
    {
        $includes = $this->request->input('include');

        $this->includes = $includes ? array_filter(explode(',', $includes)) : [];

        return $this;
    }

    protected function checkIfIncludesSupported()
    {
        foreach ($this->includes as $include) {
            in_array($include, $this->relationships) ?:
                $this->throwBadRequest("This relationship is not supported [{$include}]");
        }
    }

    protected function throwBadRequest($message)
    {
        return throw new BadRequestException($message);
    }
}
