<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Blog extends Model
{
    use HasFactory;

    use sluggable;

    public function sluggable():array{

        return [

            'slug' =>
            [
                'source' => 'title',
                'unique' => false,
                'onUpdate' => true
            ]
        ];

    }

    // Define the attributes that should be cast
    protected $casts = [
        'date' => 'datetime',  // Automatically cast the 'date' attribute to a Carbon instance
        'social_links' => 'array',
    ];

    protected $fillable = ['title', 'date', 'description','category','published_by','written_by','press_link','user_id','blog_type','social_links'];

    // Define the relationship to blog_images
    public function images()
    {
        return $this->hasMany(BlogImage::class);
    }
}
