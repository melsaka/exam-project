<?php

namespace App\Features\Resources\Traits;

trait WithStatusCode
{
    protected $statusCode;

    public function __construct($resource, $statusCode = 200)
    {
        parent::__construct($resource);
        $this->statusCode = $statusCode;
    }

    public function toResponse($request)
    {
        return parent::toResponse($request)->setStatusCode($this->statusCode);
    }
}
