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
        $result = $this->client->request('GET', $this->base_url.'search?q='.$location, ['verify' => env('SSL_CERT')]);

//        dump($result->getBody()->getContents());
        if ($result->getStatusCode() != 200)
        {
            abort(500);
        }
        else
            return json_decode($result->getBody()->getContents());
    }

    public function getHotels($checkin, $checkout, $adults = 1, $rooms = 1, $location, $page = 1)
    {
        $options = [
            'verify' => env('SSL_CERT'),
            'query' => [
                'checkin' => $checkin,
                'checkout' => $checkout,
                'adults' => $adults,
                'rooms' => $rooms,
                'location' => urlencode($location),
                'page' => $page
            ]
        ];
        $result = $this->client->request('GET', $this->base_url.'search/filtered/', $options);

        if ($result->getStatusCode() != 200)
        {
            abort(500);
        }
        else
            return json_decode($result->getBody()->getContents());
    }

    public function getHotelInfo($hotelId, $checkin, $checkout, $adults = 1, $rooms = 1)
    {
        $options = [
            'verify' => env('SSL_CERT'),
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
            return json_decode($result->getBody()->getContents());
    }
}