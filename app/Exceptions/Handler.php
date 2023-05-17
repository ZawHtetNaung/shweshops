<?php

namespace App\Exceptions;

use Throwable;
use App\Http\Middleware\EncryptCookies;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
     * @throws \Throwable
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
    public function render($request, Throwable $e)
    {

        if ($e instanceof NotFoundHttpException) {
            /** @var StartSession $sessionMiddleware */
            $sessionMiddleware = resolve(StartSession::class);

            /** @var EncryptCookies $decrypter */
            $decrypter = resolve(EncryptCookies::class);
            $decrypter->handle(request(), fn() => $sessionMiddleware->handle(request(), fn() => response('')));
            return response()->view('errors.404',[],404);
        }

        return parent::render($request,$e);
    }


}