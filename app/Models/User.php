<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login', 'email', 'password', 'firstName', 'lastName', 'country_id', 'phone', 'city', 'street', 'houseNumber', 'confirmed',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function fullName() {
        return $this->lastName . ' ' . $this->firstName;
    }

    public function country() {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function leftover() {
        return $this->hasMany(Leftover::class, 'user_id', 'id');
    }

    public function leftoverDay($day = null) {
        $day !== null ?: $day = Carbon::today()->format('Y-m-d');
        return $this->leftover()->whereDate('created_at', $day)->first();
    }
}
