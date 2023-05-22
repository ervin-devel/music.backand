@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    @include('admin.templates.content_header', ['title' => 'Добавление альбома'])

    <section class="content">
        <form action="{{ route('admin.album.store') }}" method="POST" class="col-4" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Название</label>
                <input type="text" id="title" name="title" class="form-control">
            </div>
            <div class="form-group">
                <label for="slug">Слаг</label>
                <input type="text" id="slug" name="slug" class="form-control">
            </div>
            <div class="form-group">
                <label for="cover">Изображение</label>
                <input type="file" id="cover" name="cover">
            </div>
            <div class="form-group">
                <label for="content">Описание</label>
                <textarea name="content" id="content" rows="7" class="form-control"></textarea>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="is_published" name="is_published">
                <label class="form-check-label" for="is_published">Опубликовать</label>
            </div>
            <button class="btn btn-primary mt-4">Добавить</button>
        </form>
    </section>
  </div>
@endsection
