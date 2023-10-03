<?php

namespace App\Http\Controllers;

use App\Helpers\ApiFormatter;
use App\Models\Facility;
use App\Models\Gallery;
use App\Models\Program;
use App\Models\Post;
use Illuminate\Http\Request;

class APIController extends Controller
{
  public function facility(Facility $facility){
    return ApiFormatter::createApi(200,"Success",$facility);
  }
  public function gallery(Gallery $gallery){
    return ApiFormatter::createApi(200,"Success",$gallery);
  }
  public function program(Program $program){
    return ApiFormatter::createApi(200,"Success",$program);
  }
  public function post(Post $post){
    return ApiFormatter::createApi(200,"Success",$post);
  }
  public function posts(){
    return ApiFormatter::createApi(200,"Success",Post::all());
  }
}
