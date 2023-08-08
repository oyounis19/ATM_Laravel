<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atm extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $keyType = 'integer';
    public $incrementing = false;

    protected $fillable = [
        'city',
        'street',
        'area',
        'balance',
    ];
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'atm_id', 'id');
    }
}
