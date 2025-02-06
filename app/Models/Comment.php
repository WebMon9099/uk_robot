<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['blog_id', 'user_id', 'body', 'parent_id'];

    // Define the relationship to the Blog
    public function blog()
    {
        return $this->belongsTo(Blog::class); // Assuming you have a Blog model
    }

    // Define the relationship to the User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship to the parent comment (if it's a reply)
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Define the relationship to the replies (children comments)
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
