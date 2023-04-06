<?php


namespace App\Helpers\Api;

use App\Traits\ApiResponderTrait;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiResponse
{
    use ApiResponderTrait {
        ApiResponderTrait::respondError as public;
        ApiResponderTrait::respondValidationErrors as public;
    }

    public function respond($data, $statusCode = Response::HTTP_OK, $ok = true, $message = null, $headers = []): JsonResponse
    {
        $response = [
            'success' => $ok,
            'message' => $message,
            'result' => $data
        ];

        return $this->apiResponse($response, $statusCode, $headers);
    }
}
