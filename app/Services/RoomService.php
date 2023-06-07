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
        $rooms = $this->roomRepository->all();
        return $rooms;
    }

    public function getRoom($id)
    {
        $room = $this->roomRepository->get($id);
        return $room;
    }

    public function getRoomTimeSlots($id)
    {
        $room = $this->getRoom($id);
        return $room->availableTimeSlots;
    }
}
