<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class AdminGallery extends Controller
{

    public function index(){
        return view('admin.gallery',[
            "title" => "Admin | Galeri",
            "galleries" => Gallery::all(),
        ]);
    }

    public function postHandler(Request $request){
        //dd($request);
        if($request->submit=="store"){
            $res = $this->store($request);
            return redirect('/admin/gallery')->with($res['status'],$res['message']);
        }
        if($request->submit=="update"){
            $res = $this->update($request);
            return redirect('/admin/gallery')->with($res['status'],$res['message']);
        }
        if($request->submit=="destroy"){
            $res = $this->destroy($request);
            return redirect('/admin/gallery')->with($res['status'],$res['message']);
            // return redirect('/admin/gallery')->with("info","Fitur hapus sementara dinonaktifkan");
        }
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name'  => 'required',
            'image' => 'image|file|max:1024',
        ]);

        //Check if has image
        if($request->file('image')){
                
            // Upload new image
            $validatedData['image'] = time().".jpg";
            $request->file('image')->move(public_path('assets/images/gallery'), $validatedData['image']);
            
            // Create gallery
            Gallery::create($validatedData);
            return ['status'=>'success','message'=>'Foto berhasil ditambahkan'];
            
        }else{
            return ['status'=>'error','message'=>'Foto wajib diisi'];
        }  
    }

    public function update(Request $request){
        $validatedData = $request->validate([
            'id'    => 'required|numeric',
            'name'  => 'required',
            'image' => 'image|file|max:1024',
        ]);
        
        $gallery = Gallery::find($request->id);

        //Check if the gallery is found
        if($gallery){    
                
            //Check if has image
            if($request->file('image')){

                // Delete old image
                $image_path = public_path().'/assets/images/gallery/'.$gallery->image;
                unlink($image_path);
                
                // Upload new image
                $validatedData['image'] = time().".jpg";
                $request->file('image')->move(public_path('assets/images/gallery'), $validatedData['image']);
                
                $gallery->update($validatedData);
                return ['status'=>'success','message'=>'Galeri berhasil diupdate'];
                
            }else{
                // Update data
                $gallery->update($validatedData);    
                return ['status'=>'success','message'=>'Galeri berhasil diedit'];
            }
                
        }else{
            return ['status'=>'error','message'=>'Galeri tidak ditemukan'];
        }
    }

    public function destroy(Request $request){
        
        $validatedData = $request->validate([
            'id'=>'required|numeric',
        ]);

        $gallery = Gallery::find($request->id);

        //Check if the gallery is found
        if($gallery){
            $image_path = public_path().'/assets/images/gallery/'.$gallery->image;
            unlink($image_path);
            Gallery::destroy($request->id);
            return ['status'=>'success','message'=>'Galeri berhasil dihapus'];
        }else{
            return ['status'=>'error','message'=>'Galeri tidak ditemukan'];
        }
    }
}
