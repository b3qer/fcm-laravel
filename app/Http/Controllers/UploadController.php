<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
// use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response;

class UploadController extends Controller
{
    public function index(){
        $files = File::all();
        return view('index',['files'=>$files]);
    }

    public function store(Request $request ){
       
        $file = $request['file'];
        $ex = $file->getClientOriginalExtension();
        $name = $request['name'].".".$ex;
        
        $file->Move('files',$name);
        File::Create([
            'name' => $request['name'],
            'file' => 'files/'.$name
        ]);
        return  redirect()->back();

    }
    public function download(Request $request ){
       $check = File::where('name',$request['name'])->first();
       if ($check['delete'] != false){
        return redirect()->route('download',$request->name);
       }
       else {
        exit('The file does not exist!');
       }
      
    }
   
}
