<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailVarificationCode extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'news_letter_id'];
}
