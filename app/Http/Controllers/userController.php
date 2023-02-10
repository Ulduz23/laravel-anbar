<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\userRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class userController extends Controller
{
    
    public function register(userRequest $post){

    $con = new User();

    $yoxla = User::where('email','=', $post->email)->orwhere('password','=',$post->password)->count();

    if($yoxla==0)
    {
        $con->foto = 'https://t3.ftcdn.net/jpg/04/34/72/82/360_F_434728286_OWQQvAFoXZLdGHlObozsolNeuSxhpr84.jpg';
        $con->blok = 0;
        $con->name = $post->name;
        $con->surname = $post->surname;
        $con->telefon = $post->telefon;

        $con->email = $post->email;
        $con->password = Hash::make($post->password);

        $con->save();
        return redirect()->route('login')->with('success','Qeydiyyat ugurla tamamlandi');
    }
    return back()->with('warning','Bu istifadeci artiq movcuddur!');

    }

    public function login(Request $post){

        $this->validate($post,[
            'email'=>'email|required',
            'password'=>'required'

        ]);

        if(!Auth::attempt(['email'=>$post->email,'password'=>$post->password,'blok'=>0]))
        {return back()->with('error','Daxil etdiyiniz login ve ya parol yanlishdir');}

    return redirect()->route('hesabla');
    }

    public function logout(){
        auth()->logout();
        return redirect()->route('daxilol');
    }
}