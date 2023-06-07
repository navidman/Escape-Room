<?php

namespace App\Http\Controllers\Room;

use App\Facades\BookingFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookingController extends Controller
{
    public function store(BookingRequest $request)
    {
        try {
            $booking = BookingFacade::storeBooking($request);
            return $booking;
        } catch (\Throwable $throwable) {
            report($throwable);
            return response('Internal server error!', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function index()
    {
        try {
            $bookings = BookingFacade::getBookingList();
            return response(['data' => $bookings], Response::HTTP_OK);
        } catch (\Throwable $throwable) {
            report($throwable);
            return response('Internal server error!', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
