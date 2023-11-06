<?php

namespace App\Http\Controllers;

use App\Http\Requests\staffRequest;
use App\Http\Requests\staffdocRequest;
use App\Models\Staff;
use App\Models\Staffdoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffdocController extends Controller
{
    
    public function insert(staffdocRequest $post)
    {
        $con = new Staffdoc();

        $post->validate([
            'scan' => 'required|image|mimes:jpg,png,jpeg,gij,svg|max:2048',

        ]);

        if($post->file('scan'))
        {
        $file = time().'.'.$post->scan->extension();

        $post->scan->storeAs('public/uploads/fotolar/',$file);

        $con->scan = 'storage/uploads/fotolar/'.$file;

        $con->title = $post->title;
        $con->about = $post->about;
        $con->staf_id = $post->staf_id;

        $con->user_id = Auth::id();

        $con -> save();

        return back()->with('success','Document daxil edildi!');

        }
    
}

public function select($id){
    
    $data = Staffdoc::join('staff','staff.id','=','staffdocs.staf_id')      
    ->where('staffdocs.user_id','=',Auth::id())
    ->where('staffdocs.staf_id','=',$id)
    ->orderBy('staffdocs.id','desc')
    ->get();

    $sdata= Staff::where('user_id','=',Auth::id())->get();

    return view('staffdoc',[
        'list'=>$data,
        'sdata'=>$sdata,
        'staf_id'=>$id
    ]);
}



public function sil($id){

    $sildata = Staffdoc::find($id); 
    $data = Staffdoc::orderBy('id','desc')
    ->where('user_id','=',Auth::id())
    ->get();
    
    $sdata= Staff::where('user_id','=',Auth::id())->get();

    return view('staffdoc',[
        'list'=>$data,
        'sildata'=>$sildata,
        'sdata'=>$sdata,
        'staf_id'=>$id

    ]);

}


public function delete($id)
{  
   $sil = Staffdoc::find($id)->delete(); 
   
   return back()->with('success','Document silindi');
   
}

public function edit($id){
    $editdata = Staffdoc::find($id); 
    $data = Staffdoc::orderBy('staffdocs.id','desc')        
    ->where('user_id','=',Auth::id())
    ->get();

    $sdata= Staff::where('user_id','=',Auth::id())->get();


    return view('staffdoc',[
        'list'=>$data,
        'editdata'=>$editdata,
        'sdata'=>$sdata,
        'staf_id'=>$id

    ]);
}

public function update(staffdocRequest $post)
    {
    
        $con = Staffdoc::find($post->id);

        if($post->file('scan')){
        
        $file = time().'.'.$post->scan->extension();

        $post->scan->storeAs('public/uploads/fotolar/',$file);

        $con->scan = 'storage/uploads/fotolar/'.$file;
        }
        else
        {$con->scan = $con->scan;}

        $con->title = $post->title;
        $con->about = $post->about;
       
        $con->user_id = Auth::id();

        $con -> save();

        return back()->with('success','Document yeniləndi!');

        }


}
