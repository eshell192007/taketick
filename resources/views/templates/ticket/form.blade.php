@extends('logged')
@section('assets-js')
  <script src="/lib/tinymce/tinymce.min.js"></script>
  <script>
      tinymce.init({
          selector: 'textarea.tinymce',
          theme: 'modern',
          skin: '../../../addons/tinymce/light',
          toolbar: false,
          toolbar1: 'undo redo | insert | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
          height: 200
      });
  </script>
@endsection
@section('main')
  <form action="/ticket/add" method="post" class="container-fluid form-ajax">
    <h2><?php echo _('Add a ticket') ?></h2>
    <div class="alert alert-danger" style="display: none;"></div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="subject" class="label"><?php echo _('Subject') ?></label>
          <input type="text" name="subject" id="subject" class="form-control" placeholder="<?php echo _('Subject') ?>">
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="assignee" class="label"><?php echo _('Assign to') ?></label>
              <select name="assignee" id="assignee" class="form-control">
                  <?php foreach($users as $user): ?>
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                  <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="priority" class="label"><?php echo _('Priority') ?></label>
              <select name="priority" id="priority" class="form-control">
                  <?php foreach($priorities as $priority): ?>
                <option value="{{ $priority->id }}">{{ $priority->name }}</option>
                  <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="status" class="label"><?php echo _('Status') ?></label>
              <select name="status" id="status" class="form-control">
                  <?php foreach($statuses as $status): ?>
                <option value="{{ $status->id }}">{{ $status->name }}</option>
                  <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="type" class="label"><?php echo _('Type') ?></label>
              <select name="type" id="type" class="form-control">
                  <?php foreach($types as $type): ?>
                <option value="{{ $type->id }}">{{ $type->name }}</option>
                  <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="detail" class="label"><?php echo _('Detail') ?></label>
          <textarea name="detail"
                    id="detail"
                    class="form-control tinymce"
                    placeholder="<?php echo _('Detail') ?>"></textarea>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <button class="btn btn-primary">
          <i class="fa fa-pencil" aria-hidden="true"></i>
          <?php echo _('Save') ?>
        </button>
      </div>
    </div>
  </form>
@endsection