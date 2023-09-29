<?php

namespace App\Http\Controllers;

use App\Helpers\ApiFormatter;
use App\Models\Post;
use Illuminate\Http\Request;

class APIController extends Controller
{
  public function post(Post $post){
    return ApiFormatter::createApi(200,"Success",$post);
  }
  public function posts(){
    return ApiFormatter::createApi(200,"Success",Post::all());
  }
}
