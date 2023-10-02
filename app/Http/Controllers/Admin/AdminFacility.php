<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;

class AdminFacility extends Controller
{

    public function index(){
        return view('admin.facility',[
            "title" => "Admin | Fasilitas",
            "facilities" => Facility::all(),
        ]);
    }

    public function postHandler(Request $request){
        //dd($request);
        if($request->submit=="store"){
            $res = $this->store($request);
            return redirect('/admin/facility')->with($res['status'],$res['message']);
        }
        if($request->submit=="update"){
            $res = $this->update($request);
            return redirect('/admin/facility')->with($res['status'],$res['message']);
        }
        if($request->submit=="destroy"){
            $res = $this->destroy($request);
            return redirect('/admin/facility')->with($res['status'],$res['message']);
            // return redirect('/admin/facility')->with("info","Fitur hapus sementara dinonaktifkan");
        }
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name'=>'required',
            'image' => 'image|file|max:1024',
        ]);

        //Check if has image
        if($request->file('image')){
                
            // Upload new image
            $validatedData['image'] = time().".png";
            $request->file('image')->move(public_path('assets/images/facility'), $validatedData['image']);
            
            // Create facility
            Facility::create($validatedData);
            return ['status'=>'success','message'=>'Fasilitas berhasil ditambahkan'];
            
        }else{
            return ['status'=>'error','message'=>'Gambar tidak boleh kosong'];
        }

        
    }

    public function update(Request $request){
        $validatedData = $request->validate([
            'id'=>'required|numeric',
            'name'=>'required',
        ]);
        
        $facility = Facility::find($request->id);

        //Check if the facility is found
        if($facility){   
    
                //Check if has image
                if($request->file('image')){
                        
                    $validatedData = $request->validate([
                        'id'=>'required|numeric',
                        'name'=>'required',
                        'image' => 'image|file|max:1024',
                    ]);

                    // Delete old image
                    $image_path = public_path().'/assets/images/facility/'.$facility->image;
                    unlink($image_path);
                    
                    // Upload new image
                    $validatedData['image'] = time().".png";
                    $request->file('image')->move(public_path('assets/images/facility'), $validatedData['image']);
                    
                    $facility->update($validatedData);
                    return ['status'=>'success','message'=>'Fasilitas berhasil diupdate'];
                    
                }else{
                    // Update data
                    $facility->update($validatedData);    
                    return ['status'=>'success','message'=>'Fasilitas berhasil diedit'];
                }
            
        }else{
            return ['status'=>'error','message'=>'Fasilitas tidak ditemukan'];
        }
    }

    public function destroy(Request $request){
        
        $validatedData = $request->validate([
            'id'=>'required|numeric',
        ]);

        $facility = Facility::find($request->id);

        //Check if the facility is found
        if($facility){
            $image_path = public_path().'/assets/images/facility/'.$facility->image;
            unlink($image_path);
            Facility::destroy($request->id);
            return ['status'=>'success','message'=>'Fasilitas berhasil dihapus'];
        }else{
            return ['status'=>'error','message'=>'Fasilitas tidak ditemukan'];
        }
    }
}
