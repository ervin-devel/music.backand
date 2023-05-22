@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    @include('admin.templates.content_header', ['title' => 'Добавление трека'])

    <section class="content">
        <form action="{{ route('admin.track.store') }}" method="POST" class="col-4" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="file">Файл</label>
                <input type="file" id="file" name="file">
            </div>
            <button class="btn btn-primary mt-4">Добавить</button>
        </form>
    </section>
  </div>
@endsection
