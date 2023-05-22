<?php

namespace App\Swagger\Auth;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     description="User registration model",
 *     type="object",
 *     title="User Register Request"
 * )
 */

class SwaggerRegisterRequest
{
    /**
     * @OA\Property(
     *     title="Email",
     *     description="User's account email",
     *     format="string",
     *     example="awesome@example.com"
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *     title="Password",
     *     description="Hash of password",
     *     format="string",
     *     example="somefunhash"
     * )
     *
     * @var string
     */
    public $password;

    /**
     * @OA\Property(
     *     title="Password confirmation",
     *     description="Hash of password confirmation",
     *     format="string",
     *     example="somefunhash"
     * )
     *
     * @var string
     */
    public $password_confirmation;

    /**
     * @OA\Property(
     *     title="Name",
     *     description="User's account name",
     *     format="string",
     *     example="Example"
     * )
     *
     * @var string
     */
    public $name;
}
