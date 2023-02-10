<?php

namespace App\Http\Controllers;

use App\Http\Requests\userRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class profileController extends Controller
{
    public function index(){
        return view('profile');
    }

     
    public function profile(userRequest $post){
        
        $con = User::find(Auth::id());

        if(Hash::check($post->password, $con->password)){

            $yoxla = User::where('id','!=',$post->id)->count();

                if($yoxla==0){                   
                    $post->validate([
                    'foto' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:4096',
                    ]);
                }
                
                    if($post->file('foto')){
                        
                        $file = time().'.'.$post->foto->extension();
                        $post->foto->storeAs('public/uploads/fotolar/',$file);
                        $con->foto = 'storage/uploads/fotolar/'.$file;
                    }
                    else{
                        $con->foto = $con->foto;
                    }

                    if(empty($post->newpass))
                    {$con->password = Hash::make($post->password);}
                    else{$con->password = Hash::make($post->newpass);}

            $con->name = $post->name;
            $con->surname = $post->surname;
            $con->email = $post->email;
            
            $con->save();
            
            return redirect()->route('myprofile')->with('success','Profiliniz yeniləndi');
        }
        return redirect()->route('myprofile')->with('error','Cari Şifrə yanlışdır');
    }



    public function sil($id)
    {
        
       $sildata = User::find(Auth::id()); //where('id', '=' , $id)


        return view('profile',[
            'sildata'=>$sildata,
        ]);
    }

     
    public function delete(Request $post)
    {
        
       User::find(Auth::id())->delete(); //where('id', '=' , $id)
       
       return redirect()->route('login')->with('success','Profiliniz silindi');
       
    }

}
