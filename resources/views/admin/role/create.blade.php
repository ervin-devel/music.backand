@extends('admin.layouts.main')

@section('content')
    <div class="content-wrapper">
        @include('admin.templates.content_header', ['title' => 'Добавление роли'])
        <section class="content">
            <form action="{{ route('admin.role.store') }}" method="POST" class="col-4" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Название</label>
                    <input type="text" id="name" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label>Разрешения</label>
                    <select name="access[]" class="form-control select2 select2-danger select2-role-access" multiple data-dropdown-css-class="select2-danger" style="width: 100%;">
                    </select>
                </div>
                <div>
                    <b>Доступные разрешения:</b><br/>
                    {!! $accesses !!}
                </div>
                <button class="btn btn-primary mt-4">Добавить</button>
            </form>
        </section>
    </div>
@endsection
