<?php
/** @var $ticket \Helpdesk\Ticket */
?>
@extends('logged')
@section('main')
  <div class="container-fluid">
    <div class="card">
      <div class="card-header"><?php echo _('Latest tickets') ?></div>
      <div class="card-block">
        <div class="table-responsive">
          <table class="table table-striped table-hover table-sortable">
            <thead class="thead-default">
            <tr>
              <td><strong>#</strong></td>
              <td><?php echo _('Subject') ?></td>
              <td><?php echo _('Status') ?></td>
              <td><?php echo _('Type') ?></td>
              <td><?php echo _('Priority') ?></td>
              <td><?php echo _('From') ?></td>
              <td><?php echo _('Assigned to') ?></td>
            </tr>
            </thead>
            <tbody>
            @forelse($tickets as $ticket)
              <tr data-href="/ticket/{{ $ticket->id_ticket }}">
                <td scope="row">
                  <small>
                    <strong>
                      #[{{ $ticket->hash }}]
                    </strong>
                  </small>
                </td>
                <td>{{ $ticket->messages[0]->subject }}</td>
                <td>
                  @if(!empty($ticket->status))
                    <span class="badge badge-default"
                          style="background-color: {{ $ticket->status->color }}">{{ $ticket->status->name }}</span>
                  @else
                    <span class="badge badge-default"><?php echo _('Unknown') ?></span>
                  @endif
                </td>
                <td>
                  @if(!empty($ticket->type))
                    <span class="badge badge-default"
                          style="background-color: {{ $ticket->type->color }}">{{ $ticket->type->name }}</span>
                  @else
                    <span class="badge badge-default"><?php echo _('Unknown') ?></span>
                  @endif
                </td>
                <td>
                  @if(!empty($ticket->priority))
                    <span class="badge badge-default"
                          style="background-color: {{ $ticket->priority->color }}">{{ $ticket->priority->name }}</span>
                  @else
                    <span class="badge badge-default"><?php echo _('Unknown') ?></span>
                  @endif
                </td>
                <td>
                  @if(!empty($ticket->fromUser))
                    <a href="/user/<?php echo $ticket->fromUser->id ?>"><?php echo $ticket->fromUser->name ?></a>
                        <?php elseif(!empty($ticket->email)): ?>
                    <a href="mailto:<?php echo $ticket->email ?>"><?php echo $ticket->email ?></a>
                  @else
                    <small><?php echo _('Unknown') ?></small>
                  @endif
                </td>
                <td>
                  @if(!empty($ticket->assignee))
                    <a href="/user/<?php echo $ticket->assignee->id ?>"><?php echo $ticket->assignee->name ?></a>
                  @else
                    <small><?php echo _('Unknown') ?></small>
                  @endif
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7">
                  <div class="alert alert-danger"><?php echo _('No tickets found :)') ?></div>
                </td>
              </tr>
            @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
