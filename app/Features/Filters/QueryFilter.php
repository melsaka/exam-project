<?php

namespace App\Features\Filters;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

abstract class QueryFilter
{
    protected $query;
    
    protected $request;

    protected $relations = [];
    
    protected $cast = [
        'created' => 'created_at',
        'updated' => 'updated_at'
    ];

    protected $sortOptions = [
        'id',
        'random',
        'created',
        'updated'
    ];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($query)
    {
        $this->query = $query;

        $this->runRelatedMethodsTo($this->queryStrings());

        return $this->query;
    }

    protected function count($relation)
    {
        $this->throwExceptionIfRelationNotSupported($relation);
        return $this->query->withCount($relation);
    }

    protected function filter($filters)
    {
        $filters = array_filter($filters);

        $this->throwExceptionIfFiltersMalformed($filters);

        $this->runRelatedMethodsTo($filters, 'filter');
    }

    protected function runRelatedMethodsTo(array $query, string $methodPrefix = null)
    {
        foreach ($query as $name => $value) {
            $name = $this->getFilterName($name, $methodPrefix);

            $this->runMethodIfExist($name, $value);
        }
    }

    protected function runMethodIfExist($name, $value)
    {
        if (method_exists($this, $name)) {
            $this->callMethodWith($name, $value);
        }
    }

    protected function callMethodWith($name, $value)
    {
        $this->throwExceptionIfNoValue($name, $value);
        call_user_func_array([$this, $name], array_filter([$value]));
    }

    public function sort($column)
    {
        $type = 'ASC';

        if ($this->isColumnSortDesc($column)) {
            $column = str_replace('-', '', $column);
            $type = 'DESC';
        }

        $this->throwExceptionIfColumnSortNotSupported($column);

        if ($column == 'random') {
            return $this->query->inRandomOrder();
        }

        if (array_key_exists($column, $this->cast)) {
            $column = $this->cast[$column];
        }

        return $this->query->orderBy($column, $type);
    }

    protected function queryStrings()
    {
        return $this->request->all();
    }

    protected function getFilterName($name, $methodPrefix)
    {
        return $methodPrefix ? $methodPrefix.ucfirst($name) : $name;
    }

    protected function isColumnSortDesc($column)
    {
        return strpos($column, '-') === 0;
    }

    protected function isMalformedFilters($filters)
    {
        return !is_array($filters) || !$filters;
    }
    
    // Exceptions
    protected function throwExceptionIfFiltersMalformed($filters)
    {
        if ($this->isMalformedFilters($filters)) {
            $this->throwBadRequest("You must provide name and value to filter for ex: filter[name]=value");
        }
    }

    protected function throwExceptionIfNoValue($name, $value)
    {
        return $value ?: $this->throwBadRequest("You must provide value to {$name}");
    }

    protected function throwExceptionIfColumnSortNotSupported($column)
    {
        in_array($column, $this->sortOptions) ?: $this->throwBadRequest("This sort option is not supported [{$column}]");
    }

    protected function throwExceptionIfRelationNotSupported($relation)
    {
        in_array($relation, $this->relations) ?: $this->throwBadRequest("This realtionship is not supported [{$relation}]");
    }

    protected function throwBadRequest($message)
    {
        return throw new BadRequestException($message);
    }

    // Gloabl Filters
    public function filterCreated($value)
    {
        return $this->query->whereDate('created_at', $value);
    }

    public function filterUpdated($value)
    {
        return $this->query->whereDate('updated_at', $value);
    }
}
