<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Search\SearchRequest;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Artist;
use App\Models\Access;
use App\Models\Track;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function genre(SearchRequest $request)
    {
        return $this->queryBuilder($request, Genre::class, ['id', 'name'], ['name']);
    }

    public function artist(SearchRequest $request)
    {
        return $this->queryBuilder($request, Artist::class, ['id', 'name'], ['name']);
    }

    public function track(SearchRequest $request)
    {
        return $this->queryBuilder($request, Track::class, ['id', 'artist', 'name'], ['name', 'artist']);
    }

    public function accessRole(SearchRequest $request)
    {
        return $this->queryBuilder($request, Access::class, [], ['name']);
    }

    public function category(SearchRequest $request)
    {
        return $this->queryBuilder($request, Category::class, ['id', 'title'], ['title']);
    }

    private function queryBuilder(
        $request,
        $model,
        array $select = [],
        array $searchColumns = []
    )
    {
        $query = new $model;

        $data = $request->validated();
        $term = $data['option']['term'];

        if (count($select)) {
            $query->select($select);
        }

        if (count($searchColumns) === 1) {
            $query->where($searchColumns[0], 'LIKE', '%'.$term.'%');
        }
        else {
            foreach ($searchColumns AS $column) {
                $query->whereOr($column, 'LIKE', '%'.$term.'%');
            }
        }

        return $query->get();
    }
}
