<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\User\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use OpenApi\Annotations as OA;

class AuthController extends BaseController
{

    protected $guard;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $header = $request->header();

        if (
            (isset($header['accept'][0]) AND $header['accept'][0] === 'application/json')
            OR
            (isset($header['content-type'][0]) AND $header['content-type'][0] === 'application/json')
        ) {
            $this->guard = 'api';
        } else {
            $this->guard = 'web';
        }
    }

    /**
     * @OA\Post (
     *     path="/auth/login",
     *     operationId="authLogin",
     *     tags={"Auth"},
     *     summary="Авторизация пользователя",
     *     @OA\Response(
     *          response="200",
     *          description="OK"
     *     ),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/SwaggerLoginRequest")
     *     )
     * )
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth($this->guard)->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * @OA\Post (
     *     path="/auth/register",
     *     operationId="authRegister",
     *     tags={"Auth"},
     *     summary="Регистрация пользователя",
     *     @OA\Response(
     *          response="200",
     *          description="OK",
     *          @OA\JsonContent()
     *     ),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/SwaggerRegisterRequest")
     *     )
     * )
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    /**
     * @OA\Post (
     *     path="/auth/me",
     *     operationId="authMe",
     *     tags={"Auth"},
     *     summary="Информация о пользователе",
     *     security={{ "apiAuth": {} }},
     *     @OA\Response(
     *          response="200",
     *          description="OK",
     *          @OA\JsonContent()
     *     ),
     * )
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth($this->guard)->user());
    }

    /**
     * @OA\Post (
     *     path="/auth/logout",
     *     operationId="authLogout",
     *     tags={"Auth"},
     *     summary="Выход",
     *     security={{ "apiAuth": {} }},
     *     @OA\Response(
     *          response="200",
     *          description="OK",
     *          @OA\JsonContent()
     *     ),
     * )
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth($this->guard)->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * @OA\Post (
     *     path="/auth/refresh",
     *     operationId="authRefresh",
     *     tags={"Auth"},
     *     summary="Обновление токена",
     *     security={{ "apiAuth": {} }},
     *     @OA\Response(
     *          response="200",
     *          description="OK",
     *          @OA\JsonContent()
     *     ),
     * )
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth($this->guard)->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth($this->guard)->factory()->getTTL() * 60
        ]);
    }
}
