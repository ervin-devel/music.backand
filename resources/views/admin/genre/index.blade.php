@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    @include('admin.templates.content_header', ['title' => 'Жанры'])
    <section class="content">
        @include('admin.templates.alert')
        @include('admin.templates.datatable', ['columns' => $columns])
    </section>
  </div>
@endsection
