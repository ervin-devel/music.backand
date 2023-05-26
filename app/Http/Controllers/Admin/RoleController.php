<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Datatables\Request;
use App\Http\Requests\Admin\Role\StoreRequest;
use App\Http\Requests\Admin\Role\UpdateRequest;
use App\Models\Access;
use App\Models\Role;
use Illuminate\Support\Str;

class RoleController
{
    public function index()
    {
        $title = 'Роли';
        $columns = (new Role())->getDataTablesColumns();
        return view('admin.datatables.index', compact('title', 'columns'));
    }

    public function getAll(Request $request)
    {
        $filterParams = $request->validated();

        $data = (new Role())->getRowsDatatable($filterParams);
        return $data;
    }

    public function create()
    {
        $accesses = (new Access())->getAccessToString('<br/>');
        return view('admin.role.create', compact('accesses'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $slug = Str::slug($data['name']);
        $role = Role::create([
            'slug' => $slug,
            'name' => $data['name']
        ]);

        $role->accessSync($data['access'] ?? []);

        return redirect()
            ->route('admin.role.index')
            ->withSuccess('Роль успешно добавлена');
    }

    public function edit(Role $role)
    {
        $accesses = (new Access())->getAccessToString('<br/>');
        return view('admin.role.edit', compact('role', 'accesses'));
    }

    public function update(UpdateRequest $request, Role $role)
    {
        $data = $request->validated();

        $role->syncAccess($data['accesses'] ?? []);
        unset($data['accesses']);
        $role->update($data);

        return redirect()
            ->route('admin.role.edit', $role->id)
            ->withSuccess('Роль успешно обновлена');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()
            ->route('admin.role.index')
            ->withSuccess('Роль успешно удалена');
    }
}
