<?php

namespace App\Repositories;

use App\Models\TimeSlot;
use App\Repositories\Interfaces\TimeSlotRepositoryInterface;

class TimeSlotRepository implements TimeSlotRepositoryInterface
{
    public function get($id)
    {
        return TimeSlot::find($id);
    }

    public function update($timeSlot, $data)
    {
        return $timeSlot->update($data);
    }
}
