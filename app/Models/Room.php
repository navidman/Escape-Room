<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    public function timeSlots(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TimeSlot::class, 'room_id');
    }

    public function availableTimeSlots(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TimeSlot::class, 'room_id')->where('is_booked', '=',false)->select(['id', 'room_id', 'is_booked', 'start', 'end']);
    }

    public function bookings(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Booking::class, 'room_id');
    }
}
