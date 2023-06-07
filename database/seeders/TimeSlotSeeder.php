<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TimeSlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();
        // Get all rooms
        $rooms = \App\Models\Room::all();

        // Loop through each room
        foreach ($rooms as $room) {
            while ($startDate <= $endDate) {
                // Set the start time to 8:00
                $startTime = Carbon::parse($startDate->format('Y-m-d') . ' 07:00');

                // Set the end time to 22:00
                $endTime = Carbon::parse($startDate->format('Y-m-d') . ' 21:00');

                // Loop through each hour from 8:00 to 22:00
                while ($startTime <= $endTime) {
                    // Create a new time slot
                    \App\Models\TimeSlot::create([
                        'room_id' => $room->id,
                        'start' => $startTime,
                        'end' => $startTime->copy()->addHour(),
                    ]);

                    // Increment the start time by 1 hour
                    $startTime->addHour();
                }
                // Move to the next day
                $startDate->addDay();
            }
        }
    }
}
