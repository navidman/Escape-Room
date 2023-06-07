<?php

namespace App\Repositories\Interfaces;

interface RoomRepositoryInterface
{
    public function all();
    public function get($id);
}
