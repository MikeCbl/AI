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

    // public function getReservationDateAttribute($value)
    // {
    //     return Carbon::parse($value)->format('Y-m-d');
    // }

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

        // $durationInHours = $startDateTime->diffInHours($endDateTime);
        // $track = $this->track;

        // if ($track && $durationInHours > 0) {
        //     return $durationInHours * $track->price_per_hour;
        // } else {
        //     return null;
        // }

        //zmieniałem na liczenie co do minuty :/
        $durationInMinutes = $startDateTime->diffInMinutes($endDateTime);
        $track = $this->track;

        if ($track && $durationInMinutes > 0) {
            $durationInHours = $durationInMinutes / 60;
            $price = $durationInHours * $track->price_per_hour;
            return round($price, 2);
        } else {
            return 0.00;
        }
    }


    // pruba zabezpieczenia ceny przed zmiana
    // public function getPriceAttribute()
    // {
    //     $startDateTime = Carbon::parse($this->start_time);
    //     $endDateTime = Carbon::parse($this->end_time);
    //     $durationInMinutes = $startDateTime->diffInMinutes($endDateTime);
    //     $track = $this->track;

    //     if ($track && $durationInMinutes > 0) {
    //         $durationInHours = $durationInMinutes / 60;
    //         $originalPricePerHour = $track->getOriginal('price_per_hour');
    //         $price = $durationInHours * $originalPricePerHour;
    //         return round($price, 2);
    //     } else {
    //         return 0.00;
    //     }
    // }


}
