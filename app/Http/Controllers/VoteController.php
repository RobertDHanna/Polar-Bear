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


        $ip = null;
        $cookie = null;
        if ($poll->block_by_cookie)
        {
            // get votes by poll id & user cookie
            // if exist they already voted on this poll.
            if ($request->cookie('polljam-c'))
            {
                $num = Vote::where('poll_id', '=', $poll->id)->where('cookie', '=', $request->cookie('polljam-c'))->count();
                if ($num > 0)
                {
                    return response(['message' => 'You have already voted on this poll!'], 400);
                }
                $cookie = $request->cookie('polljam-c');
            }
            else
            {
                $cookie = uniqid();
            }
        }

        if ($poll->block_by_ip)
        {
            $ip = \Request::ip();
            // get votes by poll id & user ip
            // if exist they already voted on this poll.
            $num = Vote::where('poll_id', '=', $poll->id)->where('ip_address', '=', $ip)->count();
            if ($num > 0)
            {
                return response(['message' => 'You have already voted on this poll!'], 400);
            }
        }
        
        foreach ($request->input('selection') as $option_id)
        {
            Vote::create([
                'poll_id' => $poll->id,
                'option_id' => $option_id,
                'ip_address' => $ip,
                'cookie' => $cookie,
            ]);
        }

        $response = response(['message' => 'Vote(s) have been cast.', 'result_url' => route('poll-results', ['poll_id' => $poll->id]), 200]);

        if (!$request->cookie('polljam-c') && $cookie)
        {
            $response->withCookie(cookie()->forever('polljam-c', $cookie));
        }
        return $response;
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
