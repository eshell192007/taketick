<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 26.8.2017
 * Time: 17:42
 */

namespace TakeTick\Http\Controllers;

use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Jenssegers\Date\Date;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use TakeTick\Http\Controllers\Controller;
use TakeTick\Mail\TicketCreated;
use TakeTick\Mail\TicketReply;
use TakeTick\Message;
use TakeTick\Ticket;
use TakeTick\TicketCreator;

class TicketController extends Controller
{
    public function add(Request $request)
    {
        $id = (new TicketCreator())->create(
            Auth::id(),
            $request->input('subject'),
            $request->input('detail')
        );
        return response()->json([
            'id' => $id,
            'redirect' => "/ticket/$id"
        ]);
    }

    public function reply($id, Request $request)
    {
        $ticket = Ticket::where('id_ticket', $id)->get();
        if(empty($ticket)) {
            throw new NotFoundHttpException();
        }
        $ticket = $ticket[0];
        $message = new Message();
        $idMessage = $message->insertGetId([
            'subject' => $ticket->messages[0]->subject,
            'detail' => $request->input('detail'),
            'created_at' => date('Y-m-d H:i:s'),
            'id_from' => Auth::id(),
            'id_ticket' => $id
        ]);
        $ticket->messages[] = $message->where('id_message', $idMessage)->get()[0];
        if(!empty($ticket->messages[0]->email)) {
            Mail::to($ticket->messages[0]->email)->send(new TicketReply($ticket));
        }
        if(!empty($ticket->messages[0]->fromUser)) {
            Mail::to($ticket->messages[0]->fromUser->email)->send(new TicketReply($ticket));
        }
        return response()->json([
            'subject' => $ticket->messages[0]->subject,
            'detail' => $request->input('detail'),
            'fromLink' => "/user/" . Auth::id(),
            'fromLabel' => Auth::user()->name,
            'dateDiff' => Date::parse(date('Y-m-d H:i:s'))->diffForHumans(),
        ]);
    }

    public function edit($id, Request $request)
    {
        $ticket = new Ticket();
        $ticket->where('id_ticket', $id)->update([
            'id_assignee' => $request->input('assignee'),
            'id_status' => $request->input('status'),
            'id_type' => $request->input('type'),
            'id_priority' => $request->input('priority'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        return response()->json([
            'alert' => _('Ticket updated')
        ]);
    }
}