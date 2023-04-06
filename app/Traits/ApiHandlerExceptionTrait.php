<?php

namespace App\Traits;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

trait ApiHandlerExceptionTrait {

    protected function apiHandleException(Throwable $e): ?JsonResponse
    {
        if ($attribute = $this->exceptionIsNotFound($e)) {
            return apiResponse()->respond(
                null, Response::HTTP_NOT_FOUND, false, __('validation.exists', ['attribute' => $attribute])
            );
        } else if ($e instanceof ValidationException) {
            return apiResponse()->respondValidationErrors($e, Response::HTTP_UNPROCESSABLE_ENTITY);
        } else if ($e instanceof HttpException) {
            $message = $e->getMessage() == "" ? Response::$statusTexts[$e->getStatusCode()] : $e->getMessage();
            return apiResponse()->respondError($message, $e->getStatusCode(), $e);
        } else if ($e instanceof AuthorizationException) {
            return apiResponse()->respondError($e->getMessage(), Response::HTTP_FORBIDDEN);
        } else if ($e instanceof AuthenticationException) {
            return apiResponse()->respondError($e->getMessage(), Response::HTTP_UNAUTHORIZED);
        } else if ($e instanceof PostTooLargeException) {
            $message = "Size of attached file should be less " . ini_get("upload_max_filesize") . "B";
            return apiResponse()->respondError($message, Response::HTTP_BAD_REQUEST);
        } else if ($e instanceof ThrottleRequestsException) {
            return apiResponse()->respondError($e->getMessage(), Response::HTTP_TOO_MANY_REQUESTS);
        } else if ($e instanceof QueryException) {
            $message = 'There was Issue with the Query';
            return apiResponse()->respondError($message, Response::HTTP_INTERNAL_SERVER_ERROR, $e);
        } else if ($e instanceof \Error) {
            $message = 'There was some internal error';
            return apiResponse()->respondError($message, Response::HTTP_INTERNAL_SERVER_ERROR, $e);
        }

        return null;
    }

    /**
     * @param \Exception|Throwable $exception
     */
    protected function exceptionIsNotFound(\Exception|Throwable $exception)
    {
        if ($exception instanceof ModelNotFoundException )
            return __('validation.attributes.'.$this->getModelName($exception));
        elseif ($exception instanceof NotFoundHttpException)
            return __('validation.attributes.info');

        return null;
    }

    /**
     * @param ModelNotFoundException $exception
     * @return string
     */
    protected function getModelName(ModelNotFoundException $exception): string
    {
        return strtolower(class_basename($exception->getModel()));
    }
}
