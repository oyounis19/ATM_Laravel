<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'password',
        'role',
    ];
    protected $primaryKey = 'id';
    protected $keyType = 'integer';
    public $incrementing = false;
}
