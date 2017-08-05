<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Poll;
use App\Option;

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
        $poll = Poll::find($id);
        if (!$poll) {
            return view('welcome');
        }
        return view('vote')->with('poll', $poll->toArray());
    }

    /**
     * Creates a new poll.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        /**
        * Validate the request.
        */
        $custom_error_message = [
            'size' => 'The :attribute must have at least one element.',
            'options.min' => 'There must be at least two :attribute.',
        ];
        $validator = Validator::make($request->all(), [
            'question' => 'required|max:200', // 200 characters max.
            'options' => 'required|min:2|max:10', // minimum of two options and maximum of 10.
            'options.*' => 'required|max:200', // 200 characters max per option.
        ], $custom_error_message);

        if ($validator->fails())
        {
            $errors = $validator->errors();
            return response($errors, 400);
        }

        /**
        * Construct the poll body.
        */
        $poll_body = [
            'question' => $request->input('question'),
            'captcha' => $request->input('captcha') ?: false,
            'multiple_choice' => $request->input('multiple_choice') ?: false,
        ];

        /**
        * Set duplicate checking prefs.
        */
        if ($request->input('dup_check') === 'cookie')
        {
            $poll_body['block_by_cookie'] = true;
        }
        else if ($request->input('dup_check') === 'ip')
        {
            $poll_body['block_by_ip'] = true;
        }

        $poll = Poll::create($poll_body);

        /**
        * Add options.
        */
        foreach ($request->input('options') as $i => $option)
        {
            Option::create([
                'poll_id' => $poll->id,
                'text' => $option,
                'position' => $i,
            ]);
        }
        
        return response(['poll' => Poll::find($poll->id) ], 200);
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
