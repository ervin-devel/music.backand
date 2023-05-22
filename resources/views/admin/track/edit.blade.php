@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    @include('admin.templates.content_header', ['title' => 'Редактирование трека'])

    <section class="content">
        @include('admin.templates.alert', ['message' => ''])
        <form action="{{ route('admin.track.update', $track->id) }}" method="POST" class="col-4" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="artist">Исполнитель</label>
                <input type="text" id="artist" name="artist" class="form-control" value="{{ $track->artist }}">
            </div>
            <div class="form-group">
                <label for="name">Название</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $track->name }}">
            </div>
            <div class="form-group">
                <label for="name">Слова к песне</label>
                <textarea id="lyurics" name="lyurics" class="form-control" rows="7">{{ $track->lyurics }}</textarea>
            </div>
            <h5 class="mt-5">ID3v1</h5>
            <div class="form-group">
                <label for="id3v1_year">Год</label>
                <input type="text" id="id3v1_year" name="id3v1_year" class="form-control" value="{{ $track->id3v1_year }}">
            </div>
            <div class="form-group">
                <label for="id3v1_album">Альбом</label>
                <input type="text" id="id3v1_album" name="id3v1_album" class="form-control" value="{{ $track->id3v1_album }}">
            </div>
            <div class="form-group">
                <label>Артисты</label>
                <select name="artists[]" class="form-control select2 select2-danger select2-artists" multiple data-dropdown-css-class="select2-danger" style="width: 100%;">
                    @foreach($track->artists AS $artist)
                        <option value="{{ $artist }}" selected>{{ $artist->name }}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-primary mt-4">Сохранить</button>
        </form>
    </section>
  </div>
@endsection
