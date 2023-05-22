@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    @include('admin.templates.content_header', ['title' => 'Добавление жанра'])

    <section class="content">
        <form action="{{ route('admin.genre.store') }}" method="POST" class="col-4" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Название</label>
                <input type="text" id="name" name="name" class="form-control">
            </div>
            <button class="btn btn-primary mt-4">Добавить</button>
        </form>
    </section>
  </div>
@endsection
