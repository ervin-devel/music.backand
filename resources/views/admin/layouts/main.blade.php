
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Админка</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    @if(in_array(Route::current()->getName(), ['admin.album.index', 'admin.track.index', 'admin.genre.index']))
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" />
    @endif
  <?php
  $plugins = [
    'select2/css/select2.min.css',
    'tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
    'icheck-bootstrap/icheck-bootstrap.min.css',
    'jqvmap/jqvmap.min.css',
    'overlayScrollbars/css/OverlayScrollbars.min.css',
    'daterangepicker/daterangepicker.css',
    'summernote/summernote-bs4.min.css'
  ];
  ?>
  @foreach ($plugins as $pluginUrl)
  <link rel="stylesheet" href="{{ asset('plugins/' . $pluginUrl) }}">
  @endforeach
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

  @include('admin.templates.navbar')
@include('admin.templates.sidebar')


  <!-- Content Wrapper. Contains page content -->
  @yield('content')
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<?php
$plugins = [
  'jquery/jquery.min.js',
  'jquery-ui/jquery-ui.min.js',
  'bootstrap/js/bootstrap.bundle.min.js',
  'chart.js/Chart.min.js',
  'sparklines/sparkline.js',
  'jqvmap/jquery.vmap.min.js',
  'jqvmap/maps/jquery.vmap.usa.js',
  'jquery-knob/jquery.knob.min.js',
  'moment/moment.min.js',
  'daterangepicker/daterangepicker.js',
  'tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
  'summernote/summernote-bs4.min.js',
  'overlayScrollbars/js/jquery.overlayScrollbars.min.js',
  'select2/js/select2.full.min.js'
];
?>
@foreach ($plugins as $pluginUrl)
<script src="{{ asset('plugins/' . $pluginUrl) }}"></script>
@endforeach
@if(in_array(Route::current()->getName(), ['admin.album.index', 'admin.track.index', 'admin.genre.index']))
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('admin/js/datatables/main.js') }}"></script>
    <script>
        const DATATABLE_iDisplayLength = {{ config('main.pagination') }};
    </script>
@endif
  @if(Route::current()->getName() === 'admin.genre.index')
      <script>
          const DATATABLE_FETCH_URL = '{{ route('admin.genre.get_all') }}';
      </script>
      <script src="{{ asset('admin/js/datatables/genres.js') }}"></script>
  @endif
@if(Route::current()->getName() === 'admin.album.index')
    <script>
        const DATATABLE_FETCH_URL = '{{ route('admin.album.get_all') }}';
    </script>
    <script src="{{ asset('admin/js/datatables/albums.js') }}"></script>
@endif
  @if(Route::current()->getName() === 'admin.track.index')
      <script>
          const DATATABLE_FETCH_URL = '{{ route('admin.track.get_all') }}';
      </script>
      <script src="{{ asset('admin/js/datatables/tracks.js') }}"></script>
  @endif
<script>
    const BASE_DOMAIN = '{{ env('APP_URL') }}';
    const GENRES_URL = '{{ route('admin.search.genre') }}';
    const ARTISTS_URL = '{{ route('admin.search.artist') }}';
    const TRACKS_URL = '{{ route('admin.search.track') }}';
    const ROLE_ACCESS_URL = '{{ route('admin.search.access_role') }}';
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.4/axios.min.js"></script>

<!-- AdminLTE App -->
<script src="{{ asset('admin/js/main.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
</body>
</html>
