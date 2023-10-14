<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Craft;
use App\Models\Facility;
use App\Models\Gallery;
use App\Models\Instructor;
use App\Models\Organization;
use App\Models\Program;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    
    public function home(){
        return view('home',[
            "title" => "Ma'had Bahrul Huda | Home",
            "crafts" => Craft::all(),
            "facilities" => Facility::all(),
            "galleries" => Gallery::limit(3)->get(),
            "instructors" => Instructor::all(),
            "organizations" => Organization::all(),
            "programs" => Program::all(),
            "posts" => Post::limit(3)->get(),
        ]);
    }

    public function blog(){
        return view('blog',[
            "title" => "Ma'had Bahrul Huda | Blog",
            "posts" => Post::all(),
        ]);
    }

    public function gallery(){
        return view('gallery',[
            "title" => "Ma'had Bahrul Huda | Galeri",
            "galleries" => Gallery::all(),
        ]);
    }

    public function post(Post $post){
        return view('post',[
            "title" => "Ma'had Bahrul Huda | ".$post->title,
            "post" => $post,
            "posts" => Post::limit(3)->get(),
        ]);
    }

}
