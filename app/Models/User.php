<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * @var mixed
     */

    public function findForPassport($username) {
        return $this->where('username', $username)->first();
    }

    public function checkPassword($password): bool
    {
        if ($this->password and Hash::check($password, $this->password)) {
            return true;
        }
        return false;
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'user_id');
    }
}
