<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Option;

class Poll extends Model
{
    protected $fillable = ['question'];
    protected $appends = ['options', 'poll_url'];
    protected $hidden = ['owner_id', 'password'];

    public function getOptionsAttribute()
    {
        return Option::where('poll_id', '=', $this->id)->get();
    }

    public function getPollUrlAttribute()
    {
        $endpoint = "/poll/$this->id";
        if (env('APP_ENV') === 'local')
        {
            return url($endpoint);
        }
        else
        {
            return secure_url($endpoint);
        }
    }
}
