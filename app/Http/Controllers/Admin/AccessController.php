<?php
namespace App\Http\Controllers\Admin;

use App\Models\Access;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Datatables\Request;
use App\Http\Requests\Admin\Access\{ StoreRequest, UpdateRequest};

class AccessController extends Controller
{

    public function index(): object
    {
        $title = 'Разрешения';
        $columns = (new Access())->getDataTablesColumns();
        return view('admin.datatables.index', compact('title', 'columns'));
    }

    public function getAll(Request $request): array
    {
        $filterParams = $request->validated();
        $data = (new Access())->getRowsDatatable($filterParams);
        return $data;
    }

    public function create(): object
    {
        return view('admin.access.create');
    }

    public function store(StoreRequest $request): object
    {
        $data = $request->validated();
        Access::create($data);

        return redirect()
            ->route('admin.access.index')
            ->withSuccess('Разрешение успешно добавлено');
    }

    public function edit(Access $access): object
    {
        return view('admin.access.edit', compact('access'));
    }

    public function update(UpdateRequest $request, Access $access): object
    {
        $data = $request->validated();
        $access->update($data);
        return back()->withSuccess('Разрешение успешно обновлен');
    }

    public function delete(Access $access): object
    {
        $access->delete();
        return redirect()
            ->route('admin.access.index')
            ->with('Разрешение удалено');
    }

}
