<?php

namespace App\Http\Controllers\Api;

use App\Models\Genre;
use App\Http\Controllers\Api\BaseController;
use OpenApi\Annotations as OA;

class GenreController extends BaseController
{
    /**
     * @OA\Get(
     *     path="/genres",
     *     operationId="genresAll",
     *     tags={"Genres"},
     *     summary="Получить все жанры",
     *     @OA\Response(
     *          response="200",
     *          description="OK"
     *     )
     * )
     */
    public function index()
    {
        return Genre::get();
    }

    /**
     * @OA\Get(
     *     path="/genres/{id}",
     *     operationId="genresOne",
     *     tags={"Genres"},
     *     summary="Получить информацию по жанру",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="OK"
     *     )
     * )
     */
    public function show(Genre $genre)
    {
        return $genre;
    }

}
