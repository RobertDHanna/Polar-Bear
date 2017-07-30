<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PollController extends Controller
{
    /**
     * Gets a poll.
     *
     * @param UUID $id
     * @return void
     */
    public function get($id)
    {
        dd($id);
    }

    /**
     * Creates a new poll.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        dd($request->input());
    }

    /**
     * Edits an existing poll.
     *
     * @param Request $request
     * @param UUID $id
     * @return void
     */
    public function edit(Request $request, $id)
    {
        dd($id, $request);
    }
}
