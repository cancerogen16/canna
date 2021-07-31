<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponder
{
    /**
     * Create API response.
     *
     * @param int    $status
     * @param string $message
     * @param array  $data
     *
     * @return JsonResponse
     */
    public function response(int $status = 200, string $message = null, array $data = [])
    {
        $json = [
            'status'  => strval($status),
            'message' => $message,
            'data'    => $data,
        ];

        return response()->json($json, 200, [], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    /**
     * Create successful (200) API response.
     *
     * @param string $message
     * @param array  $data
     *
     * @return JsonResponse
     */
    public function ok(string $message = null, array $data = [])
    {
        if (is_null($message)) {
            $message = '';
        }

        return $this->response(200, $message, $data);
    }

    /**
     * Create successful (200) API response.
     *
     * @param string $message
     * @param array  $data
     *
     * @return JsonResponse
     */
    public function success(string $message = null, array $data = [])
    {
        return $this->ok($message, $data);
    }

    /**
     * Create Not found (404) API response.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    public function notFound(string $message = null)
    {
        if (is_null($message)) {
            $message = 'Not found';
        }

        return $this->response(404, $message, []);
    }

    /**
     * Create Validation (422) API response.
     *
     * @param string $message
     * @param array  $errors
     *
     * @return JsonResponse
     */
    public function validation(string $message = null, array $errors = [])
    {
        if (is_null($message)) {
            $message = 'Validation Failed';
        }

        return $this->response(422, $message, $errors);
    }

    /**
     * Create Validation (422) API response.
     *
     * @param string $message
     * @param array  $data
     *
     * @return JsonResponse
     */
    public function forbidden(string $message = null, array $data = [])
    {
        if (is_null($message)) {
            $message = 'You don\'t have permission to access this content';
        }

        return $this->response(403, $message, $data);
    }

    /**
     * Create Server error (500) API response.
     *
     * @param string $message
     * @param array  $data
     *
     * @return JsonResponse
     */
    public function error(string $message = null, array $data = [])
    {
        if (is_null($message)) {
            $message = 'Server error';
        }

        return $this->response(500, $message, $data);
    }
}