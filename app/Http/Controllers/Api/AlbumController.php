<?php

namespace App\Http\Controllers\Api;

use App\Models\Album;

class AlbumController extends BaseController
{

    private $availableColumns = ['id', 'title', 'slug', 'cover', 'content'];

    /**
     * @OA\Get(
     *     path="/albums/{column}/{sort}",
     *     operationId="albumsAll",
     *     tags={"Albums"},
     *     summary="Получить все альбомы",
     *     @OA\Parameter(
     *          name="column",
     *          in="path",
     *          required=false,
     *          description="id, created_at, updated_at, likes",
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
     *     @OA\Parameter(
     *          name="page",
     *          in="query",
     *          required=false,
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
    public function index(string $column = 'id', string $sort = 'desc')
    {
        $query = Album::select($this->availableColumns)
            ->where('is_published', true);

        if ($column === 'likes') {
            $column = 'likes_count';
            $query->withCount('likes');
        }

        return $query->orderBy($column, $sort)
            ->paginate(config('main.paginate'));
    }

    /**
     * @OA\Get(
     *     path="/albums/{albumId}",
     *     operationId="albumsOne",
     *     tags={"Albums"},
     *     summary="Получить информацию по альбому",
     *     @OA\Parameter(
     *          name="albumId",
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
    public function show(int $albumId)
    {
        try {

            $data = Album::where([
                ['id', $albumId],
                ['is_published', true]
            ])
                ->select($this->availableColumns)
                ->with('genres', 'artists')
                ->withCount('likes', 'dislikes')
                ->findOrFail($albumId);

            $data->all_duration = $data->getAllDuration();
            return response($data, 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return response([
                'status' => 'error',
                'error' => 'Album not found'
            ], 404);

        }
    }

    /**
     * @OA\Post (
     *     path="/albums/like/{albumId}",
     *     operationId="albumsLike",
     *     tags={"Albums"},
     *     summary="Лайк на альбом",
     *     security={{ "apiAuth": {} }},
     *     @OA\Parameter(
     *          name="albumId",
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
    public function like(Album $album)
    {
        auth('api')->user()->like($album);
        return response()->json(['message' => 'Success']);
    }

    /**
     * @OA\Post (
     *     path="/albums/unlike/{albumId}",
     *     operationId="albumsUnlike",
     *     tags={"Albums"},
     *     summary="Снять лайк/дизлайк с альбома",
     *     security={{ "apiAuth": {} }},
     *     @OA\Parameter(
     *          name="albumId",
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
    public function unlike(Album $album)
    {
        auth('api')->user()->unlike($album);
        return response()->json(['message' => 'Success']);
    }

    /**
     * @OA\Post (
     *     path="/albums/dislike/{albumId}",
     *     operationId="albumsDislike",
     *     tags={"Albums"},
     *     summary="Дизлайк на альбом",
     *     security={{ "apiAuth": {} }},
     *     @OA\Parameter(
     *          name="albumId",
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
    public function dislike(Album $album)
    {
        auth()->user()->dislike($album);
        return response()->json(['message' => 'Success']);
    }
}
