<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Craft;
use Illuminate\Http\Request;

class AdminCraft extends Controller
{

    public function index(){
        return view('admin.craft',[
            "title" => "Admin | Karya",
            "crafts" => Craft::all(),
        ]);
    }

    public function postHandler(Request $request){
        if($request->submit=="store"){
            $res = $this->store($request);
            return back()->with($res['status'],$res['message']);
        }
        if($request->submit=="update"){
            $res = $this->update($request);
            return back()->with($res['status'],$res['message']);
        }
        if($request->submit=="destroy"){
            $res = $this->destroy($request);
            return back()->with($res['status'],$res['message']);
        }
        else{
            return back()->with("info","Submit not found");
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
            $validatedData['image'] = time().".png";
            $request->file('image')->move(public_path('assets/images/craft'), $validatedData['image']);
            
            // Create craft
            Craft::create($validatedData);
            return ['status'=>'success','message'=>'Karya berhasil ditambahkan'];
            
        }else{
            return ['status'=>'error','message'=>'Gambar wajib diisi'];
        }  
    }

    public function update(Request $request){
        $validatedData = $request->validate([
            'id'    => 'required|numeric',
            'name'  => 'required',
            'image' => 'image|file|max:1024',
        ]);
        
        $craft = Craft::find($request->id);

        //Check if the craft is found
        if($craft){    
                
            //Check if has image
            if($request->file('image')){

                // Delete old image
                $image_path = public_path().'/assets/images/craft/'.$craft->image;
                unlink($image_path);
                
                // Upload new image
                $validatedData['image'] = time().".png";
                $request->file('image')->move(public_path('assets/images/craft'), $validatedData['image']);
                
                $craft->update($validatedData);
                return ['status'=>'success','message'=>'Karya berhasil diupdate'];
                
            }else{
                // Update data
                $craft->update($validatedData);    
                return ['status'=>'success','message'=>'Karya berhasil diedit'];
            }
                
        }else{
            return ['status'=>'error','message'=>'Karya tidak ditemukan'];
        }
    }

    public function destroy(Request $request){
        
        $validatedData = $request->validate([
            'id'=>'required|numeric',
        ]);

        $craft = Craft::find($request->id);

        //Check if the craft is found
        if($craft){
            $image_path = public_path().'/assets/images/craft/'.$craft->image;
            unlink($image_path);
            Craft::destroy($request->id);
            return ['status'=>'success','message'=>'Karya berhasil dihapus'];
        }else{
            return ['status'=>'error','message'=>'Karya tidak ditemukan'];
        }
    }
}
