<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function timeSlots()
    {
        return $this->hasMany(TimeSlot::class, 'room_id');
    }

    public function availableTimeSlots()
    {
        return $this->hasMany(TimeSlot::class, 'room_id')->where('is_booked', '=',false)->select(['id', 'room_id', 'is_booked', 'start', 'end']);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'room_id');
    }
}
