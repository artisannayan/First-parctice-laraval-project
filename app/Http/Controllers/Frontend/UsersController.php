<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Division;
use App\Models\District;
use Auth;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
       $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $user = Auth::user();
        return view('frontend.pages.user.dashboard',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $divisions = Division::orderBy('priority','ASC')->get();
        $districts = District::orderBy('priority','ASC')->get();
        $user = Auth::user();
        return view('frontend.pages.user.profile',compact('user','divisions','districts'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profileUpadate(Request $request)
    {
        $user = Auth::user();
        // $this->validate($request,[
        //  'first_name'   => 'required|string|max:30',
        //  'last_name'    => 'required|string|max:30',
        //   'usernmae'    => 'required|alpha_dash|max:100|unique:users,username,' .$user->id,
        //   'email'       => 'required|string|email|max:100|unique:users,email,' .$user->id,
        //   'division_id' => 'required|numeric',
        //   'district_id' => 'required|numeric',
        //   'phone'       => 'required|max:15|unique:users,phone,'.$user->id,
        //   'address'   => 'required|string|max:100',

        // ]);
        $user->first_name       = $request->first_name;
        $user->last_name        = $request->last_name;
        $user->username         = $request->username;
        $user->email            = $request->email;
        $user->division_id      = $request->division_id;
        $user->district_id      = $request->district_id;
        $user->phone            = $request->phone;
        $user->address          = $request->address;
        $user->shipping_address = $request->shipping_address;

        if($request->password != NULL || $request->password != ""){
            $user->password = Hash::make($request->password);
        }
       $user->ip_address = request()->ip();
       $user->save();
       return back()->with('msg','User Profile Successfully !!!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
