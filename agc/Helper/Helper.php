<?php

use Agc\Http\Request;
use Agc\Http\Response;
use Agc\Repositories\LogRepository;

function request($name = null)
{
    if ($name == null) {
        return (new Request());
    }
    return (new Request())->get($name);
}

function response()
{
    return (new Response());
}

function info($message, $data = [])
{
    (new LogRepository())->info($message, $data);
}