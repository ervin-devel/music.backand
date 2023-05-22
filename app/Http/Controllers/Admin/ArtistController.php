<?php

namespace App\Http\Controllers\Admin;

use App\Models\Artist;
use App\Traits\HasFollower;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Artist\StoreRequest;
use App\Http\Requests\Admin\Artist\UpdateRequest;

class ArtistController extends Controller
{
    use HasFollower;
    
    public function index()
    {
        $artists = Artist::get();
        return view('admin.artist.index', compact('artists'));
    }

    public function create()
    {
        return view('admin.artist.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        Artist::create($data);
        return redirect()->route('admin.artist.index');
    }

    public function edit(Artist $artist)
    {
        /*dd(auth()->user()->follow($artist));
        auth()->user()->follow($artist);*/
        return view('admin.artist.edit', compact('artist'));
    }

    public function update(UpdateRequest $request, Artist $artist)
    {
        $data = $request->validated();
        $artist->update($data);
        return redirect()->back();
    }

    public function delete(Artist $artist)
    {
        $artist->delete();
        return redirect()->back(); 
    }
}
