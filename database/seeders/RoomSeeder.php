<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $rooms = [
            [
                'name' => 'Prison Break',
                'theme' => 'Red',
                'max_participants' => 9,
                'price' => 1000,
            ],
            [
                'name' => 'Enigma',
                'theme' => 'Blue',
                'max_participants' => 6,
                'price' => 2000,
            ],
            [
                'name' => 'Scary Lab',
                'theme' => 'White',
                'max_participants' => 7,
                'price' => 3000,
            ]
        ];

        foreach ($rooms as $room)
        {
            $record = Room::whereTheme($room['theme'])->first();
            if (!$record) {
                Room::create($room);
            }
        }
    }
}
