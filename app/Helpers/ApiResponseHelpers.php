<?php


use App\Helpers\Api\ApiResponse;

if (!function_exists('apiResponse')) {
    function apiResponse(): ApiResponse
    {
        return new ApiResponse();
    }
}
