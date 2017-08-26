<?php

namespace TakeTick;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public $primaryKey = 'id_message';
    public $relations = ['fromUser'];
    public $fillable = ['subject', 'detail'];

    public function fromUser()
    {
        return $this->hasOne(User::class, 'id', 'id_from');
    }
}
