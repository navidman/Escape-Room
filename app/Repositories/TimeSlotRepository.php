<?php

namespace App\Repositories;

use App\Models\TimeSlot;
use App\Repositories\Interfaces\TimeSlotRepositoryInterface;

class TimeSlotRepository implements TimeSlotRepositoryInterface
{
    public function all()
    {

    }

    public function get($id)
    {
        $timeSlot = TimeSlot::find($id);
        return $timeSlot;
    }

    public function save($data)
    {

    }

    public function delete($id)
    {

    }
}
