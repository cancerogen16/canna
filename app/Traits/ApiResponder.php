<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponder
{
    /**
     * @param $data
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    protected function handleResponse($data, string $message = '', int $code = 200): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
        ], $code, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param string $error
     * @param array $errorMsg
     * @return JsonResponse
     */
    protected function handleError(string $error, array $errorMsg = []): JsonResponse
    {
        $res = [
            'message' => $error,
        ];

        if (!empty($errorMsg)) {
            $res['data'] = $errorMsg;
        }

        return response()->json($res, 404, [], JSON_UNESCAPED_UNICODE);
    }
}