<?php

namespace App\Exceptions;

use http\Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {

        if ($request->wantsJson()){

            $exception = $this->prepareException($exception);

            if ($exception instanceof ValidationException) {
                return response([
                    'errors' => $exception->errors()
                ], 422);
            }


            if ($exception instanceof AuthenticationException) {
                $exception = $this->unauthenticated($request, $exception);
                if ($exception->getStatusCode() == 401)
                {
                    return response([
                    'message' => 'کاربر احراز هویت نشده'
                ], 401);
                }
//
            }
            $code = method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500;

            return response([
                'message' => $code == 500 ? 'خطای سرور': $exception->getMessage()
            ], empty($code)? 500 : $code);
        }
        return parent::render($request, $exception);
    }
}
