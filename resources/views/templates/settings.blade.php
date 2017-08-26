@extends('logged')
@section('assets-css')
  <link rel="stylesheet" href="/lib/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
@endsection
@section('assets-js')
  <script src="/lib/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
@endsection
@section('main')
  <form action="/settings/update" method="post" class="container-fluid">
    <div class="input-group colorpicker-component">
      <input type="text" name="" id="" value="#ffffff" class="form-control">
      <span class="input-group-addon"><i></i></span>
    </div>
  </form>
@endsection
