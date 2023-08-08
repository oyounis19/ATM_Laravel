<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $keyType = 'integer';
    public $incrementing = false;

    protected $fillable = ['id', 'exp_date', 'cvv', 'state'];

    public function user()
    {
        return $this->belongsTo(User::class, 'card_id', 'card_id');
    }

    // Static function to generate card information
    public static function generateCardInfo()
    {
        $cardInfo = [];

        do {
            // Generate card ID (assuming a random 16-digit number)
            $cardInfo['id'] = mt_rand(1000000000000000, 9999999999999999);
        } while (self::where('id', $cardInfo['id'])->exists());

        // Generate expiration date (assuming 2 years from the current date)
        $currentYear = date('Y');
        $currentMonth = date('m');
        $currentDay = date('d');
        $expirationYear = $currentYear + 2;
        $cardInfo['exp_date'] = $expirationYear . '-' . $currentMonth . '-' . $currentDay;

        // Generate CVV (assuming a random 3-digit number)
        $cardInfo['cvv'] = mt_rand(100, 999);

        return $cardInfo;
    }
}
