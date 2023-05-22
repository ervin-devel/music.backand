<?php

namespace App\Swagger\Auth;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     description="User request authorization model",
 *     type="object",
 *     title="User Login Request"
 * )
 */

class SwaggerLoginRequest
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
}
