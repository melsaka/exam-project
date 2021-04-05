<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        if ($this->isJsonOrAjax($request) && $exception instanceof ModelNotFoundException) {
            $message = class_basename($exception->getModel()) . ' Not Found';
            return $this->respondNotFound($message);
        }

        if ($this->isJsonOrAjax($request) && $exception instanceof NotFoundHttpException) {
            return $this->respondNotFound('Page Not Found');
        }

        if ($this->isJsonOrAjax($request) && $exception instanceof BadRequestException) {
            return $this->respondBadRequest($exception->getMessage());
        }

        if ($this->isJsonOrAjax($request) && $exception instanceof ThrottleRequestsException) {
            return $this->respondTooManyRequests($exception->getMessage());
        }

        return parent::render($request, $exception);
    }

    protected function isJsonOrAjax($request)
    {
        return $request->wantsJson() || $request->ajax();
    }

    protected function respondNotFound($message)
    {
        return $this->respondWithError($message, 404);
    }

    protected function respondBadRequest($message)
    {
        return $this->respondWithError($message, 400);
    }

    protected function respondTooManyRequests($message)
    {
        return $this->respondWithError($message, 429);
    }

    protected function respondWithError($message, $code)
    {
        return response()->json([
            'errors' => [
                'title'     =>  $message,
                'status'    =>  $code
            ]
        ], $code);
    }
}
