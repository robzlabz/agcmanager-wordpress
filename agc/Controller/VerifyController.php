<?php

namespace Agc\Controller;

use Agc\Repositories\TokenRepository;

class VerifyController
{
    public function __construct()
    {
        request()->required(['action', 'token']);
    }

    public function handle()
    {
        $token = request()->get('token');
        if ((new TokenRepository())->match($token)) {
            return response()->json(['status' => 'match', 'message' => 'Valid token']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Invalid Token']);
        }
    }
}
