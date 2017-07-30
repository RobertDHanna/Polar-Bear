<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Option;

class Poll extends Model
{
    protected $fillable = ['question'];
    protected $appends = ['options'];
    protected $hidden = ['owner_id', 'password'];

    public function getOptionsAttribute()
    {
        return Option::where('poll_id', '=', $this->id)->get();
    }
}
