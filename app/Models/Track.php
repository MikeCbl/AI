<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Track extends Model
{
    protected $table = 'tracks';

    protected $primaryKey = 'id';
    //defaultowe obrazki
    protected $defaultImage = 'img/track/default/';

    protected $fillable = [
        'name',
        'img',
        'price_per_hour',
        'description',
        'is_available'
    ];

    public $timestamps = true; // Set timestamps to true

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

}
