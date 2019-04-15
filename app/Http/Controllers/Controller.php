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

            $results = $service->getHotels(Carbon::today()->format('DD-MM-YY'), Carbon::tomorrow()->format('DD-MM-YY'), 1, 1, $locationId, 1);

            $amneties = [];

            if (!isEmpty($results))
            {
                foreach ($results->facets->features_models as $amnety)
                {
                    $amneties[] = [
                        $amnety->id => $amnety->name,
                    ];
                }

                $conv = $agent->getActionConversation();
                $carousel = Carousel::create();
                foreach ($results->hotels as $key => $hotel)
                {
                    $carousel->Option(
                        Option::create()
                            ->key('OPTION_'.$key)
                            ->title($hotel['name'])
                            ->description(function ($hotel) use ($amneties){
                                $description = '';
                                foreach ($hotel['amenities'] as $amenity)
                                {
                                    $description .= $amenity[$amenity];
                                }
                                return $description;
                            })
                            ->image($hotel['thumbnail'])
                    );
                }
            }

            return response()->json($agent->render());
        }
    }
}
