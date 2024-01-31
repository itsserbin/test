<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

class JsonResponseException extends Exception
{
    final public function render(): JsonResponse
    {
        return response()->json([
            'success' => false,
            'error' => [
                'message' => $this->getMessage(),
                'code' => $this->getCode(),
            ],
        ], $this->getStatusCode());
    }

    private function getStatusCode(): int
    {
        return method_exists($this, 'getStatusCodeCustom') ? $this->getStatusCodeCustom() : 500;
    }
}
