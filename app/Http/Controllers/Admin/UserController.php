<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Datatables\Request;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index()
    {
        $columns = (new User)->getDataTablesColumns();
        return view('admin.user.index', compact('columns'));
    }

    public function getAll(Request $request)
    {
        $filterParams = $request->validated();

        $data = (new User())->getRowsDatatable($filterParams);
        return $data;
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        User::create($data);
        return redirect()
            ->route('admin.user.index')
            ->withSuccess('Пользователь добавлен');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function update(UpdateRequest $request, User $user)
    {
        $data = $request->validated();
        $result = $user->update($data);

        return redirect()
            ->back()
            ->withSuccess('Аккаунт успешно обновлен');
    }

    public function userActivate(User $user)
    {
        if ($user->email_verified_at) {
            return redirect()
                ->route('admin.album.index')
                ->withErrors('Аккаунт уже был активирован');
        }

        $user->email_verified_at = Carbon::now()->toDateTimeString();
        $user->save();

        return redirect()
            ->back()
            ->withSuccess('Аккаунт успешно активирован');
    }

    public function delete(User $user)
    {
        $user->delete();
        return redirect()
            ->route('admin.user.index')
            ->withSuccess('Аккаунт успешно удален');
    }
}
