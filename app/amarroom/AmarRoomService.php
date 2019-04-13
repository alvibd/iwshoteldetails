<?php


namespace App\amarroom;


use GuzzleHttp\Client;

class AmarRoomService
{
    private $base_url;
    private $client;

    public function __construct(Client $client, $base_url = 'https://amarroom.com/api/v2/')
    {
        $this->base_url = $base_url;
        $this->client = $client;
    }

    public function getLocation($location)
    {
        $result = $this->client->request('GET', $this->base_url.'search?q='.$location, ['verify' => 'C:\wamp64\bin\php\php7.2.14\cacert.pem']);

//        dump($result->getBody()->getContents());
        if ($result->getStatusCode() != 200)
        {
            abort(500);
        }
        else
            return ['results' => json_decode($result->getBody()->getContents())];
    }

    public function getHotels($checkin, $checkout, $adults = 1, $rooms = 1, $location, $page = 1)
    {
        $options = [
            'verify' => 'C:\wamp64\bin\php\php7.2.14\cacert.pem',
            'query' => [
                'checkin' => $checkin,
                'checkout' => $checkout,
                'adults' => $adults,
                'rooms' => $rooms,
                'location' => $location,
                'page' => $page
            ]
        ];
        $result = $this->client->request('GET', $this->base_url.'search/filtered/', $options);

        if ($result->getStatusCode() != 200)
        {
            abort(500);
        }
        else
            return ['results' => json_decode($result->getBody()->getContents())];
    }

    public function getHotelInfo($hotelId, $checkin, $checkout, $adults = 1, $rooms = 1)
    {
        $options = [
            'verify' => 'C:\wamp64\bin\php\php7.2.14\cacert.pem',
            'query' => [
                'checkin' => $checkin,
                'checkout' => $checkout,
                'adults' => $adults,
                'rooms' => $rooms
            ]
        ];
        $result = $this->client->request('GET', $this->base_url.'hotel/'.$hotelId.'/', $options);

        if ($result->getStatusCode() != 200)
        {
            abort(500);
        }
        else
            return ['results' => json_decode($result->getBody()->getContents())];
    }
}