<?php

namespace Agc\Repositories;


class TokenRepository
{
    private $option_key = 'agcmanager_authorization';

    public function set($token)
    {
        update_option($this->option_key, $token, 'yes');
    }

    public function check()
    {
        return $this->get() != false;
    }

    public function get()
    {
        return get_option($this->option_key, false);
    }

    public function generate($length = 32)
    {
        $word = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789qwertyuiopasdfghjklzxcvbnm';
        $key = '';
        for ($i = 0; $i < $length; $i++) {
            $key .= $word[rand(0, strlen($word) - 1)];
        }
        return $key;
    }

    public function match($token)
    {
        $valid_token = $this->get();
        return $token === $valid_token;
    }
}
