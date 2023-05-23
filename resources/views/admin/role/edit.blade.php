@extends('admin.layouts.main')

@section('content')
    <div class="content-wrapper">
        @include('admin.templates.content_header', ['title' => 'Редактирование роли'])
        <section class="content">
            @include('admin.templates.alert', ['message' => ''])
            <form action="{{ route('admin.role.update', $role->id) }}" method="POST" class="col-4" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Название</label>
                    <input type="text" id="name" name="name" value="{{ $role->name  }}" class="form-control">
                </div>
                <div class="form-group">
                    <label>Разрешения</label>
                    <select name="accesses[]" class="form-control select2 select2-danger select2-role-access" multiple data-dropdown-css-class="select2-danger" style="width: 100%;">
                        @foreach($role->accesses AS $item)
                            <option value="{{ $item }}" selected>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <b>Доступные разрешения:</b><br/>
                    {!! $accesses !!}
                </div>
                <button class="btn btn-primary mt-4">Сохранить</button>
            </form>
        </section>
    </div>
@endsection
