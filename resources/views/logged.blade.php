@extends('page')
@section('header')
  <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
    <button class="navbar-toggler navbar-toggler-right"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="/">{{ env('APP_NAME') }}</a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <div class="btn-group">
        <a class="btn btn-outline-primary" href="/">
          <i class="fa fa-home" aria-hidden="true"></i>
          <?php echo _('Home') ?>
        </a>
        <a class="btn btn-outline-success" href="/ticket/add">
          <i class="fa fa-plus" aria-hidden="true"></i>
          <?php echo _('Add ticket') ?>
        </a>
        <a class="btn btn-outline-warning" href="/settings">
          <i class="fa fa-gear" aria-hidden="true"></i>
          <?php echo _('Settings') ?>
        </a>
        <a class="btn btn-outline-danger" href="/user/logout">
          <i class="fa fa-power-off" aria-hidden="true"></i>
          <?php echo _('Logout') ?>
        </a>
      </div>
    </div>
  </nav>
@endsection