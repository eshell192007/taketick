<?php

namespace TakeTick;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public $primaryKey = 'id_status';
    public $fillable = ['name', 'color'];
}
