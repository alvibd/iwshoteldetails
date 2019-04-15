<?php

namespace App\Http\Controllers;

use App\amarroom\AmarRoomService;
use Carbon\Carbon;
use Dialogflow\WebhookClient;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @param Request $request
     * @param AmarRoomService $service
     */
    public function webHook(Request $request, AmarRoomService $service)
    {
        $agent = WebhookClient::fromData($request->json()->all());

        if ($agent->getIntent() == 'Hotels in') {
            $params = $agent->getParameters();

            $results = $service->getLocation($params->location);

            $locationId = null;

            foreach ($results as $result) {
                if (isset($result->hotel)) {
                    $locationId = $result->id;
                    break;
                }
            }

            $results = $service
                ->getHotels(Carbon::today()->format('DD-MM-YY'), Carbon::tomorrow()->format('DD-MM-YY'), 1, 1, $locationId, 1);

            $amneties = [];

            if (!isEmpty($results))
            {
                foreach ($results->facets->features_models as $amnety)
                {
                    $amneties[] = [
                        'name' => $amnety->name,
                        'id'   => $amnety->id
                    ];
                }

                foreach ($results->hotels as $hotel)
                {
                }
            }
        }
    }
}
