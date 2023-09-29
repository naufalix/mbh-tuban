<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminPost extends Controller
{

    public function index(){
        return view('admin.post',[
            "title" => "Admin | Posts",
            "posts" => Post::all(),
        ]);
    }

    public function postHandler(Request $request){
        //dd($request);
        if($request->submit=="store"){
            $res = $this->store($request);
            return redirect('/admin/post')->with($res['status'],$res['message']);
        }
        if($request->submit=="update"){
            $res = $this->update($request);
            return redirect('/admin/post')->with($res['status'],$res['message']);
        }
        if($request->submit=="destroy"){
            $res = $this->destroy($request);
            return redirect('/admin/post')->with($res['status'],$res['message']);
            // return redirect('/admin/post')->with("info","Fitur hapus sementara dinonaktifkan");
        }
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'title'=>'required',
            'slug'=>'required',
            'body'=>'required',
        ]);

        //Check if has image
        if($request->file('image')){
                
            $validatedData = $request->validate([
                'title'=>'required',
                'slug'=>'required',
                'body'=>'required',
                'image' => 'image|file|max:512',
            ]);

            // Upload new image
            $validatedData['image'] = time().".png";
            $request->file('image')->move(public_path('assets/images/post'), $validatedData['image']);
            
            if(!Post::whereSlug($request->slug)->first()){
                Post::create($validatedData);
                return ['status'=>'success','message'=>'Postingan berhasil ditambahkan'];
            }else{
                return ['status'=>'error','message'=>'Judul telah terpakai'];
            }
        }else{
            if(!Post::whereSlug($request->slug)->first()){
                Post::create($validatedData);
                return ['status'=>'success','message'=>'Postingan berhasil ditambahkan'];
            }else{
                return ['status'=>'error','message'=>'Judul telah terpakai'];
            }
        }

        
    }

    public function update(Request $request){
        $validatedData = $request->validate([
            'id'=>'required|numeric',
            'name'=>'required',
            'province_id'=>'required|numeric',
            'cities'=>'required',
            'slug'=>'required',
            'show'=>'required',
            'sort'=>'required',
        ]);
        
        $region = Region::find($request->id);

        //Check if the region is found
        if($region){
            
            // Check if the slug is different from before
            if($region->slug!=$request->slug){
                
                // Check if the slug has not been used
                if(!Region::whereSlug($request->slug)->first()){

                    //Check if has image
                    if($request->file('image')){
                            
                        $validatedData = $request->validate([
                            'id'=>'required|numeric',
                            'name'=>'required',
                            'province_id'=>'required|numeric',
                            'cities'=>'required',
                            'slug'=>'required',
                            'show'=>'required',
                            'sort'=>'required',
                            'image' => 'mimes:webp|file|max:512',
                        ]);

                        // Replace new image
                        $validatedData['image'] = $request->slug.".webp";
                        $request->file('image')->move(public_path('assets/img/region'), $validatedData['image']);
                        
                        $region->update($validatedData);
                        return ['status'=>'success','message'=>'Region berhasil diupdate'];
                        
                    }else{
                        // Update data
                        $region->update($validatedData);    
                        return ['status'=>'success','message'=>'Region berhasil diedit'];
                    }
                }else{
                    return ['status'=>'error','message'=>'Slug telah terpakai'];
                }
            }else{
                
                //Check if has image
                if($request->file('image')){
                            
                    $validatedData = $request->validate([
                        'id'=>'required|numeric',
                        'name'=>'required',
                        'province_id'=>'required|numeric',
                        'cities'=>'required',
                        'slug'=>'required',
                        'show'=>'required',
                        'sort'=>'required',
                        'image' => 'mimes:webp|file|max:512',
                    ]);

                    // Replace new image
                    $validatedData['image'] = $request->slug.".webp";
                    $request->file('image')->move(public_path('assets/img/region'), $validatedData['image']);
                    
                    $region->update($validatedData);
                    return ['status'=>'success','message'=>'Region berhasil diupdate'];
                    
                }else{
                    // Update data
                    $region->update($validatedData);    
                    return ['status'=>'success','message'=>'Region berhasil diedit'];
                }
            }
        }else{
            return ['status'=>'error','message'=>'Region tidak ditemukan'];
        }
    }

    public function destroy(Request $request){
        
        $validatedData = $request->validate([
            'id'=>'required|numeric',
        ]);

        $region = Region::find($request->id);

        //Check if the region is found
        if($region){
            $image_path = public_path().'/assets/img/region/'.$region->slug.'.webp';
            unlink($image_path);
            Region::destroy($request->id);
            return ['status'=>'success','message'=>'Region berhasil dihapus'];
        }else{
            return ['status'=>'error','message'=>'Region tidak ditemukan'];
        }
    }
}
