<?php

namespace Agc\Http;

use Agc\Repositories\TokenRepository;

class Request
{
    public function required($array)
    {
        foreach ($array as $request) {
            if (!$this->has($request)) {
                (new Response())->json([
                    'status' => 'error',
                    'message' => sprintf("%s is required", $request)
                ], 401);
            }
        }
        return $this;
    }

    public function has($name)
    {
        return isset($_REQUEST[$name]);
    }

    public function authenticated()
    {
        $token = $this->get('token');
        $match = (new TokenRepository())->match($token);
        if (!$match) {
            response()->json([
                'status' => 'error',
                'message' => 'Token miss match'
            ]);
        }
        return $this;
    }

    public function get($name, $default = null)
    {
        if ($this->has($name)) {
            return $_REQUEST[$name];
        }
        return $default;
    }
}
