<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Notifications\VarifyRegistration;

use App\Models\User;
use Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request)
    {

        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email',$request->email)->first();
        if($user->status == 1){
            //User login hobe
        if(Auth::guard('web')->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember_token)){                   
        return redirect()->intended(route('index'));
        }
        }else{ 
        //Send  him send token agin
        if(!is_null($user)){
         $user->notify(new VarifyRegistration($user));
            session()->flash('success', 'A Confirmation email has sent to you...Please Check and confirm your email');
           return redirect('/');
        }else{
            session()->flash('errors', 'Please Login First!!');
            return redirect()->route('login');
        }
        }
    }   
}
