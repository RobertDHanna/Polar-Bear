<?php

namespace App\Util;

use Request;

class LoaderQuery
{
    private static $vote_load_on_route_map = [
        'poll-results' => true,
    ];

    public static function shouldLoadVotes()
    {
        return isset(self::$vote_load_on_route_map[ Request::route()->getName() ]);
    }
}