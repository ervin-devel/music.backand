<?php

namespace App\Http\Controllers\Admin;

use App\Models\Genre;
use App\Http\Requests\Admin\Datatables\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Genre\StoreRequest;
use App\Http\Requests\Admin\Genre\UpdateRequest;

class GenreController extends Controller
{

    public function index(Request $request)
    {
        $title = 'Жанры';
        $columns = (new Genre)->getDataTablesColumns();
        return view('admin.datatables.index', compact('title', 'columns'));
    }

    public function getAll(Request $request)
    {
        $filterParams = $request->validated();

        $data = (new Genre())->getRowsDatatable($filterParams);
        return $data;
    }

    public function create(): object
    {
        return view('admin.genre.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        Genre::create($data);
        return redirect()
            ->route('admin.genre.index')
            ->withSuccess('Жанр успешно добавлен');
    }

    public function edit(Genre $genre)
    {
        return view('admin.genre.edit', compact('genre'));
    }

    public function update(UpdateRequest $request, Genre $genre)
    {
        $data = $request->validated();
        $genre->update($data);
        return redirect()
            ->back()
            ->withSuccess('Жанр успешно обновлен');
    }

    public function delete(Genre $genre)
    {
        $genre->delete();
        return redirect()
            ->back()
            ->withSuccess('Жанр успешно удален');
    }
}
