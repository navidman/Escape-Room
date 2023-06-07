<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TimeSlot extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function room()
    {
        return $this->belongsTo(TimeSlot::class, 'room_id');
    }

    public function bookings()
    {
        return $this->hasMany(TimeSlot::class, 'time_slot_id');
    }
}
