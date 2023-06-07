<?php

namespace App\Repositories;

use App\Models\Room;
use App\Repositories\Interfaces\RoomRepositoryInterface;

class RoomRepository implements RoomRepositoryInterface
{
    public function all()
    {
        $rooms = Room::all();
        return $rooms;
    }

    public function get($id)
    {
        $room = Room::find($id);
        return $room;
    }

    public function save($data)
    {

    }

    public function delete($id)
    {

    }


}
