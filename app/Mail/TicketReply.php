<?php

namespace TakeTick\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use TakeTick\Ticket;

class TicketReply extends Mailable
{
    use Queueable, SerializesModels;

    /** @var Ticket */
    private $ticket;

    /**
     * TicketReply constructor.
     * @param Ticket $ticket
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
            ->subject(sprintf(_('#[%s] %s'), $this->ticket->hash, $this->ticket->messages[0]->subject))
            ->markdown('emails.ticket.reply', [
            'ticket' => $this->ticket
        ]);
    }
}
