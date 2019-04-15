<?php


namespace App\amarroom;


use GuzzleHttp\Client;

class AmarRoomService
{
    private $base_url;
    private $client;

    /**
     * AmarRoomService constructor.
     * @param Client $client
     * @param string $base_url
     */
    public function __construct(Client $client, $base_url = 'https://amarroom.com/api/v2/')
    {
        $this->base_url = $base_url;
        $this->client = $client;
    }

    /**
     * @param $location
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getLocation($location)
    {
        $result = $this->client->request('GET', $this->base_url.'search?q='.$location, ['verify' => env('SSL_CERT')]);

        if ($result->getStatusCode() != 200) {
            abort(500);
        } else {
            return json_decode($result->getBody()->getContents());
        }
    }

    /**
     * @param $checkin
     * @param $checkout
     * @param int $adults
     * @param int $rooms
     * @param $location
     * @param int $page
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getHotels($checkin, $checkout, $adults = 1, $rooms = 1, $location, $page = 1)
    {
        $options = [
            'verify' => env('SSL_CERT'),
            'query' => [
                'checkin'  => $checkin,
                'checkout' => $checkout,
                'adults'   => $adults,
                'rooms'    => $rooms,
                'location' => urlencode($location),
                'page'     => $page
            ]
        ];
        $result = $this->client
            ->request('GET', $this->base_url.'search/filtered/', $options);

        if ($result->getStatusCode() != 200) {
            abort(500);
        } else {
            return json_decode($result->getBody()->getContents());
        }
    }

    /**
     * @param $hotelId
     * @param $checkin
     * @param $checkout
     * @param int $adults
     * @param int $rooms
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
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