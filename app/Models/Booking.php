<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'coupon_id',
        'room_id',
        'check_in_date',
        'check_out_date',
        'note',
        'total',
        'payment_status'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id');
    }

    public function payments()
    {
        return $this->hasOne(Payment::class, 'id');
    }

    public function coupon()
    {
        return $this->hasOne(Coupon::class, 'id');
    }

    public function payment_method()
    {
        return $this->hasOne(PaymentMethod::class, 'id');
    }
}
