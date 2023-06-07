<?php

namespace App\Repositories\Interfaces;

interface RoomRepositoryInterface
{
    public function all();

    public function get($id);

    public function save($data);

    public function delete($id);

}
