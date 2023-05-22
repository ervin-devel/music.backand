@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    @include('admin.templates.content_header', ['title' => 'Добавление артиста'])

    <section class="content">
        <form action="{{ route('admin.artist.store') }}" method="POST" class="col-4" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Имя</label>
                <input type="text" id="name" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="photo">Фото</label>
                <input type="file" id="photo" name="photo">
            </div>
            <div class="form-group">
                <label for="content">Описание</label>
                <textarea name="content" id="content" rows="7" class="form-control"></textarea>
            </div>
            <button class="btn btn-primary mt-4">Добавить</button>
        </form>
    </section>
  </div>
@endsection
