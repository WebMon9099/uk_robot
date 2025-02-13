<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PressReleaseFile extends Model
{
    use HasFactory;
    protected $fillable = ['press_release_id', 'file_path', 'file_type'];
}
