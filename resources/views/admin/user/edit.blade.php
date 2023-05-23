@extends('admin.layouts.main')

@section('content')
    <div class="content-wrapper">
        @include('admin.templates.content_header', ['title' => 'Редактирование пользователя'])
        <section class="content">
            @include('admin.templates.alert')
            <form action="{{ route('admin.user.update', $user->id) }}" method="POST" class="col-4" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Имя на сайте</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}">
                </div>
                <div class="form-group">
                    <label for="role_id">Роль</label>
                    <select class="form-control" name="role_id" id="role_id">
                        @foreach($roles AS $role)
                            <option value="{{ $role->id }}" {{ ($role->id === $user->role->id ? 'selected' : null) }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <hr>
                <div class="form-group">
                    <label for="password">Новый пароль</label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Повторите пароль</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                </div>
                <button class="btn btn-primary mt-4">Сохранить</button>
            </form>
        </section>
    </div>
@endsection
