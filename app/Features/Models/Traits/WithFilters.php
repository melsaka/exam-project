<?php

namespace App\Features\Models\Traits;

use App\Features\Filters\QueryFilter;

trait WithFilters
{
    public function scopeFilter($query, QueryFilter $filters)
    {
        return $filters->apply($query);
    }
}
