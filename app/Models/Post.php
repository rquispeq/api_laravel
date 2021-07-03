<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'title',
        'content'
    ];

    public function comments(){
        return $this->hasMany(Comment::class,'post_id','id');
    }

    public function author(){
        return $this->belongsTo(User::class,'author_id','id');
    }

    public function isAuthorLoaded(){
        return $this->relationLoaded('author');
    }

    public function isCommentsLoaded(){
        return $this->relationLoaded('comments');
    }
}
