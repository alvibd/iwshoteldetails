<?php


namespace App\Http\Controllers;


use App\amarroom\AmarRoomService;
use Illuminate\Http\Request;

class DataController
{

    public function getLocation(Request $request, AmarRoomService $service)
    {
        return response()->json($service->getLocation($request->location));
    }

    public function getHotels(Request $request, AmarRoomService $service)
    {
        return response()->json($service->getHotels($request->checkin, $request->checkout, $request->adults, $request->rooms, $request->location, $request->page));
    }

    public function getHotelInfo(Request $request, AmarRoomService $service, $hotelId)
    {
        return response()->json($service->getHotelInfo($hotelId, $request->checkin, $request->checkout, $request->adults, $request->rooms));
    }
}