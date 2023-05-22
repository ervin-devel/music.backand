<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Role\StoreRequest;
use App\Http\Requests\Admin\Role\UpdateRequest;
use App\Models\Access;
use App\Models\Role;
use Illuminate\Support\Str;

class RoleController
{
    public function index()
    {
        $roles = Role::get();
        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.role.create');
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

    }

    public function edit(Role $role)
    {
        return view('admin.role.edit', compact('role'));
    }

    public function update(UpdateRequest $request, Role $role)
    {
        $data = $request->validated();

        $role->syncAccess($data['accesses'] ?? []);
        unset($data['accesses']);
        $role->update($data);
    }

    public function destroy(Role $role)
    {
        $role->delete();
    }
}
