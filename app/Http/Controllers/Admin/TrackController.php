<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Datatables\Request;
use App\Models\Track;
use App\Services\AudioInfo;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Track\StoreRequest;
use App\Http\Requests\Admin\Track\UpdateRequest;

class TrackController extends Controller
{

    public function index()
    {
        $title = 'Трэки';
        $columns = Track::getDataTablesColumns();
        return view('admin.datatables.index', compact('title', 'columns'));
    }

    public function getAll(Request $request)
    {
        $filterParams = $request->validated();
        return (new Track())->getRowsDatatable($filterParams);
    }

    public function create(): object
    {
        return view('admin.track.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $track = Track::create($data);
        return redirect()
            ->route('admin.track.edit', $track->id)
            ->withSuccess('Трэк успешно добавлен');
    }

    public function edit(Track $track)
    {
        return view('admin.track.edit', compact('track'));
    }

    public function update(UpdateRequest $request, Track $track)
    {
        $data = $request->validated();

        $track->syncArtists($data['artists'] ?? []);
        $track->syncCategories($data['categories'] ?? []);
        unset($data['artists'], $data['categories']);

        $track->update($data);

        return redirect()
            ->back()
            ->withSuccess('Трэк успешно обновлен');
    }

    public function delete(Track $track)
    {
        $track->delete();
        return redirect()
            ->back()
            ->withSuccess('Трэк успешно удален');
    }
}
