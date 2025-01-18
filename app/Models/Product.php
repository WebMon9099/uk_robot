<?php

namespace App\Models;

use App\Models\Cart;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'slug', 'description', 'price','variations'
    ];

    protected $casts = [
        'variations' => 'array',
    ];
    public function images()
    {
        return $this->hasMany(Image::class, 'product_id');
    }

    protected static function booted()
    {
        parent::booted();

        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);
        });
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
