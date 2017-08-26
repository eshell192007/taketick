<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 26.8.2017
 * Time: 21:13
 */

namespace TakeTick;

use Hashids\Hashids;
use Illuminate\Support\Facades\Mail;
use TakeTick\Mail\TicketCreated;

class TicketCreator
{
    public function create($from, $subject, $body)
    {
        $ticket = new Ticket();
        $id = $ticket->insertGetId([
            'created_at' => date('Y-m-d H:i:s')
        ]);
        $ticket->created_at = date('Y-m-d H:i:s');
        $message = new Message();
        $msgData = [
            'subject' => $subject,
            'detail' => $body,
            'id_ticket' => $id,
            'created_at' => date('Y-m-d H:i:s')
        ];
        if(is_numeric($from)) {
            $msgData['id_from'] = $from;
        } else {
            $msgData['email'] = $from;
        }
        $idMsg = $message->insertGetId($msgData);
        $message = new \stdClass();
        $message->subject = $subject;
        $message->detail = $body;
        $message->id_from = null;
        $message->userFrom = null;
        $message->email = $from;
        $message->id_ticket = $id;
        $ticket->messages = [
            $message
        ];
        $hash = (new Hashids('', 8, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_'))->encode($id);
        $ticket->hash = $hash;
        $ticket->where('id_ticket', $id)->update([
            'hash' => $hash
        ]);
        foreach (config('app.notifyEmails') as $email) {
            Mail::to($email)->send(new TicketCreated($ticket));
        }
        return $id;
    }
}