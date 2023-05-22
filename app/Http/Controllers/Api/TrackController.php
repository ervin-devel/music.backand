<?php

namespace App\Http\Controllers\Api;

use App\Models\Track;
use OpenApi\Annotations as OA;

class TrackController extends BaseController
{
    /**
     * @OA\Get(
     *     path="/tracks/{column}/{sort}",
     *     operationId="tracksAll",
     *     tags={"Tracks"},
     *     summary="Получить все треки",
     *     @OA\Parameter(
     *          name="column",
     *          in="path",
     *          required=false,
     *          description="id, duration, created_at, updated_at",
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
        return Track::with('artists')
            ->orderBy($column, $sort)
            ->paginate(config('main.pagination'));
    }

    /**
     * @OA\Get(
     *     path="/tracks/{trackId}",
     *     operationId="tracksOne",
     *     tags={"Tracks"},
     *     summary="Получить информацию по треку",
     *     @OA\Parameter(
     *          name="trackId",
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
    public function show(int $trackId): object
    {
        try {

            $data = Track::with('artists')->findOrFail($trackId);
            return response($data, 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return response([
                'status' => 'error',
                'error' => 'Track not found'
            ], 404);

        }
    }

    /**
     * @OA\Get(
     *     path="/tracks/related/{trackId}/{limit}",
     *     operationId="tracksRelated",
     *     tags={"Tracks"},
     *     summary="Получить похожие трэки",
     *     @OA\Parameter(
     *          name="trackId",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="limit",
     *          in="path",
     *          required=false,
     *          description="Сколько трэков получить",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Все хорошо. Трек найден"
     *     ),
     *     @OA\Response(
     *          response="404",
     *          description="Запрашиваемый трек не найден"
     *     )
     * )
     */
    public function getRelated(int $trackId, $limit = 3)
    {
        try {

            $track = Track::findOrFail($trackId);
            $data = $track->related()->limit($limit)->get();
            return response($data, 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return response([
                'status' => 'error',
                'error' => 'Track not found'
            ], 404);

        }
    }

    /**
     * @OA\Get(
     *     path="/tracks/chart/{limit}",
     *     operationId="tracksChart",
     *     tags={"Tracks"},
     *     summary="Чарт",
     *     @OA\Parameter(
     *          name="limit",
     *          in="path",
     *          required=false,
     *          @OA\Schema(
     *              type="integer"
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
    public function getChart($limit = 0)
    {
        $data = Track::with('artists')
            ->orderBy('id', 'desc');

        if ($limit) {
            return $data->limit($limit)->get();
        }

        return $data->paginate(config('main.pagination'));
    }
}
