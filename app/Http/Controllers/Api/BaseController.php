<?php



namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use OpenApi\Annotations as OA;

/**
 * @OA\Info (
 *      title="Music Site API Documentation",
 *      version="1.0.0",
 *      @OA\Contact(
 *          email="ervin.dev@yandex.ru"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licences/LICENSE-2.0.html"
 *      )
 * )
 * @OA\SecurityScheme(
 *     type="http",
 *     description="Login with email and password to get the authentication token",
 *     name="Token based Based",
 *     in="header",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     securityScheme="apiAuth",
 * )
 * @OA\Tag(
 *      name="Genres",
 *      description="Получение информации о жанрах"
 * )
 * @OA\Tag(
 *      name="Tracks",
 *      description="Получение информации о треках"
 *),
 * @OA\Tag(
 *      name="Artists",
 *      description="Получение информации о артистах"
 * ),
 * @OA\Tag(
 *      name="Albums",
 *      description="Получение информации о альбомах"
 * ),
 * @OA\Tag(
 *      name="Auth",
 *      description="Авторизация"
 * ),
 * @OA\Server(
 *      description="Путь к серверу",
 *      url="http://127.0.0.1:8000/api/"
 * )
 */
class BaseController extends Controller
{

}
