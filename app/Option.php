<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Vote;
use App\Util\LoaderQuery;

class Option extends Model
{
    protected $fillable = ['poll_id', 'text', 'position'];
    protected $appends = ['vote_num'];

    public function getVoteNumAttribute()
    {
        return LoaderQuery::shouldLoadVotes() ? Vote::where('option_id', '=', $this->id)->count() : null;
    }
}
