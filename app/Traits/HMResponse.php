<?php

namespace App\Traits;

/**
 * HMResponse
 */
trait HMResponse
{
    protected function success($data = [], $message = "Data found")
    {
        return response([
            'error' => 0,
            'message' => $message,
            'data' => $data,
        ], 200);
    }

    protected function validationError($message = "Validate your data first")
    {
        return response([
            'error' => 1,
            'message' => $message,
        ], 422);
    }
}
