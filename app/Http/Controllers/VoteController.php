<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Poll;
use App\Option;
use App\Vote;
use App\Util\Sentinel;

class VoteController extends Controller
{
    public function processVote(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'poll_id' => 'required',
            'selection.*' => 'required|min:1',
        ]);

        if ($validator->fails())
        {
            $errors = $validator->errors();
            return response($errors, 400);
        }

        $poll = Poll::find($request->input('poll_id'));


        if ($poll->captcha)
        {
            if (!$request->has('g_recaptcha_response'))
            {
                return response(['message' => 'Your captcha was not verified, please try again.'], 400);
            }
            $guard = new Sentinel();
            $success = $guard->verifyCaptcha([
                'response' => $request->input('g_recaptcha_response'),
            ]);

            if (!$success)
            {
                return response(['message' => 'Your captcha was not verified, please try again.'], 400);
            }
        }

        if (count($request->input('selection')) > 1 && !$poll->multiple_choice)
        {
            return response(['message' => 'This poll is not multiple choice.'], 400);
        }
        
        foreach ($request->input('selection') as $option_id)
        {
            // TODO: vote check.

            Vote::create([
                'poll_id' => $poll->id,
                'option_id' => $option_id,
            ]);
        }

        return response(['message' => 'Vote(s) have been cast.', 'result_url' => route('poll-results', ['poll_id' => $poll->id]), 200]);
    }

    public function getResultsView($id)
    {
        $poll = $this->getResults($id);
        return !is_null($poll) ? view('results')->with('poll', $poll) : redirect('/');
    }

    public function getResults($id)
    {
        $poll = Poll::find($id);
        return $poll;
    }
}
