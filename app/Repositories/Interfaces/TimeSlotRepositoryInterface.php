<?php

namespace App\Repositories\Interfaces;

interface TimeSlotRepositoryInterface
{
    public function get($id);
    public function update($timeSlot, $data);
}
