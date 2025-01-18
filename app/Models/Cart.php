<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';

    protected $fillable = ['user_id', 'product_id', 'quantity','price','total_price','can_type'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function images()
    {
        return $this->hasMany(Image::class, 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
