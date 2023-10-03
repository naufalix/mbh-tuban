<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminProgram extends Controller
{

    public function index(){
        return view('admin.program',[
            "title" => "Admin | Program",
            "programs" => Program::all(),
        ]);
    }

    public function postHandler(Request $request){
        if($request->submit=="store"){
            $res = $this->store($request);
            return redirect('/admin/program')->with($res['status'],$res['message']);
        }
        if($request->submit=="update"){
            $res = $this->update($request);
            return redirect('/admin/program')->with($res['status'],$res['message']);
        }
        if($request->submit=="destroy"){
            $res = $this->destroy($request);
            return redirect('/admin/program')->with($res['status'],$res['message']);
            // return redirect('/admin/program')->with("info","Fitur hapus sementara dinonaktifkan");
        }
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name'=>'required',
            'body'=>'required',
        ]);
        
        //Create program
        Program::create($validatedData);
        return ['status'=>'success','message'=>'Program berhasil ditambahkan'];
    }

    public function update(Request $request){
        $validatedData = $request->validate([
            'id'=>'required|numeric',
            'name'=>'required',
            'body'=>'required',
        ]);
        
        $program = Program::find($request->id);

        //Check if the program is found
        if($program){
            
            //Update program
            $program->update($validatedData);
            return ['status'=>'success','message'=>'Program berhasil diupdate'];
            
        }else{
            return ['status'=>'error','message'=>'Program tidak ditemukan'];
        }
    }

    public function destroy(Request $request){
        
        $validatedData = $request->validate([
            'id'=>'required|numeric',
        ]);

        $program = Program::find($request->id);

        //Check if the program is found
        if($program){
            
            //Delete program
            Program::destroy($request->id);
            return ['status'=>'success','message'=>'Program berhasil dihapus'];
        
        }else{
            return ['status'=>'error','message'=>'Program tidak ditemukan'];
        }
    }
}
