<?php

namespace App\Repositories;

use App\Models\Booking;
use App\Repositories\Interfaces\BookingRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class BookingRepository implements BookingRepositoryInterface
{
    public function get($id)
    {
        return Booking::whereId($id)->whereUserId(Auth::user()->id)->firstOrFail();
    }
    public function getBookingsByUserId($userId)
    {
        return Booking::whereUserId($userId)->get();
    }

    public function save($data)
    {
        return Booking::create($data);
    }

    public function delete($booking)
    {
        return $booking->delete();
    }
}
