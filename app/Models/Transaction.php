<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $keyType = 'integer';
    public $incrementing = false;

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }

    public function atm()
    {
        return $this->belongsTo(Atm::class, 'atm_id', 'id');
    }

    public function receiver()
    {
        return $this->belongsTo(Account::class, 'receiver_id', 'id');
    }
}
