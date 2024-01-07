<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservation extends Model
{
    protected $table = 'reservations';

    protected $primaryKey = 'id';

    public $timestamps = false; //jezeli chesz updated_ad i created_at to musisz dac true


    protected $fillable = [
        'user_id',
        'track_id',
        'reservation_date',
        'start_time',
        'end_time',
        'price',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function track()
    {
        return $this->belongsTo(Track::class, 'track_id', 'id');
    }

    public function time()
    {
        $startDateTime = Carbon::parse($this->start_time);
        $endDateTime = Carbon::parse($this->end_time);

        $durationInMinutes = $startDateTime->diffInMinutes($endDateTime);
        // $durationInHours = $durationInMinutes / 60;

        // return round($durationInHours, 2);

        $hours = floor($durationInMinutes / 60);
        $minutes = $durationInMinutes % 60;

        // return sprintf('%02d:%02d', $hours, $minutes);
        // return sprintf('%dh %dmin', $hours, $minutes);

        if ($minutes > 0) {
            return sprintf('%dh %dmin', $hours, $minutes);
        } else {
            return sprintf('%dh', $hours);
        }
    }

    public function getPriceAttribute()
    {

        $startDateTime = Carbon::parse($this->start_time);
        $endDateTime = Carbon::parse($this->end_time);
        $durationInMinutes = $startDateTime->diffInMinutes($endDateTime);
        $track = $this->track;

                // $durationInHours = $startDateTime->diffInHours($endDateTime);
                // $track = $this->track;

                // if ($track && $durationInHours > 0) {
                //     return $durationInHours * $track->price_per_hour;
                // } else {
                //     return null;
                // }

                //zmieniałem na liczenie co do minuty :/

        if ($track && $durationInMinutes > 0) {
            $durationInHours = $durationInMinutes / 60;
            $price = $durationInHours * $track->price_per_hour;
            return round($price, 2);
        } else {
            return 0.00;
        }
    }


    public function getDiscountedPriceAttribute()
    {
        $price = $this->getPriceAttribute();
        $discountPercentage = $this->getDiscountPercentageAttribute();

        if ($discountPercentage > 0) {
            $discountedAmount = $price * ($discountPercentage / 100);
            $discountedPrice = $price - $discountedAmount;
            return round($discountedPrice, 2);
        }

        return $price;
    }

    public function getDiscountPercentageAttribute()
    {
        $user = $this->user;

        if (!$user) {
            return 0;
        }

        $membershipStart = Carbon::parse($user->admission_date);
        $membershipLength = $membershipStart->diffInYears(Carbon::now());

        if ($membershipLength >= 1 && $membershipLength < 2) {
            return 10;
        } elseif ($membershipLength >= 2 && $membershipLength < 5) {
            return 20;
        } elseif ($membershipLength >= 5) {
            return 30;
        }

        return 0;
    }

    // public function getPriceAttribute()
    // {
    //     $startDateTime = Carbon::parse($this->start_time);
    //     $endDateTime = Carbon::parse($this->end_time);
    //     $durationInMinutes = $startDateTime->diffInMinutes($endDateTime);
    //     $track = $this->track;

    //     if ($track && $durationInMinutes > 0) {
    //         $durationInHours = $durationInMinutes / 60;
    //         $price = $durationInHours * $track->price_per_hour;

    //         // Determine the user's membership length
    //         $user = $this->user;
    //         $membershipStart = $user ? Carbon::parse($user->admission_date) : null;
    //         $membershipLength = $membershipStart ? $membershipStart->diffInYears(Carbon::now()) : 0;

    //         // Assign the discount percentage based on membership length
    //         $discountPercentage = 0;
    //         if ($membershipLength >= 1 && $membershipLength < 2) {
    //             $discountPercentage = 10;
    //         } elseif ($membershipLength >= 2 && $membershipLength < 5) {
    //             $discountPercentage = 20;
    //         } elseif ($membershipLength >= 5) {
    //             $discountPercentage = 30;
    //         }

    //         // Apply the discount
    //         if ($discountPercentage > 0) {
    //             $discountedAmount = $price * ($discountPercentage / 100);
    //             $discountedPrice = $price - $discountedAmount;
    //             return round($discountedPrice, 2);
    //         } else {
    //             return round($price, 2);
    //         }
    //     } else {
    //         return 0.00;
    //     }
    // }



}
