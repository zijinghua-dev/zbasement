<?php

namespace App\Exceptions;

use Zijinghua\Zbasement\Exceptions\AuthorizationException as AppAuthorizationException;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Routing\Router;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  Exception $exception
     * @return void
     *
     * @throws Exception
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Prepare exception for rendering.
     *
     * @param  \Exception  $e
     * @return \Exception
     */
    protected function prepareException(Exception $e)
    {
        if ($e instanceof AppAuthorizationException) {
            return $e;
        } elseif ($e instanceof AuthorizationException) {
            $e = new AccessDeniedHttpException($e->getMessage(), $e);
        } elseif ($e instanceof TokenMismatchException) {
            $e = new HttpException(419, $e->getMessage(), $e);
        }
        return $e;
    }

    public function getNamespace()
    {
        return (new \ReflectionClass($this))->getNamespaceName().'\\Response';
    }

    public function getExceptionResponseClass(Exception $e)
    {
        return $this->getNamespace().'\\'.(new \ReflectionClass($e))->getName().'Response';
    }

    protected function exceptionResponse($request, Exception $e)
    {
        if ($e instanceof HttpResponseException) {
            return $e->getResponse();
        } elseif ($e instanceof ValidationException) {
            return $this->convertValidationExceptionToResponse($e, $request);
        }

        return $request->expectsJson()
            ? $this->prepareJsonResponse($request, $e)
            : $this->prepareResponse($request, $e);
    }

    /**
     * Render an exception into an HTTP response.
     * @param \Illuminate\Http\Request $request
     * @param Exception $e
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     * @throws \ReflectionException
     */
    public function render($request, Exception $e)
    {
        if (method_exists($e, 'render') && $response = $e->render($request)) {
            return Router::toResponse($request, $response);
        } elseif ($e instanceof Responsable) {
            return $e->toResponse($request);
        }

        $e = $this->prepareException($e);

        $responseClass = $this->getExceptionResponseClass($e);

        if (class_exists($responseClass) && $request->expectsJson()) {
            $reflectionClass = new \ReflectionClass($responseClass);
            if ($reflectionClass->isSubclassOf(ExceptionResponse::class)) {
                return (new $responseClass($request, $e))->response();
            }
        }

        return $this->exceptionResponse($request, $e);
    }

    protected function unauthorized($request, AppAuthorizationException $e)
    {
        return $request->expectsJson()
            ? response()->json(['message' => $e->getMessage()], 403)
            : $this->prepareResponse($request, $e);
    }
}
