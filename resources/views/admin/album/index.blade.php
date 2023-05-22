@extends('admin.layouts.main')

@section('content')
<div class="content-wrapper">
    @include('admin.templates.content_header', ['title' => 'Альбомы'])

    <section class="content">
        @include('admin.templates.alert')
        @include('admin.templates.datatable', ['columns' => $columns])
    </section>
</div>
<script>
    const PUBLISHED_TEXT = [
        '{{ \App\Models\Album::PUBLISHED_TEXT }}',
        '{{ \App\Models\Album::NOT_PUBLISHED_TEXT }}',
    ]
</script>
@endsection
