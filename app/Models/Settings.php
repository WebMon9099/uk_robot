<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    protected $fillable = [
        'live_client_id',
        'live_client_secret',
        'sandbox_client_id',
        'sandbox_client_secret',
        'mode',
        'payment_type',
        'status',
        // Add other fields if necessary
    ];
}
