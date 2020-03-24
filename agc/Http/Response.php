<?php


namespace Agc\Http;


class Response
{
    public function json($array, $response_code = 200)
    {
        http_response_code($response_code);
        header('Content-type: application/json');
        echo json_encode($array, JSON_PRETTY_PRINT);
        wp_die();
    }

    public function success($message)
    {
        $this->json([
            'status' => 'success',
            'message' => $message
        ]);
    }

    public function error($message)
    {
        $this->json([
            'status' => 'error',
            'message' => $message
        ], 401);
    }
}