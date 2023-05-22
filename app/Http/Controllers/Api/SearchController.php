<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SearchRequest;
use App\Models\Track;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(SearchRequest $request)
    {
        $data = $request->validated();
        return Track::with('artists')
            ->where('name', 'LIKE', '%' . $data['term'] .'%')
            ->orWhere('artist', 'LIKE', '%' . $data['term'] .'%')
            ->get();
    }
}
