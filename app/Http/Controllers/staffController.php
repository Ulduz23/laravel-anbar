<?php

namespace App\Http\Controllers;

use App\Http\Requests\staffRequest;
use App\Models\staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class staffController extends Controller
{
    
    public function insert(staffRequest $post)
    {
        $con = new staff();

        $post->validate([
            'foto' => 'required|image|mimes:jpg,png,jpeg,gij,svg|max:2048',

        ]);

        if($post->file('foto'))
        {
        $file = time().'.'.$post->foto->extension();

        $post->foto->storeAs('public/uploads/fotolar/',$file);

        $con->foto = 'storage/uploads/fotolar/'.$file;

        $con->name = $post->name;
        $con->surname = $post->surname;
        $con->telefon = $post->telefon;
        $con->email = $post->email;
        $con->istarix = $post->istarix;
        $con->salary = $post->salary;
        $con->job = $post->job;
        $con->user_id = Auth::id();

        $con -> save();

        return redirect()->route('isselect')->with('success','İşçi daxil edildi!');

        }
    
}

public function select(){
    
    $data = staff::orderBy('id','desc')        
    ->where('user_id','=',Auth::id())
    ->get();

    return view('staff',[
        'list'=>$data,
    ]);
}

public function sil($id){

    $sildata = staff::find($id); 
    $data = staff::orderBy('id','desc')        
    ->where('user_id','=',Auth::id())
    ->get();

    return view('staff',[
        'list'=>$data,
        'sildata'=>$sildata
    ]);

}


public function delete($id)
{
    
   $sil = staff::find($id)->delete(); //where('id', '=' , $id)
   
   return redirect()->route('isselect')->with('success','İşçi silindi :(');
   
}

public function edit($id){
    $editdata = staff::find($id); //where('id', '=' , $id)
    $data = staff::orderBy('id','desc')        
    ->where('user_id','=',Auth::id())
    ->get();


    
    return view('staff',[
        'list'=>$data,
        'editdata'=>$editdata
    ]);
}

public function update(staffRequest $post)
    {
    
        $con = staff::find($post->id);

        $post->validate([
            'foto' => 'image|mimes:jpg,png,jpeg,gij,svg|max:2048',

        ]);

        if($post->file('foto'))
        {
        $file = time().'.'.$post->foto->extension();

        $post->foto->storeAs('public/uploads/fotolar/',$file);

        $con->foto = 'storage/uploads/fotolar/'.$file;
        }
        else
        {$con->foto = $con->foto;}

        $con->name = $post->name;
        $con->surname = $post->surname;
        $con->telefon = $post->telefon;
        $con->email = $post->email;
        $con->istarix = $post->istarix;
        $con->salary = $post->salary;
        $con->job = $post->job;

        $con->user_id = Auth::id();

        $con -> save();

        return redirect()->route('isselect')->with('success','Işçi daxil edildi!');

        }



}