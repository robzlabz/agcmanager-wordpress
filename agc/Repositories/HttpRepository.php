<?php


namespace Agc\Repositories;


class HttpRepository
{
    public function get($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['user-agent: agcmanager/plugin']);
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }


}