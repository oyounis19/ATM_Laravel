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

    static public function checkDB($fingerprint){

    }

    /********************* Fingerprint Image Comparing **********************/
    // used: composer require spatie/image

    // static function calculateSimilarityScore($imagePath1, $imagePath2)
    // {
    //     $image1 = Image::load($imagePath1);
    //     $image2 = Image::load($imagePath2);

    //     $ssim = $image1->compareWithSsim($image2);

    //     return $ssim;
    // }

//     static function compareFingerprintImages($userImage)
//     {
//         $imageDirectory = public_path('fingerprint_images');
//         $minSimilarityScore = 0.8; // Adjust the threshold as needed

//         $files = scandir($imageDirectory);

//         foreach ($files as $file) {
//             if (in_array($file, ['.', '..']))
//                 continue;

//             $imagePath = $imageDirectory . '/' . $file;

//             $similarityScore = User::compareImages($userImage, $imagePath, $minSimilarityScore);

//             if ($similarityScore >= $minSimilarityScore) {
//                 return true; // Images are similar
//             }
//         }

//         return false; // No similar image found
//     }

//     static function compareImages($imagePath1, $imagePath2, $threshold = 0.8)
// {
//     // Load images
//     $image1 = imagecreatefromjpeg($imagePath1);
//     $image2 = imagecreatefromjpeg($imagePath2);

//     // Get dimensions
//     $width1 = imagesx($image1);
//     $height1 = imagesy($image1);
//     $width2 = imagesx($image2);
//     $height2 = imagesy($image2);

//     // Check if the images are the same size
//     if ($width1 != $width2 || $height1 != $height2) {
//         return false;
//     }

//     // Resize images to the same dimensions
//     $resizedImage1 = imagecreatetruecolor($width2, $height2);
//     imagecopyresized($resizedImage1, $image1, 0, 0, 0, 0, $width2, $height2, $width1, $height1);

//     // Calculate difference between images
//     $difference = 0;
//     for ($x = 0; $x < $width2; $x++) {
//         for ($y = 0; $y < $height2; $y++) {
//             $rgb1 = imagecolorat($resizedImage1, $x, $y);
//             $rgb2 = imagecolorat($image2, $x, $y);

//             $r1 = ($rgb1 >> 16) & 0xFF;
//             $g1 = ($rgb1 >> 8) & 0xFF;
//             $b1 = $rgb1 & 0xFF;

//             $r2 = ($rgb2 >> 16) & 0xFF;
//             $g2 = ($rgb2 >> 8) & 0xFF;
//             $b2 = $rgb2 & 0xFF;

//             $difference += abs($r1 - $r2) + abs($g1 - $g2) + abs($b1 - $b2);
//         }
//     }

//     // Calculate similarity score
//     $totalPixels = $width2 * $height2;
//     $similarityScore = 1 - ($difference / (255 * 3 * $totalPixels));

//     // Return true if the similarity score is greater than or equal to the threshold
//     return $similarityScore >= $threshold;
// }

}
