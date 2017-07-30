<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = ['poll_id', 'text', 'position'];
    protected $hidden = ['id'];
}
