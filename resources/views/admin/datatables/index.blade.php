@extends('admin.layouts.main')
@section('content')
    <div class="content-wrapper">
        @include('admin.templates.content_header', ['title' => $title])
        <section class="content">
            @include('admin.templates.alert')
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="display" id="record_table" style="width: 100%">
                            <thead>
                                <tr>
                                    @foreach(array_values($columns) AS $column)
                                        <th>{{ $column }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection
