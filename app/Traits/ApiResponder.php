<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponder
{
    /**
     * @param $result
     * @param string $msg
     * @return JsonResponse
     */
    public function handleResponse($result, string $msg = ''): JsonResponse
    {
        $res = [
            'success' => true,
            'data' => $result,
            'message' => $msg,
        ];

        return response()->json($res, 200);
    }

    /**
     * @param string $error
     * @param array $errorMsg
     * @param int $code
     * @return JsonResponse
     */
    public function handleError(string $error, array $errorMsg = [], int $code = 404): JsonResponse
    {
        $res = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMsg)) {
            $res['data'] = $errorMsg;
        }

        return response()->json($res, $code);
    }
}