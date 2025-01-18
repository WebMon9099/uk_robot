<?php

namespace App\Models;

use App\Models\PressReleaseFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PressRelease extends Model
{
    use HasFactory;

    protected $fillable=['title','content'];

    public function files()
    {
        return $this->hasMany(PressReleaseFile::class);
    }
}
