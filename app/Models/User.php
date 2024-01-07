<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'gender',
        'birth_date',
        'birth_place',
        'email',
        'phone',
        'residential_address',
        'pesel',
        'admission_date',
        'password',
        'role_id',
        'image'
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
        'password' => 'hashed',
    ];

    protected function password(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => Hash::make($value)
        );
    }

    public function getPublicDataAttribute()
    {
        return [
            'id' => $this->attributes['id'],
            'name' => $this->attributes['name'],
            'last_name' => $this->attributes['last_name'],
            'phone' => $this->attributes['phone'],
        ];
    }

    public function setDefaultImageBasedOnGender()
    {
        $basePath = 'img/user/default/';

        if ($this->gender === 'M') {
            $this->image = asset($basePath . 'male.jpg');
        } else {
            $this->image = asset($basePath . 'female.jpg');
        }
    }


    //funkcja do nazwy roli
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }
}
