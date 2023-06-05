@php
    $getCurrentRouteName = Route::current()->getName();
    $DatatablesActiveOnPages = config('admin_layout.DatatablesActiveOnPages');
    $isActiveDatatable = in_array($getCurrentRouteName, $DatatablesActiveOnPages);
@endphp
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Админка</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    @if($isActiveDatatable)
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" />
    @endif
    @php
        $cssPlugins = config('admin_layout.cssPlugins');
    @endphp
  @foreach ($cssPlugins as $pluginUrl)
  <link rel="stylesheet" href="{{ asset('plugins/' . $pluginUrl) }}">
  @endforeach
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    @include('admin.templates.navbar')
    @include('admin.templates.sidebar')
  @yield('content')
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>
  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>
  @php
  $jsPlugins = config('admin_layout.jsPlugins')
 @endphp
@foreach ($jsPlugins as $pluginUrl)
<script src="{{ asset('plugins/' . $pluginUrl) }}"></script>
@endforeach
@if($isActiveDatatable)
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('admin/js/datatables/main.js') }}"></script>
    <script>
        const DATATABLE_iDisplayLength = {{ config('main.pagination') }};
    </script>
    @php
        $section = explode('.', $getCurrentRouteName)[1];
    @endphp
    <script>
        const DATATABLE_FETCH_URL = '{{ route('admin.'.$section.'.get_all') }}';
    </script>
    <script src="{{ asset('admin/js/datatables/'.$section.'.js') }}"></script>
@endif
<script>
    const BASE_DOMAIN = '{{ env('APP_URL') }}';
    const GENRES_URL = '{{ route('admin.search.genre') }}';
    const ARTISTS_URL = '{{ route('admin.search.artist') }}';
    const TRACKS_URL = '{{ route('admin.search.track') }}';
    const CATEGORIES_URL = '{{ route('admin.search.category') }}';
    const ROLE_ACCESS_URL = '{{ route('admin.search.access_role') }}';
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.4/axios.min.js"></script>
<script src="{{ asset('admin/js/main.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
</body>
</html>
