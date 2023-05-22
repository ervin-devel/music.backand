@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    @include('admin.templates.content_header', ['title' => 'Редактирование артиста'])

    <section class="content">
        <form action="{{ route('admin.artist.update', $artist->id) }}" method="POST" class="col-4" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Имя</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $artist->name }}">
            </div>
            <div class="form-group">
                <label for="slug">Слаг</label>
                <input type="text" id="slug" name="slug" class="form-control" value="{{ $artist->slug }}">
            </div>
            <div class="form-group">
                <label for="photo">Фото</label>
                <input type="file" id="photo" name="photo">
            </div>
            <div class="form-group">
                <label for="content">Описание</label>
                <textarea name="content" id="content" rows="7" class="form-control">{{ $artist->content }}</textarea>
            </div>
            <button class="btn btn-primary mt-4">Сохранить</button>
        </form>
    </section>
  </div>
@endsection
