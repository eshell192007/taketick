<?php

namespace Helpdesk;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $primaryKey = 'id_ticket';
    public $relations = ['status', 'type', 'priority', 'messages', 'assignee'];
    public $fillable = ['subject', 'description', 'hash', 'email'];

    public function status()
    {
        return $this->hasOne(Status::class, 'id_status', 'id_status');
    }

    public function priority()
    {
        return $this->hasOne(Priority::class, 'id_priority', 'id_priority');
    }

    public function type()
    {
        return $this->hasOne(Type::class, 'id_type', 'id_type');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'id_ticket', 'id_ticket');
    }

    public function assignee()
    {
        return $this->hasOne(User::class, 'id', 'id_assignee');
    }
}
