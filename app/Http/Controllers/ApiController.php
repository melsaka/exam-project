<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response as Status;

class ApiController extends Controller
{
    protected $statusCode = Status::HTTP_OK;

    protected function getStatusCode()
    {
        return $this->statusCode;
    }

    protected function setStatusCode(Int $statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    protected function respondDeleted()
    {
        return $this->setStatusCode(Status::HTTP_NO_CONTENT)->respond([]);
    }

    protected function respondNotfound(String $message)
    {
        return $this->setStatusCode(Status::HTTP_NOT_FOUND)->respondWithError($message);
    }

    protected function respondWithError(String $message)
    {
        return $this->respond([
            "errors" => [
                "title" => $message,
                "status" => Status::HTTP_NOT_FOUND,
            ]
        ]);
    }

    protected function respond($data, $headers = [])
    {
        return response()->json($data, $this->getStatusCode(), $headers);
    }
}
