<?php
/** @var $statuses \TakeTick\Status[] */
?>
@extends('logged')
@section('assets-css')
  <link rel="stylesheet" href="/lib/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
@endsection
@section('assets-js')
  <script src="/lib/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
@endsection
@section('main')
  <form action="/settings/update" method="post" class="container-fluid">
    <div class="row">
      <div class="col-md-4">
        <ul class="list-group" id="records-status">
          <li class="list-group-item list-group-item-default">
              <?php echo _('Statuses') ?>
          </li>
            <?php foreach($statuses as $status): ?>
          <li class="list-group-item d-block record"
              data-id="<?php echo $status->id_status ?>"
              data-color="<?php echo $status->color ?>"
              data-type="status">
            <div class="btn-group float-right">
              <button type="button" class="btn btn-outline-primary btn-sm btn-record-edit">
                <span class="fa fa-pencil"></span>
              </button>
              <button type="button" class="btn btn-outline-danger btn-sm btn-record-remove">
                <span class="fa fa-trash"></span>
              </button>
            </div>
            <span class="badge badge-default badge-pill"
                  style="background-color: <?php echo $status->color ?>">&nbsp;</span>
            <span class="name"><?php echo $status->name ?></span>
          </li>
            <?php endforeach; ?>
          <li class="list-group-item list-group-item-default">
            <button class="btn btn-transparent btn-record-add" data-name="status" type="button">
              <i class="fa fa-plus" aria-hidden="true"></i>
                <?php echo _('Add item') ?>
            </button>
          </li>
        </ul>
      </div>
      <div class="col-md-4">
        <ul class="list-group" id="records-type">
          <li class="list-group-item list-group-item-default">
              <?php echo _('Types') ?>
          </li>
            <?php foreach($types as $type): ?>
          <li class="list-group-item d-block record"
              data-id="<?php echo $type->id_type ?>"
              data-color="<?php echo $type->color ?>"
              data-type="type">
            <div class="btn-group float-right">
              <button type="button" class="btn btn-outline-primary btn-sm btn-record-edit">
                <span class="fa fa-pencil"></span>
              </button>
              <button type="button" class="btn btn-outline-danger btn-sm btn-record-remove">
                <span class="fa fa-trash"></span>
              </button>
            </div>
            <span class="badge badge-default badge-pill"
                  style="background-color: <?php echo $type->color ?>">&nbsp;</span>
            <span class="name"><?php echo $type->name ?></span>
          </li>
            <?php endforeach; ?>
          <li class="list-group-item list-group-item-default">
            <button class="btn btn-transparent btn-record-add" data-name="type" type="button">
              <i class="fa fa-plus" aria-hidden="true"></i>
                <?php echo _('Add item') ?>
            </button>
          </li>
        </ul>
      </div>
      <div class="col-md-4">
        <ul class="list-group" id="records-priority">
          <li class="list-group-item list-group-item-default">
              <?php echo _('Priorities') ?>
          </li>
            <?php foreach($priorities as $priority): ?>
          <li class="list-group-item d-block record"
              data-id="<?php echo $priority->id_priority ?>"
              data-color="<?php echo $priority->color ?>"
              data-type="priority">
            <div class="btn-group float-right">
              <button type="button" class="btn btn-outline-primary btn-sm btn-record-edit">
                <span class="fa fa-pencil"></span>
              </button>
              <button type="button" class="btn btn-outline-danger btn-sm btn-record-remove">
                <span class="fa fa-trash"></span>
              </button>
            </div>
            <span class="badge badge-default badge-pill"
                  style="background-color: <?php echo $priority->color ?>">&nbsp;</span>
            <span class="name"><?php echo $priority->name ?></span>
          </li>
            <?php endforeach; ?>
          <li class="list-group-item list-group-item-default">
            <button class="btn btn-transparent btn-record-add" data-name="priority" type="button">
              <i class="fa fa-plus" aria-hidden="true"></i>
                <?php echo _('Add item') ?>
            </button>
          </li>
        </ul>
      </div>
    </div>
  </form>
@endsection
