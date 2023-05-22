<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Search\RoleAccessRequest;
use App\Http\Requests\Admin\Search\TrackRequest;
use App\Models\Genre;
use App\Models\Artist;
use App\Models\Access;
use App\Models\Track;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Search\GenreRequest;
use App\Http\Requests\Admin\Search\ArtistRequest;

class SearchController extends Controller
{
    public function genre(GenreRequest $request)
    {

        $data = $request->validated();
        $term = $data['option']['term'];

        $genres = Genre::select('id', 'name')->where('name', 'LIKE', '%'.$term.'%')->get();
        return $genres;
    }

    public function artist(ArtistRequest $request)
    {

        $data = $request->validated();
        $term = $data['option']['term'];

        $genres = Artist::select('id', 'name')->where('name', 'LIKE', '%'.$term.'%')->get();
        return $genres;
    }

    public function track(TrackRequest $request)
    {

        $data = $request->validated();
        $term = $data['option']['term'];

        $tracks = Track::select('id', 'artist', 'name')->whereOr([
            ['name', 'LIKE', '%'.$term.'%'],
            ['artist', 'LIKE', '%'.$term.'%'],
        ])->get();
        return $tracks;
    }

    public function accessRole(RoleAccessRequest $request)
    {
        $data = $request->validated();
        $term = $data['option']['term'];

        return Access::where('name', 'LIKE', '%'.$term.'%')->get();
    }
}
