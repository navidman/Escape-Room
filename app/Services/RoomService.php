<?php

namespace App\Services;

use App\Repositories\Interfaces\RoomRepositoryInterface;

class RoomService
{
    protected $roomRepository;

    public function __construct(RoomRepositoryInterface $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }
    public function getRoomList()
    {
        return $this->roomRepository->all();
    }

    public function getRoom($id)
    {
        return $this->roomRepository->get($id);
    }

    public function getRoomTimeSlots($id)
    {
        $room = $this->getRoom($id);
        return $room->availableTimeSlots;
    }
}
