<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponder
{
    /**
     * @param $data
     * @param int $code
     * @return JsonResponse
     */
    protected function handleResponse($data, int $code = 200): JsonResponse
    {
        return response()->json($data, $code, [], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    /**
     * @param int $code
     * @param string $message
     * @return JsonResponse
     */
    protected function handleError(int $code, string $message): JsonResponse
    {
        $res = [
            'code' => $code,
            'message' => $message,
        ];

        return response()->json($res, 200, [], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}