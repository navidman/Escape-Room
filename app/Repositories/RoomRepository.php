<?php

namespace App\Repositories;

use App\Models\Room;
use App\Repositories\Interfaces\RoomRepositoryInterface;

class RoomRepository implements RoomRepositoryInterface
{
    public function all()
    {
        return Room::all();
    }

    public function get($id)
    {
        return Room::find($id);
    }
}
