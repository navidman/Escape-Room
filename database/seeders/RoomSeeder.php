<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            ],
            [
                'name' => 'Enigma',
                'theme' => 'Blue',
                'max_participants' => 6,
            ],
            [
                'name' => 'Scary Lab',
                'theme' => 'White',
                'max_participants' => 7,
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
