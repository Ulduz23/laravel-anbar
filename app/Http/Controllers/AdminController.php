<?php

namespace App\Http\Controllers;

use App\Http\Requests\userRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class AdminController extends Controller
{

    public function insert(userRequest $post){

        $con = new User();
            
        if($post->password = $post->tpass)
        {       
            $con->foto = 'https://t3.ftcdn.net/jpg/04/34/72/82/360_F_434728286_OWQQvAFoXZLdGHlObozsolNeuSxhpr84.jpg';
            $con->name = $post->name;
            $con->surname = $post->surname;
            $con->telefon = $post->telefon;
            $con->email = $post->email;
            $con->password = Hash::make($post->password);
    
            $con -> save(); 
        
            return redirect()->route('adselect')->with('mesaj','Melumatlar ugurla daxil eildi!');
    
        }
    return redirect()->route('adselect')->with('mesaj','Parollar uste uste dusmur!');   
    }


    public function select()
    {
        $data = User::where ('id','!=',Auth::id())->orderBy('id','desc')->get();
        

        return view('admin',[
            'list'=>$data,

        ]);
    }


    public function sil($id)
    {
        $sildata = User::find($id); //where('id', '=' , $id)
    
        $data = User::where ('id','!=',Auth::id())->orderBy('id','desc')->get();

        return view('admin',[
            'list'=>$data,
            'sildata'=>$sildata,
        ]);
    }

    
    public function delete($id)
    { 
       $sil = User::find($id)->delete(); //where('id', '=' , $id)
       
       return redirect()->route('adselect')->with('mesaj','Kontakt ugurla silindi');
       
    }

    
    public function edit($id)
    {
        
        $editdata = User::find($id); //where('id', '=' , $id)
       
        $data = User::where ('id','!=',Auth::id())->orderBy('id','desc')->get();


        return view('admin',[
            'list'=>$data,
            'editdata'=>$editdata,

        ]);  
    }

    
    public function update(userRequest $post)
    {
        $con = User::find($post->id);
        
        if($post->password = $post->tpass)
        {       
            $con->foto = 'https://t3.ftcdn.net/jpg/04/34/72/82/360_F_434728286_OWQQvAFoXZLdGHlObozsolNeuSxhpr84.jpg';
            $con->name = $post->name;
            $con->surname = $post->surname;
            $con->telefon = $post->telefon;
            $con->email = $post->email;
            $con->password = Hash::make($post->password);
    
            $con -> save(); 
        
            return redirect()->route('adselect')->with('mesaj','Melumatlar ugurla yenilendi!');
    
        }
    return redirect()->route('adselect')->with('mesaj','Parollar uste uste dusmur!');   
    }

    public function blok($id)
    {
        $admin = User::find($id);
        $status= $admin->status;
        $admin->status = 0;

        $admin->save();

        return redirect()->route('adselect')->with('mesaj','Istifadeci bloklandi!');

    }

    public function noblok($id)
    {
        $admin = User::find($id);
        $status= $admin->status;
        $admin->status = 1;

        $admin->save();
        
        return redirect()->route('adselect')->with('mesaj','Istifadeci bloklu legv edildi!');

    }
}
