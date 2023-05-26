<?php

namespace App\Http\Controllers\Admin;

use App\Models\Artist;
use App\Traits\HasFollower;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Artist\StoreRequest;
use App\Http\Requests\Admin\Artist\UpdateRequest;
use App\Http\Requests\Admin\Datatables\Request;

class ArtistController extends Controller
{
    use HasFollower;

    public function index()
    {
        $title = 'Артисты';
        $columns = (new Artist())->getDataTablesColumns();
        return view('admin.datatables.index', compact('title', 'columns'));
    }

    public function getAll(Request $request)
    {
        $filterParams = $request->validated();

        $data = (new Artist())->getRowsDatatable($filterParams);
        return $data;
    }

    public function create()
    {
        return view('admin.artist.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        Artist::create($data);
        return redirect()
            ->route('admin.artist.index')
            ->withSuccess('Артист успешно добавлен');
    }

    public function edit(Artist $artist)
    {
        return view('admin.artist.edit', compact('artist'));
    }

    public function update(UpdateRequest $request, Artist $artist)
    {
        $data = $request->validated();
        $artist->update($data);
        return redirect()
            ->back()
            ->withSuccess('Информация об артисте успешно обновлена');
    }

    public function delete(Artist $artist)
    {
        $artist->delete();
        return redirect()
            ->back()
            ->withSuccess('Информация об артисте успешно удалена');
    }
}
