<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\UserResource;

class PostRelationShipController extends Controller
{
    public function author(Post $post){
        return new UserResource($post->author);
    }

    public function comments(Post $post){

    }
}
