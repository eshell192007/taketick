<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 24.8.2017
 * Time: 10:53
 */

namespace TakeTick\Http\Controllers;

use Illuminate\Support\Facades\DB;
use TakeTick\Priority;
use TakeTick\Status;
use TakeTick\Ticket;
use TakeTick\Type;
use TakeTick\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FrontController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with(['status', 'type', 'priority', 'assignee'])->whereNotIn('id_status', function (Builder $resource) {
            $resource->select('id_status')->from('statuses')->where('displayed', 0);
        })->get();
        return view(empty(Auth::id()) ? 'templates.index' : 'templates.logged', [
            'tickets' => $tickets
        ]);
    }

    public function ticket($id)
    {
        $ticket = Ticket::with(['status', 'type', 'priority', 'assignee'])->where('id_ticket', $id)->get();
        if (empty($ticket)) {
            throw new NotFoundHttpException();
        }
        $users = User::all();
        $types = Type::all();
        $priorities = Priority::all();
        $statuses = Status::all();
        return view('templates.ticket.view', [
            'ticket' => $ticket[0],
            'users' => $users,
            'priorities' => $priorities,
            'types' => $types,
            'statuses' => $statuses,
        ]);
    }

    public function ticketForm($id = null)
    {
        $users = User::all();
        $types = Type::all();
        $priorities = Priority::all();
        $statuses = Status::all();
        return view('templates.ticket.form', [
            'users' => $users,
            'priorities' => $priorities,
            'types' => $types,
            'statuses' => $statuses,
        ]);
    }

    public function showSettings()
    {
        $users = User::all();
        $types = Type::all();
        $priorities = Priority::all();
        $statuses = Status::all();
        return view('templates.settings', [
            'users' => $users,
            'priorities' => $priorities,
            'types' => $types,
            'statuses' => $statuses,
        ]);
    }
}