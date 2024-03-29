<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\userRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerificationMail;
use App\Mail\SendMail;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;


class UserController extends Controller
{
    public function socialLogin($social){
        return Socialite::driver($social)->stateless()->redirect();
    }

    public function handleProviderCallback($social){
        $userSocial = Socialite::driver($social)->stateless()->user();
        $user = User::where(['email' => $userSocial->getEmail()])->first();
        if ($user) {
            Auth::login($user);
            return redirect()->route('hesabla');
        } else {
            $newUser = new User();
            $newUser->name = $userSocial->name;
            $newUser->surname = $userSocial->family_name ?? null;
            $newUser->email = $userSocial->getEmail();
            $newUser->foto = $userSocial->getAvatar() ?? null;

            $newUser->email_verification_code = '';
            $newUser->status = 1;

            $newUser->save();
            
            Auth::login($newUser);
            
            return redirect()->route('hesabla');
        }
    }
    


    public function register(userRequest $post){

    $con = new User();
    $this->validate($post, [
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:5',
    ],[
        'required' => __('Fill in the required fields'),
        'confirm-password.same' => __('Password confirmation does not match')
    ]);
    // $yoxla = User::where('email','=', $post->email)->orwhere('password','=', $post->pasword)->count();

    // if($yoxla==0)
    // {
        $con->foto = 'https://t3.ftcdn.net/jpg/04/34/72/82/360_F_434728286_OWQQvAFoXZLdGHlObozsolNeuSxhpr84.jpg';
        $con->name = $post->name;
        $con->surname = $post->surname;
        $con->telefon = $post->telefon;

        $con->email = $post->email;
        $con->password = Hash::make($post->password);
        $con->email_verification_code = Str::random(40);

        $data=[];
        $data['email_name']='Anbar.az';
        $data['subject']='Email verification';
        $data['text']='Emailniz tesdiqleyin';
        $data['link']=env('APP_URL').'/user-verification/'.$con->email_verification_code;
        Mail::to($con->email)->send(new SendMail($data));
        
        $con->save();


        return redirect()->route('daxilol')->with('success','Qeydiyyat tammalandi zenhmet olmasa emailinizi yoxlayin!');
    // }
    // return back()->with('warning','Bu istifadeci artiq movcuddur!');

    }

    public function user_verification(Request $request){
        $verification = $request->verification;

        try {
            DB::beginTransaction();

            $user_verification = User::where('email_verification_code', $verification)->first();

            if ($user_verification && $user_verification->status == NULL) {
                
                $user_verification->email_verification_code = "";
                $user_verification->status = 1;

                $user_verification->save();

                DB::commit();
                return redirect()->route('daxilol')->with('success', 'Emailiniz təsdiqləndi, daxil olun!');

            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    public function login(Request $post){

        $this->validate($post,[
            'email'=>'email|required',
            'password'=>'required'

        ]);


        $statuslogin = User::where('email',$post->email)->where('status',1)->first();
        if(!$statuslogin){
            return back()->with('error','Bele bir email bazada yoxdur!');
        }

        if(!Auth::attempt(['email'=>$post->email,'password'=>$post->password]))
        {return back()->with('error','Daxil etdiyiniz login ve ya parol yanlishdir');}

    return redirect()->route('hesabla');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('daxilol');
    }

    public function verify_email($verification_email){
        $con = User::where('email_verification_code',$verification_email)->first();

        if(!$con){
            return redirect()->route('register')->with('error','Email yanlishdir');
        }
        else{
            if($con->email_verified_at)
            {
                return redirect()->route('register')->with('error','Email verified');
            }
            else{
                $con->update([
                    'email_verified_at'=>\Carbon\Carbon::now()
                ]);
                return redirect()->route('register')->with('success','Email succesfully verified');

            }
        }
    }

    
}
