<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Throwable;

class AuthController extends Controller
{
    use ApiResponder;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(),[
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => ['required', 'confirmed', Password::min(4)],
            ]);

            if ($validator->fails()) {
                return $this->validation(null, $validator->messages());
            } else {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);

                event(new Registered($user));

                $token = $user->createToken('authtoken');

                return $this->ok(null, [
                    'token' => $token->plainTextToken,
                    'user' => $user
                ]);
            }
        } catch (Throwable $e) {
            return $this->error(null, [
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $request->authenticate();

            $user = $request->user();

            $token = $user->createToken('authtoken');

            return $this->ok(null, [
                'token' => $token->plainTextToken,
                'user' => $user
            ]);
        } catch (ValidationException $e) {
            return $this->validation(null, $e->errors());
        } catch (Throwable $e) {
            return $this->error(null, [
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        try {
            $user = $request->user();

            $user->tokens()->delete();

            return $this->ok(null, [
                'user' => $user
            ]);
        } catch (Throwable $e) {
            return $this->error(null, [
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }
    }
}