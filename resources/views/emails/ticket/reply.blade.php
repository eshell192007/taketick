<?php
/** @var $ticket \TakeTick\Ticket */
?>
@component('mail::message')
  # <?php echo sprintf(_('#[%s]: %s'), $ticket->hash, $ticket->messages[0]->subject) ?>

  ## <?php echo _('Ticket details:') ?>

  ### <?php echo _('Subject:') ?> <?php echo $ticket->messages[0]->subject ?>

  <?php echo $ticket->messages[count($ticket->messages) - 1]->detail ?>

  @component('mail::button', ['url' => route('ticket.detail', ['id' => $ticket->id_ticket])])
      <?php echo _('View ticket') ?>
  @endcomponent
  {{ config('app.name') }}
@endcomponent
