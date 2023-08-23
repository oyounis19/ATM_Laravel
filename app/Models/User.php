<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Image\Image;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ssn',
        'card_id',
        'fingerprint',
        'password', // User will insert the PIN in the first login into the ATM
        'name',
        'street',
        'area',
        'email',
        'city',
        'phone_num',
        'fingerprint_hash'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $primaryKey = 'ssn';// IMPORTANT
    protected $keyType = 'string';
    public $incrementing = false;

    public function account()
    {
        return $this->hasMany(Account::class, 'ssn', 'ssn');
    }

    public function Card()
    {
        return $this->hasOne(Card::class, 'card_id', 'card_id');
    }
}
