<?php

namespace App\Http\Controllers\Admin;

use App\Models\Genre;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Genre\StoreRequest;
use App\Http\Requests\Admin\Genre\UpdateRequest;

class GenreController extends Controller
{

    public function index(Request $request)
    {
        $genres = Genre::get();
        return view('admin.genre.index', compact('genres'));
    }

    public function create(): object
    {
        return view('admin.genre.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        Genre::create($data);
        return redirect()->route('admin.genre.index');
    }

    public function edit(Genre $genre)
    {
        return view('admin.genre.edit', compact('genre'));
    }

    public function update(UpdateRequest $request, Genre $genre)
    {
        $data = $request->validated();
        $genre->update($data);
        return redirect()->back();
    }

    public function delete(Genre $genre)
    {
        $genre->delete();
        return redirect()->back();
    }
}
