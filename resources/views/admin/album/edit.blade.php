@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    @include('admin.templates.content_header', ['title' => 'Редактирование альбома'])

    <section class="content">
        @include('admin.templates.alert', ['message' => ''])
        <form action="{{ route('admin.album.update', $album->id) }}" method="POST" class="col-4" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Название</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ $album->title }}">
            </div>
            <div class="form-group">
                <label for="slug">Слаг</label>
                <input type="text" id="slug" name="slug" class="form-control" value="{{ $album->slug }}">
            </div>
            <div class="form-group">
                <div class="mb-2"><img src="{{ $album->getCover() }}" alt="" width="150px"></div>
                <label for="cover">Изображение</label>
                <input type="file" id="cover" name="cover">
            </div>
            <div class="form-group">
                <label for="content">Описание</label>
                <textarea name="content" id="content" rows="7" class="form-control">{{ $album->content }}</textarea>
            </div>
            <div class="form-group">
                <label>Жанры</label>
                <select name="genres[]" class="form-control select2 select2-danger select2-genres" multiple data-dropdown-css-class="select2-danger" style="width: 100%;">
                    @foreach ($album->genres as $genre)
                        <option value="{{ json_encode($genre) }}" selected>{{ $genre->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Артисты</label>
                <select name="artists[]" class="form-control select2 select2-danger select2-artists" multiple data-dropdown-css-class="select2-danger" style="width: 100%;">
                    @foreach ($album->artists as $artist)
                        <option value="{{ json_encode($artist) }}" selected>{{ $artist->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Треки</label>
                <select name="tracks[]" class="form-control select2 select2-danger select2-tracks" multiple data-dropdown-css-class="select2-danger" style="width: 100%;">
                    @foreach ($album->tracks as $track)
                        <option value="{{ $track->id }}" selected>{{ $track->getFullName() }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="is_published" name="is_published"
                {{ ($album->is_published ? 'checked' : '') }}>
                <label class="form-check-label" for="is_published">Опубликовать</label>
            </div>
            <button class="btn btn-primary mt-4">Сохранить</button>
        </form>
    </section>
  </div>
@endsection
