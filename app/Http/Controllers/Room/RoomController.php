<?php

namespace App\Http\Controllers\Room;

use App\Facades\RoomFacade;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoomController extends Controller
{
    public function index() {
        try {
            $rooms = RoomFacade::getRoomList();
            return response(['data' => $rooms], Response::HTTP_OK);
        } catch (\Throwable $throwable) {
            report($throwable);
            return response('Internal server error!', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id) {
        try {
            $room = RoomFacade::getRoom($id);
            return response(['data' => $room], Response::HTTP_OK);
        } catch (\Throwable $throwable) {
            report($throwable);
            return response('Internal server error!', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getTimeSlots($id)
    {
        try {
            $timeSlots = RoomFacade::getRoomTimeSlots($id);
            return response(['data' => $timeSlots], Response::HTTP_OK);
        } catch (\Throwable $throwable) {
            report($throwable);
            return response('Internal server error!', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
