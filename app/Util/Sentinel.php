<?php namespace App\Util;

class Sentinel
{
    public function verifyCaptcha(array $params)
    {
        assert( isset($params['response']) );

        $client = new \GuzzleHttp\Client();
        $res = $client->request('POST', 'https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret' => env('RECAPTCHA_SECRET'),
                'response' => $params['response'],
                'remoteip' => \Request::ip(),
            ]
        ]);

        //TODO: handle client not working.

        $body = json_decode($res->getBody(), true);

        return $body['success'];
    }
}