<?php

namespace App\Repositories;

use App\Models\Booking;
use App\Repositories\Interfaces\BookingRepositoryInterface;

class BookingRepository implements BookingRepositoryInterface
{
    public function getBookingsByUserId($userId)
    {
        return Booking::whereUserId($userId)->get();
    }

    public function save($data)
    {
        $booking = Booking::create($data);
        return $booking;
    }

    public function delete($id)
    {

    }


}
