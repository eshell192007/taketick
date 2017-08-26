<?php
/** @var $ticket \TakeTick\Ticket */
?>
@component('mail::message')
  # <?php echo sprintf(_('New ticket #[%s]'), $ticket->hash) ?>

  <?php echo sprintf(_('Ticket created at **%s** by **%s**.'), date('d.m.Y H:i', strtotime($ticket->created_at)), empty($ticket->messages[0]->id_from) ? $ticket->messages[0]->email : $ticket->messages[0]->userFrom->name) ?>

  ## <?php echo _('Ticket details:') ?>

  ### <?php echo _('Subject:') ?> <?php echo $ticket->messages[0]->subject ?>

  <?php echo $ticket->messages[0]->detail ?>

  @component('mail::button', ['url' => route('ticket.detail', ['id' => $ticket->id_ticket])])
    <?php echo _('View ticket') ?>
  @endcomponent
  {{ config('app.name') }}
@endcomponent
