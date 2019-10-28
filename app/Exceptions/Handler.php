<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

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
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {

        if ($exception instanceof UnauthorizedHttpException) {
            $preException = $exception->getPrevious();
            if ($preException instanceof
                \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json([
                    'resultado' => [
                        'status' => 'fail',
                        'error'=> 'TOKEN_EXPIRED'
                    ]
                ],Response::HTTP_UNAUTHORIZED);
            } else if ($preException instanceof
                \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json([
                    'resultado' => [
                        'status' => 'fail',
                        'error'=> 'TOKEN_INVALID'
                    ]
                ],Response::HTTP_UNAUTHORIZED);
            } else if ($preException instanceof
                \Tymon\JWTAuth\Exceptions\TokenBlacklistedException) {
                return response()->json([
                    'resultado' => [
                        'status' => 'fail',
                        'error'=> 'TOKEN_BLACKLISTED'
                    ]
                ],Response::HTTP_UNAUTHORIZED);
            }
            if ($exception->getMessage() === 'Token not provided') {
                return response()->json([
                    'resultado' => [
                        'status' => 'fail',
                        'error'=> 'Token not provided'
                    ]
                ],Response::HTTP_UNAUTHORIZED);
            }
        }

        if($exception instanceof ModelNotFoundException){
            $modelo = explode('\\', $exception->getModel());
            $modelo = Str::lower(end($modelo));
            if(Str::contains($exception->getMessage(),'No query results for model')){
                return response()->json([
                    'resultado' => [
                        'status' => 'fail',
                        'error'=> "The $modelo requested does not exists"
                    ]
                ],Response::HTTP_NOT_FOUND);
            }
        }

        return parent::render($request, $exception);
    }
}
