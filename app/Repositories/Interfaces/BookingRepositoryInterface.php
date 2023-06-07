<?php

namespace App\Repositories\Interfaces;

interface BookingRepositoryInterface
{
    public function all();

    public function get($id);

    public function save($data);

    public function delete($id);

}
