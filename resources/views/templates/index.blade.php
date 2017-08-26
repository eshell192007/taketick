@extends('page')
@section('header')
  <header class="page-header text-center">
    <h1>{{ env('APP_NAME') }}</h1>
  </header>
@endsection
@section('main')
  <div class="container-fluid">
    <div class="row col-md-4 offset-md-4">
      <form action="/user/login" method="post" class="card form-ajax d-block w-full">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="card-header"><?php echo _('Log in') ?></div>
        <div class="card-block">
          <div class="alert alert-danger" style="display: none;">
            <span class="text"></span>
          </div>
          <div class="form-group">
            <label for="username" class="label"><?php echo _('Username or email') ?></label>
            <input type="text" name="username" id="username" class="form-control" placeholder="<?php echo _('Username or email') ?>">
          </div>
          <div class="form-group">
            <label for="password" class="label"><?php echo _('Password') ?></label>
            <input type="password" name="password" id="password" class="form-control" placeholder="<?php echo _('Password') ?>">
          </div>
          <div class="form-group text-center">
            <button class="btn btn-primary"><?php echo _('Login') ?></button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection