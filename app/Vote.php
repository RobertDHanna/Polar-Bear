<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = ['poll_id','option_id', 'user_id', 'ip_address', 'cookie'];
}
