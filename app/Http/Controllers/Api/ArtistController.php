<?php

namespace App\Http\Controllers\Api;

use App\Models\Artist;
use App\Models\Track;
use App\Http\Controllers\Controller;

class ArtistController extends Controller
{
    /**
     * @OA\Get(
     *     path="/artists/{column}/{sort}",
     *     operationId="artists",
     *     tags={"Artists"},
     *     summary="Получить список артистов",
     *     @OA\Parameter(
     *          name="column",
     *          in="path",
     *          required=false,
     *          description="id, name, created_at, updated_at, likes",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="sort",
     *          in="path",
     *          required=false,
     *          description="asc, desc",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Все хорошо"
     *     ),
     * )
     */
    public function index(string $column = 'id', string $sort = 'DESC')
    {
        $query = Artist::query();
        if ($column === 'likes') {
            $column = 'likes_count';
            $query->withCount('likes');
        }
        return $query->orderBy($column, $sort)
            ->paginate(config('main.pagination'));
    }

    /**
     * @OA\Get(
     *     path="/artists/top/{limit}",
     *     operationId="artistsTop",
     *     tags={"Artists"},
     *     summary="Получить лучших артистов",
     *     @OA\Parameter(
     *          name="limit",
     *          in="path",
     *          required=false,
     *          description="Сколько записей вывести. По умолчанию: 3",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Все хорошо"
     *     ),
     * )
     */
    public function top($limit = 3)
    {
        return Artist::limit($limit)->get();
    }

    public function tracks(Artist $artist)
    {
        return Track::get();
    }

    /**
     * Display the specified resource.
     */
    public function show(Artist $artist)
    {
        $tracks = $artist->tracks()->orderBy('id', 'desc')->get();

        return response([
            'artist' => $artist,
            'tracks' => $tracks
        ]);
    }

    /**
     * @OA\Post (
     *     path="/artists/like/{artistId}",
     *     operationId="artistsLike",
     *     tags={"Artists"},
     *     summary="Лайк артиста",
     *     security={{ "apiAuth": {} }},
     *     @OA\Parameter(
     *          name="artistId",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="OK",
     *          @OA\JsonContent()
     *     ),
     * )
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function like(Artist $artist)
    {

        auth('api')->user()->like($artist);
        return response()->json(['message' => 'Success']);
    }

    /**
     * @OA\Post (
     *     path="/artists/unlike/{artistId}",
     *     operationId="artistsUnlike",
     *     tags={"Albums"},
     *     summary="Снять лайк с артиста",
     *     security={{ "apiAuth": {} }},
     *     @OA\Parameter(
     *          name="artistId",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="OK",
     *          @OA\JsonContent()
     *     ),
     * )
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function unlike(Artist $artist)
    {
        auth('api')->user()->unlike($artist);
        return response()->json(['message' => 'Success']);
    }

    /**
     * @OA\Post (
     *     path="/artists/dislike/{artistId}",
     *     operationId="artistsDislike",
     *     tags={"Artists"},
     *     summary="Дизлайк артиста",
     *     security={{ "apiAuth": {} }},
     *     @OA\Parameter(
     *          name="artistId",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="OK",
     *          @OA\JsonContent()
     *     ),
     * )
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function dislike(Artist $artist)
    {
        auth()->user()->dislike($artist);
        return response()->json(['message' => 'Success']);
    }

}
