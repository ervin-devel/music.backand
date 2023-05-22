@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    @include('admin.templates.content_header', ['title' => 'Жанры'])

    <section class="content">
        <div class="card">
          <div class="card-header">
          <h3 class="card-title"><a href="{{ route('admin.genre.create') }}" class="btn btn-primary">Добавить</a></h3>
          <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
          <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
          <div class="input-group-append">
          <button type="submit" class="btn btn-default">
          <i class="fas fa-search"></i>
          </button>
          </div>
          </div>
          </div>
          </div>
          
          <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
          <thead>
          <tr>
          <th>ID</th>
          <th>Заголовок</th>
          <th>Date</th>
          <th>Status</th>
          <th>Reason</th>
          </tr>
          </thead>
          <tbody>
            @forelse ($genres as $genre)
              <tr>
              <td>{{ $genre->id }}</td>
              <td>{{ $genre->name }}</td>
              <td></td>
              <td></td>
              <td>
                <a href="{{ route('admin.genre.edit', $genre->id) }}" class="btn btn-primary">Редактировать</a>
                <form method="POST" action="{{ route('admin.genre.delete', $genre->id) }}">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger">Удалить</button>
                </form>
              </td>
              </tr>
            @empty
                
            @endforelse
          </tbody>
          </table>
          </div>
          
          </div>
    </section>
  </div>
@endsection
