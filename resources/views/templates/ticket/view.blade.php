<?php
use Jenssegers\Date\Date;
/** @var $ticket \TakeTick\Ticket */
?>
@extends('logged')
@section('main')
  <div class="container-fluid">
    <h2><?php echo sprintf(_('Ticket #[%s]'), $ticket->hash) ?></h2>
    <div class="alert alert-danger" style="display: none;"></div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <h3><?php echo $ticket->messages[0]->subject ?></h3>
        </div>
        <form action="/ticket/1/edit" method="post" class="row form-ajax">
          <div class="col-12">
            <div class="alert alert-success" style="display: none;"></div>
          </div>
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="col-md-6">
            <div class="form-group">
              <label for="assignee" class="label"><?php echo _('Assign to') ?></label>
              <select name="assignee" id="assignee" class="form-control">
                <option value=""><?php echo _('Nobody') ?></option>
                  <?php foreach($users as $user): ?>
                <option value="{{ $user->id }}" <?php if ($user->id == $ticket->id_assignee) echo 'selected' ?>>{{ $user->name }}</option>
                  <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="priority" class="label"><?php echo _('Priority') ?></label>
              <select name="priority" id="priority" class="form-control">
                <option value=""><?php echo _('Unknown') ?></option>
                  <?php foreach($priorities as $priority): ?>
                <option value="{{ $priority->id_priority }}" <?php if ($priority->id_priority == $ticket->id_priority) echo 'selected' ?>>{{ $priority->name }}</option>
                  <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="status" class="label"><?php echo _('Status') ?></label>
              <select name="status" id="status" class="form-control">
                <option value=""><?php echo _('Unknown') ?></option>
                  <?php foreach($statuses as $status): ?>
                <option value="{{ $status->id_status }}" <?php if ($status->id_status == $ticket->id_status) echo 'selected' ?>>{{ $status->name }}</option>
                  <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="type" class="label"><?php echo _('Type') ?></label>
              <select name="type" id="type" class="form-control">
                <option value=""><?php echo _('Unknown') ?></option>
                  <?php foreach($types as $type): ?>
                <option value="{{ $type->id_type }}" <?php if ($type->id_type == $ticket->id_type) echo 'selected' ?>>{{ $type->name }}</option>
                  <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="col-12">
            <button class="btn btn-primary">
              <i class="fa fa-pencil" aria-hidden="true"></i>
                <?php echo _('Save') ?>
            </button>
          </div>
        </form>
      </div>
      <div class="col-md-6">
        <ul class="scrollbar-content scrollbar-bottom list-group">
            <?php foreach($ticket->messages as $message): ?>
            <?php $date = Date::parse($message->created_at) ?>
          <li class="list-group-item d-block">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">
                  <?php if(!empty($message->id_from)): ?>
                <a href="/user/<?php echo $message->id_from ?>"><?php echo $message->fromUser->name ?></a>
                  <?php else: ?>
                <a href="mailto:<?php echo $message->email ?>"><?php echo $message->email ?></a>
                  <?php endif; ?>
              </h5>
              <small class="text-muted"><?php echo $date->diffForHumans() ?></small>
            </div>
            <strong class="mb-1"><?php echo $message->subject ?></strong>
            <div class="clearfix"></div>
            <div class="message-body">
                <?php echo $message->detail ?>
            </div>
          </li>
            <?php endforeach; ?>
          <li class="list-group-item d-block" id="reply-form">
            <form action="/ticket/<?php echo $ticket->id_ticket ?>/reply" method="post" class="form-ajax d-block w-100" data-callback="messageAdd">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <h5 class="mb-1"><?php echo _('Reply') ?></h5>
              <div class="form-group">
                <label for="detail" class="label"><?php echo _('Message') ?></label>
                <textarea name="detail"
                          id="detail"
                          class="form-control"
                          placeholder="<?php echo _('Message body') ?>"></textarea>
              </div>
              <div class="text-right">
                <button class="btn btn-success">
                  <i class="fa fa-envelope" aria-hidden="true"></i>
                  <?php echo _('Send') ?>
                </button>
              </div>
            </form>
          </li>
        </ul>
      </div>
    </div>
  </div>
@endsection