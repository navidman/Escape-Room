<?php

namespace App\Repositories\Interfaces;

interface BookingRepositoryInterface
{
    public function getBookingsByUserId($userId);

    public function save($data);

    public function delete($id);
}
