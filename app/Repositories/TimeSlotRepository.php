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
        return TimeSlot::find($id);
    }

    public function save($data)
    {

    }

    public function delete($id)
    {

    }

    public function update($timeSlot, $data)
    {
        return $timeSlot->update($data);
    }

}
