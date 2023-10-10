<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminOrganization extends Controller
{

    public function index(){
        return view('admin.organization',[
            "title" => "Admin | Struktur Organisasi",
            "organizations" => Organization::all(),
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
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name'=>'required',
            'chairman'=>'required',
            'vice_chairman'=>'required',
            'secretary'=>'required',
            'treasurer'=>'required',
            'member'=>'required',
        ]);
        
        //Create organization
        Organization::create($validatedData);
        return ['status'=>'success','message'=>'Struktur organisasi berhasil ditambahkan'];
    }

    public function update(Request $request){
        $validatedData = $request->validate([
            'id'=>'required|numeric',
            'name'=>'required',
            'chairman'=>'required',
            'vice_chairman'=>'required',
            'secretary'=>'required',
            'treasurer'=>'required',
            'member'=>'required',
        ]);
        
        $organization = Organization::find($request->id);

        //Check if the organization is found
        if($organization){
            
            //Update organization
            $organization->update($validatedData);
            return ['status'=>'success','message'=>'Struktur organisasi berhasil diupdate'];
            
        }else{
            return ['status'=>'error','message'=>'Struktur organisasi tidak ditemukan'];
        }
    }

    public function destroy(Request $request){
        
        $validatedData = $request->validate([
            'id'=>'required|numeric',
        ]);

        $organization = Organization::find($request->id);

        //Check if the organization is found
        if($organization){
            
            //Delete organization
            Organization::destroy($request->id);
            return ['status'=>'success','message'=>'Struktur organisasi berhasil dihapus'];
        
        }else{
            return ['status'=>'error','message'=>'Struktur organisasi tidak ditemukan'];
        }
    }
}
