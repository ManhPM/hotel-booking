<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'sale',
        'price',
        'max_guests',
        'category_id',
        'status'
    ];

    public function images()
    {
        return $this->hasMany(RoomHasImage::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
