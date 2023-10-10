<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminInstructor extends Controller
{

    public function index(){
        return view('admin.instructor',[
            "title" => "Admin | Tenaga pengajar",
            "instructors" => Instructor::all(),
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
            'gender'=>'required',
            'position'=>'required',
            'level'=>'required',
        ]);
        
        //Create instructor
        Instructor::create($validatedData);
        return ['status'=>'success','message'=>'Staff berhasil ditambahkan'];
    }

    public function update(Request $request){
        $validatedData = $request->validate([
            'id'=>'required|numeric',
            'name'=>'required',
            'gender'=>'required',
            'position'=>'required',
            'level'=>'required',
        ]);
        
        $instructor = Instructor::find($request->id);

        //Check if the instructor is found
        if($instructor){
            
            //Update instructor
            $instructor->update($validatedData);
            return ['status'=>'success','message'=>'Staff berhasil diupdate'];
            
        }else{
            return ['status'=>'error','message'=>'Staff tidak ditemukan'];
        }
    }

    public function destroy(Request $request){
        
        $validatedData = $request->validate([
            'id'=>'required|numeric',
        ]);

        $instructor = Instructor::find($request->id);

        //Check if the instructor is found
        if($instructor){
            
            //Delete instructor
            Instructor::destroy($request->id);
            return ['status'=>'success','message'=>'Staff berhasil dihapus'];
        
        }else{
            return ['status'=>'error','message'=>'Staff tidak ditemukan'];
        }
    }
}
