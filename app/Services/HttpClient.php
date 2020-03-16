<?php


namespace App\Services;


use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class HttpClient
{

    /**
     * @param $method
     * @param  string  $uri
     * @param  array  $options
     * @return Response
     */
    public function request($method, $uri = '', array $options = []): Response
    {
        return app(Client::class)
            ->request($method, $uri, $options);
    }

}
