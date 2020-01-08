<?php

namespace App\Services\Ticket\TicketService;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

abstract class Base
{
    /**
     * @var Client
     */
    public static $httpClient;

    /**
     * Base constructor.
     */
    public function setClient()
    {
        self::$httpClient = new Client([
            'headers' => [
                'Content-Type'  => 'application/json',
                'Accept'  => 'application/json'
            ],
        ]);
    }

    /**
     * send http request to SMS Microservice API
     *
     * @param string $method
     * @param string $uri
     * @param array $data
     * @return mixed
     * @throws
     */
    public function requestToAPI(string $method, $uri, array $data = [])
    {
        $url = env('FRESH_DESK_DOMAIN') . $uri . '';
        try {
            self::setClient();
            $response = self::$httpClient->request($method, $url, [
                'json' => $data,
                'auth' => [ env('FRESH_DESK_API_KEY'), env('FRESH_DESK_PASSWORD')]
            ]);
            return json_decode($response->getBody()->getContents());
        } catch (RequestException $e) {
            return json_decode($e->getResponse()->getBody()->getContents());
        }
    }

}
