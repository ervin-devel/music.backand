@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    @include('admin.templates.content_header', ['title' => 'Редактирование жанра'])

    <section class="content">
        @include('admin.templates.alert', ['message' => ''])
        <form action="{{ route('admin.genre.update', $genre->id) }}" method="POST" class="col-4" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Название</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $genre->name }}">
            </div>
            <div class="form-group">
                <label for="title">Слаг</label>
                <input type="text" id="slug" name="slug" class="form-control" value="{{ $genre->slug }}">
            </div>
            <button class="btn btn-primary mt-4">Сохранить</button>
        </form>
    </section>
  </div>
@endsection
