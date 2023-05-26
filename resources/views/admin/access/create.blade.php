@extends('admin.layouts.main')

@section('content')
    <div class="content-wrapper">
        @include('admin.templates.content_header', ['title' => 'Создание разрешения'])
        <section class="content">
            @include('admin.templates.alert', ['message' => ''])
            <form action="{{ route('admin.access.store') }}" method="POST" class="col-4" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Название</label>
                    <input type="text" id="name" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="slug">Слаг</label>
                    <input type="text" id="slug" name="slug" class="form-control">
                </div>
                <button class="btn btn-primary mt-4">Создать</button>
            </form>
        </section>
    </div>
@endsection
