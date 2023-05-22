<?php
namespace App\Http\Controllers\Admin;

use App\Models\Album;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Datatables\Request;
use App\Http\Requests\Admin\Album\{ StoreRequest, UpdateRequest};

class AlbumController extends Controller
{

    public function index(): object
    {
        $columns = Album::getDataTablesColumns();
        return view('admin.album.index', compact('columns'));
    }

    public function getAll(Request $request)
    {
        $filterParams = $request->validated();

        $data = (new Album())->getRowsDatatable($filterParams);
        return $data;
    }

    public function create(): object
    {
        return view('admin.album.create');
    }

    public function store(StoreRequest $request): object
    {
        $data = $request->validated();
        Album::create($data);

        return redirect()
            ->route('admin.album.index')
            ->withSuccess('Альбом успешно создан');
    }

    public function edit(Album $album): object
    {
        return view('admin.album.edit', compact('album'));
    }

    public function update(UpdateRequest $request, Album $album)
    {
        $data = $request->validated();

        $album->syncGenres($data['genres'] ?? []);
        $album->syncArtists($data['artists'] ?? []);
        $album->tracks()->sync($data['tracks'] ?? []);

        unset($data['genres'], $data['artists'], $data['tracks']);

        $album->update($data);

        return back()->withSuccess('Альбом успешно обновлен');
    }

    public function delete(Album $album)
    {
        $album->delete();
        return redirect()
            ->route('admin.album.index')
            ->with('Альбом удален');
    }

}
