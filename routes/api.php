<?php

use App\Http\Controllers\Api\ArtistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\AlbumController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\TrackController;
use \App\Http\Controllers\Api\SearchController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    $router->post('login', [AuthController::class, 'login']);
    $router->post('register', [AuthController::class, 'register']);
    $router->post('logout', [AuthController::class, 'logout']);
    $router->post('refresh', [AuthController::class, 'refresh']);
    $router->post('me', [AuthController::class, 'me']);
});

Route::group(['prefix' => 'albums'], function ($router) {

    $router->get('/{column?}/{sort?}', [AlbumController::class, 'index'])
        ->whereIn('column', ['id', 'created_at', 'updated_at', 'likes'])
        ->whereIn('sort', ['asc', 'desc']);

    $router->get('/{albumId}', [AlbumController::class, 'show']);

    $router->post('/like/{album}', [AlbumController::class, 'like'])->middleware('auth:api');
    $router->post('/dislike/{album}', [AlbumController::class, 'dislike'])->middleware('auth:api');
    $router->post('/unlike/{album}', [AlbumController::class, 'unlike'])->middleware('auth:api');

});

Route::group(['prefix' => 'tracks'], function ($router) {

    $router->get('/{column?}/{sort?}', [TrackController::class, 'index'])
        ->whereIn('column', ['id', 'duration', 'created_at', 'updated_at'])
        ->whereIn('sort', ['asc', 'desc']);

    $router->get('/chart/{limit?}', [TrackController::class, 'getChart']);
    $router->get('/{trackId}', [TrackController::class, 'show']);
    $router->get('/related/{track}/{limit?}', [TrackController::class, 'getRelated']);
});

Route::group(['prefix' => 'genres'], function ($router) {
    $router->get('/', [GenreController::class, 'index']);
    $router->get('/{genre}', [GenreController::class, 'show']);
    $router->get('/{genre}/tracks', [GenreController::class, 'tracks']);
});

Route::group(['prefix' => 'artists'], function ($router) {

    $router->get('/{column?}/{sort?}', [ArtistController::class, 'index'])
        ->whereIn('column', ['id', 'name', 'created_at', 'updated_at', 'likes'])
        ->whereIn('sort', ['asc', 'desc']);

    $router->get('/top/{limit?}', [ArtistController::class, 'top']);
    $router->get('/{artist}', [ArtistController::class, 'show']);
    $router->get('/{artist}/tracks', [ArtistController::class, 'tracks']);

    $router->post('/like/{artist}', [ArtistController::class, 'like'])->middleware('auth:api');
    $router->post('/dislike/{artist}', [ArtistController::class, 'dislike'])->middleware('auth:api');
    $router->post('/unlike/{artist}', [ArtistController::class, 'unlike'])->middleware('auth:api');
});

Route::group(['prefix' => 'search'], function ($router) {
    $router->get('/', [SearchController::class, 'index']);
});

/*Route::group(['middleware' => 'jwt.auth'], function() {
    Route::apiResources([
        'albums' => AlbumController::class
    ]);
});*/
