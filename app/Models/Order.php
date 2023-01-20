<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'status',
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
    public function user()
    {
        // dd($this);
        return $this;
        // return $this->hasMany(OrderDetail::class);
        // return $this->belongsTo(User::class);
    }
}
