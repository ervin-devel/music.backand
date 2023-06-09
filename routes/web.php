<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\TrackController;
use App\Http\Controllers\Admin\ArtistController;
use App\Http\Controllers\Admin\SearchController;
use App\Http\Controllers\User\CabinetController;
use App\Http\Controllers\Admin\{AccessController, MainController, AlbumController, RoleController, UserController};
use App\Http\Controllers\User\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});
Route::get('/admin', [MainController::class, 'index'])->name('admin.main.index');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {

    Route::group(['prefix' => 'albums'], function() {

        Route::get('/', [AlbumController::class, 'index'])
            ->name('admin.album.index')
            ->middleware('access:albums-index');

        Route::get('/getAll', [AlbumController::class, 'getAll'])
            ->name('admin.album.get_all')
            ->middleware('access:albums-index');

        Route::get('/create', [AlbumController::class, 'create'])
            ->name('admin.album.create')
            ->middleware('access:albums-create');

        Route::post('/', [AlbumController::class, 'store'])
            ->name('admin.album.store')
            ->middleware('access:albums-create');

        Route::get('/{album}', [AlbumController::class, 'edit'])
            ->name('admin.album.edit')
            ->middleware('access:albums-edit');

        Route::put('/{album}', [AlbumController::class, 'update'])
            ->name('admin.album.update')
            ->middleware('access:albums-edit');

        Route::delete('/{album}', [AlbumController::class, 'delete'])
            ->name('admin.album.delete')
            ->middleware('access:albums-delete');
    });

    Route::group(['prefix' => 'tracks'], function() {

        Route::get('/', [TrackController::class, 'index'])
            ->name('admin.track.index')
            ->middleware('access:tracks-index');

        Route::get('/getAll', [TrackController::class, 'getAll'])
            ->name('admin.track.get_all')
            ->middleware('access:tracks-index');

        Route::get('/create', [TrackController::class, 'create'])
            ->name('admin.track.create')
            ->middleware('access:tracks-create');

        Route::post('/', [TrackController::class, 'store'])
            ->name('admin.track.store')
            ->middleware('access:tracks-create');

        Route::get('/{track}', [TrackController::class, 'edit'])
            ->name('admin.track.edit')
            ->middleware('access:tracks-edit');

        Route::put('/{track}', [TrackController::class, 'update'])
            ->name('admin.track.update')
            ->middleware('access:tracks-edit');

        Route::delete('/{track}', [TrackController::class, 'delete'])
            ->name('admin.track.delete')
            ->middleware('access:tracks-delete');
    });

    Route::group(['prefix' => 'artists'], function() {

        Route::get('/', [ArtistController::class, 'index'])
            ->name('admin.artist.index')
            ->middleware('access:artists-index');

        Route::get('/getAll', [ArtistController::class, 'getAll'])
            ->name('admin.artist.get_all')
            ->middleware('access:artists-index');

        Route::get('/create', [ArtistController::class, 'create'])
            ->name('admin.artist.create')
            ->middleware('access:artists-create');

        Route::post('/', [ArtistController::class, 'store'])
            ->name('admin.artist.store')
            ->middleware('access:artists-create');

        Route::get('/{artist}', [ArtistController::class, 'edit'])
            ->name('admin.artist.edit')
            ->middleware('access:artists-edit');

        Route::put('/{artist}', [ArtistController::class, 'update'])
            ->name('admin.artist.update')
            ->middleware('access:artists-edit');

        Route::delete('/{artist}', [ArtistController::class, 'delete'])
            ->name('admin.artist.delete')
            ->middleware('access:artists-delete');

    });

    Route::group(['prefix' => 'genres'], function() {

        Route::get('/', [GenreController::class, 'index'])
            ->name('admin.genre.index')
            ->middleware('access:genres-index');

        Route::get('/getAll', [GenreController::class, 'getAll'])
            ->name('admin.genre.get_all')
            ->middleware('access:genres-index');

        Route::get('/create', [GenreController::class, 'create'])
            ->name('admin.genre.create')
            ->middleware('access:genres-create');

        Route::post('/', [GenreController::class, 'store'])
            ->name('admin.genre.store')
            ->middleware('access:genres-create');

        Route::get('/{genre}', [GenreController::class, 'edit'])
            ->name('admin.genre.edit')
            ->middleware('access:genres-edit');

        Route::put('/{genre}', [GenreController::class, 'update'])
            ->name('admin.genre.update')
            ->middleware('access:genres-edit');

        Route::delete('/{genre}', [GenreController::class, 'delete'])
            ->name('admin.genre.delete')
            ->middleware('access:genres-delete');

    });

    Route::group(['prefix' => 'accesses'], function () {
        Route::get('/', [AccessController::class, 'index'])
            ->name('admin.access.index')
            ->middleware('access:accesses-index');

        Route::get('/getAll', [AccessController::class, 'getAll'])
            ->name('admin.access.get_all')
            ->middleware('access:accesses-index');

        Route::get('/create', [AccessController::class, 'create'])
            ->name('admin.access.create')
            ->middleware('access:accesses-create');

        Route::post('/', [AccessController::class, 'store'])
            ->name('admin.access.store')
            ->middleware('access:accesses-create');

        Route::get('/edit/{access}', [AccessController::class, 'edit'])
            ->name('admin.access.edit')
            ->middleware('access:accesses-edit');

        Route::put('/{access}', [AccessController::class, 'update'])
            ->name('admin.access.update')
            ->middleware('access:accesses-edit');

        Route::delete('/{access}', [AccessController::class, 'delete'])
            ->name('admin.access.delete')
            ->middleware('access:accesses-delete');
    });

    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', [RoleController::class, 'index'])
            ->name('admin.role.index')
            ->middleware('access:roles-index');

        Route::get('/getAll', [RoleController::class, 'getAll'])
            ->name('admin.role.get_all')
            ->middleware('access:roles-index');

        Route::get('/create', [RoleController::class, 'create'])
            ->name('admin.role.create')
            ->middleware('access:roles-create');

        Route::post('/', [RoleController::class, 'store'])
            ->name('admin.role.store')
            ->middleware('access:roles-create');

        Route::get('/edit/{role}', [RoleController::class, 'edit'])
            ->name('admin.role.edit')
            ->middleware('access:roles-edit');

        Route::put('/{role}', [RoleController::class, 'update'])
            ->name('admin.role.update')
            ->middleware('access:roles-edit');

        Route::delete('/{role}', [RoleController::class, 'delete'])
            ->name('admin.role.delete')
            ->middleware('access:roles-delete');
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index'])
            ->name('admin.user.index')
            ->middleware('access:users-index');

        Route::get('/getAll', [UserController::class, 'getAll'])
            ->name('admin.user.get_all')
            ->middleware('access:users-index');

        Route::get('/create', [UserController::class, 'create'])
            ->name('admin.user.create')
            ->middleware('access:users-create');

        Route::post('/', [UserController::class, 'store'])
            ->name('admin.user.store')
            ->middleware('access:roles-create');

        Route::get('/edit/{user}', [UserController::class, 'edit'])
            ->name('admin.user.edit')
            ->middleware('access:users-edit');

        Route::put('/{user}', [UserController::class, 'update'])
            ->name('admin.user.update')
            ->middleware('access:users-edit');

        Route::delete('/{user}', [UserController::class, 'delete'])
            ->name('admin.user.delete')
            ->middleware('access:users-delete');

        Route::put('/user-activate/{user}', [UserController::class, 'userActivate'])
            ->name('admin.user.activate')
            ->middleware('access:users-edit');
    });

    Route::group(['prefix' => 'search'], function() {
        Route::post('/genre', [SearchController::class, 'genre'])->name('admin.search.genre');
        Route::post('/artist', [SearchController::class, 'artist'])->name('admin.search.artist');
        Route::post('/tracks', [SearchController::class, 'track'])->name('admin.search.track');
        Route::post('/access-role', [SearchController::class, 'accessRole'])->name('admin.search.access_role');
        Route::post('/categories', [SearchController::class, 'category'])->name('admin.search.category');
    });

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
