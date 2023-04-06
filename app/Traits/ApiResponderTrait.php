<?php

namespace App\Traits;

use Error;
use Illuminate\Http\Response;
use Throwable;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

trait ApiResponderTrait
{
    /**
     * Respond with error.
     * @param $message
     * @param int $statusCode
     * @param Throwable|Exception|Error|null $exception
     * @param int $error_code
     * @return JsonResponse
     */
    protected function respondError($message, int $statusCode = Response::HTTP_BAD_REQUEST, Throwable|Exception|Error $exception = null, int $error_code = 1): JsonResponse
    {
        return $this->apiResponse(
            [
                'success' => false,
                'message' => $message ?? 'There was an internal error, Please try again later',
                'exception' => $exception,
                'error_code' => $error_code == 1 ? $statusCode : $error_code
            ], $statusCode
        );
    }

    /**
     * Respond with validation error.
     * @param ValidationException $exception
     * @param int $statusCode
     * @return JsonResponse
     */
    protected function respondValidationErrors(ValidationException $exception, int $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY): JsonResponse
    {
        return $this->apiResponse(
            [
                'success' => false,
                'message' => $exception->getMessage(),
                'errors' => $exception->errors(),
            ],
            $statusCode
        );
    }

    /**
     * Return generic json response with the given data.
     * @param array $data
     * @param int $statusCode
     * @param array $headers
     * @return JsonResponse
     */
    protected function apiResponse(array $data = [], int $statusCode = Response::HTTP_OK, array $headers = []): JsonResponse
    {
        $result = $this->parseGivenData($data, $statusCode, $headers);
        return response()->json(
            $result['content'], $result['statusCode'], $result['headers']
        );
    }

    public function parseGivenData(array $data = [], int $statusCode = Response::HTTP_OK, array $headers = []): array
    {
        $responseStructure = [
            'success' => $data['success'],
            'message' => $data['message'] ?? null,
            'result' => $data['result'] ?? null,
        ];

        if (isset($data['errors'])) {
            $responseStructure['errors'] = $data['errors'];
        }

        return ["content" => $responseStructure, "statusCode" => $statusCode, "headers" => $headers];
    }

}
