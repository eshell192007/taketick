<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ env('APP_NAME') }}</title>
  <link rel="stylesheet" href="/lib/tether/dist/css/tether.min.css">
  <link rel="stylesheet" href="/lib/bootstrap/dist/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="/lib/bootstrap/dist/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="/lib/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/lib/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/lib/components-font-awesome/css/font-awesome.min.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @section('assets-css')
  @show
  <link rel="stylesheet" href="/css/app.css">
</head>
<body>
@section('header')
  <header>
    @include('miniatures.header')
  </header>
@show
<p></p>
<main>
  @section('main')
  @show
</main>
@section('footer')
  <footer>
    @include('miniatures.footer')
  </footer>
@show
<script src="/lib/jquery/dist/jquery.min.js"></script>
<script src="/lib/tether/dist/js/tether.min.js"></script>
<script src="/lib/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/lib/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/lib/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
@section('assets-js')
@show
@include('misc.js-utils')
<script src="/js/app.js"></script>
</body>
</html>