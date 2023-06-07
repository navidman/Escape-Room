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
        // Get all rooms
        $rooms = \App\Models\Room::all();

        // Loop through each room
        foreach ($rooms as $room) {
            $startDate = Carbon::now()->startOfWeek();
            $endDate = Carbon::now()->endOfWeek();
            while ($startDate <= $endDate) {
                // Set the start time to 9:00
                $startTime = Carbon::parse($startDate->format('Y-m-d') . ' 09:00');

                // Set the end time to 23:00
                $endTime = Carbon::parse($startDate->format('Y-m-d') . ' 23:00');

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
