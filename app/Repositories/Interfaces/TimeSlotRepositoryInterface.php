<?php

namespace App\Repositories\Interfaces;

interface TimeSlotRepositoryInterface
{
    public function all();

    public function get($id);

    public function save($data);

    public function delete($id);

    public function update($timeSlot, $data);


}
