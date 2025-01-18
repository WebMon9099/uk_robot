<?php

namespace App\Models;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    
    const STATUS_PENDING = 'pending';
    const STATUS_PARTIAL_SHIPPED = 'partial_shipped';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';
    protected $casts = [
        'address' => 'array', // You can also use 'object' if preferred
    ];
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'address',
        'card_number',
        'cvs',
        'expiry_date',
        'price',
        'payment_id'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class,'address_id');
    }
}
