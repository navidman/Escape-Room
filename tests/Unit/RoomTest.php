<?php

namespace Tests\Unit;

use App\Http\Controllers\Room\RoomController;
use Tests\TestCase;
//use PHPUnit\Framework\TestCase;

class RoomTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_get_room_list()
    {
        $returnedValue = (new RoomController())->index();
        $this->assertEquals(200, $returnedValue->status());
        $this->assertNotEmpty($returnedValue);
    }

    public function test_get_room()
    {
        $returnedValue = (new RoomController())->show(random_int(1, 3));
        $this->assertEquals(200, $returnedValue->status());
        $this->assertNotEmpty($returnedValue);
    }

    public function test_get_room_time_slots()
    {
        $returnedValue = (new RoomController())->getTimeSlots(random_int(1, 3));
        $this->assertEquals(200, $returnedValue->status());
        $this->assertNotEmpty($returnedValue);
    }
}
