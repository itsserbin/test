<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class BaseController extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    final public function response(
        array $data = [],
        int   $status = ResponseAlias::HTTP_OK,
        array $headers = [],
        array $cookie = []
    ): JsonResponse
    {
        if (empty($cookie)) {
            return response()->json($data, $status, $headers);
        } else {
            return response()
                ->json($data, $status, $headers)
                ->withCookie(cookie(
                    $cookie['name'],
                    $cookie['value']),
                    $cookie['time'] ?? 980000,
                    '/'
                );
        }
    }
}
