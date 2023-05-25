<?php

namespace App\Exceptions;

use Exception;
use http\Env\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Intervention\Image\Exception\NotFoundException;
use Mockery\Exception\InvalidOrderException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        "current_password",
        "password",
        "password_confirmation",
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (Exception $e, $request) {
//            app()->setLocale($request->language);
//
//            if($e instanceof NotFoundHttpException) {
//                return response()->view('errors.404', [], 404);
//            }

//            return parent::render($request, $e);
        });
    }

    public function render($request, Throwable $e)
    {
        if($e instanceof ModelNotFoundException)
        {
            if($request->hasCookie('locale')) {
                $cookie = $request->cookie('locale');
                $cookie = strlen($cookie) > 2 ? decrypt($cookie): $cookie;
                app()->setLocale($cookie);
            }
        }

        return parent::render($request, $e);
    }
}
