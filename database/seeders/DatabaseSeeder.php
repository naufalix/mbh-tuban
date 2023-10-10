<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Craft;
use App\Models\Facility;
use App\Models\Gallery;
use App\Models\Instructor;
use App\Models\Organization;
use App\Models\Post;
use App\Models\Program;
use App\Models\User;
use File;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            "name" => "Naufal Ulinnuha",  
            "username" => "naufal",  
            "password" => bcrypt('admin')
        ]);

        $posts = json_decode(File::get("database/data/posts.json"));
        foreach ($posts as $key => $value) {
            Post::create([
                "title" => $value->title,
                "slug" => $value->slug,
                "body" => $value->body,
                "image" => $value->image,
            ]);
        }

        $facilities = json_decode(File::get("database/data/facilities.json"));
        foreach ($facilities as $key => $value) {
            Facility::create([
                "name" => $value->name,
                "image" => $value->image,
            ]);
        }

        $programs = json_decode(File::get("database/data/programs.json"));
        foreach ($programs as $key => $value) {
            Program::create([
                "name" => $value->name,
                "body" => $value->body,
            ]);
        }

        $galleries = json_decode(File::get("database/data/galleries.json"));
        foreach ($galleries as $key => $value) {
            Gallery::create([
                "name" => $value->name,
                "image" => $value->image,
            ]);
        }
        
        Craft::create(["name" => "Kaligrafi Kelas 8",   "image" => "1.jpg",]);
        Craft::create(["name" => "Lukisan Kelas 9",     "image" => "2.jpg",]);
        Craft::create(["name" => "Sulam Kelas 7",       "image" => "3.jpg",]);
        
        $organizations = json_decode(File::get("database/data/organizations.json"));
        foreach ($organizations as $key => $value) {
            Organization::create([
                "name" => $value->name,
                "chairman" => $value->chairman,
                "vice_chairman" => $value->vice_chairman,
                "secretary" => $value->secretary,
                "treasurer" => $value->treasurer,
                "member" => $value->member,
            ]);
        }

        $instructors = json_decode(File::get("database/data/instructors.json"));
        foreach ($instructors as $key => $value) {
            Instructor::create([
                "name" => $value->name,
                "gender" => $value->gender,
                "level" => $value->level,
                "position" => $value->position,
            ]);
        }

    }
}
