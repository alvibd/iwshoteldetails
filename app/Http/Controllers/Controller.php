<?php

namespace App\Http\Controllers;

use App\amarroom\AmarRoomService;
use Carbon\Carbon;
use Dialogflow\WebhookClient;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function webHook(Request $request, AmarRoomService $service)
    {
        $agent = WebhookClient::fromData($request->json()->all());

        if ($agent->getIntent() == 'Hotels in')
        {
            $params = $agent->getParameters();

            $results = $service->getLocation($params->location);

            $locationId = null;

            foreach ($results as $result)
            {
                if (isset($result->hotel))
                {
                    $locationId = $result->id;
                    break;
                }

            }

            $hotels = $service->getHotels(Carbon::today()->format('DD-MM-YY'), Carbon::tomorrow()->format('DD-MM-YY'), 1, 1, $locationId, 1);


        }
    }
}
