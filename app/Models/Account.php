<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $keyType = 'integer';
    public $incrementing = false;
    protected $fillable = [
        'type',
        'ssn',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'ssn', 'ssn');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'account_id', 'id');
    }
}
