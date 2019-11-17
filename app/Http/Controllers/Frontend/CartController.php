<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Order;
use App\Models\Cart;
use Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Frontend.pages.cart');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     $this->validate($request,[
      'product_id'=> 'required',

     ],
     [
         'product_id.required' => 'Pleast Choose Your Product'
     ]);
//Check Cart Quanrtiy browser 
      if(Auth::check() )
      {
        $cart = Cart::where('user_id', Auth::id())->where('product_id',$request->product_id)->first();
       }else{
         $cart = Cart::where('ip_address', request()->ip() )->where('product_id', $request->product_id)->first();
      }

//Store Cart product Quantiry item
     
     
       if(!is_null($cart)){
          $cart->increment('product_quantity');
       }
       else
       {
        $cart = new Cart();
        if(Auth::check() )

        {
         $cart->user_id = Auth::id();
        }

        $cart->ip_address = request()->ip();
        $cart->product_id = $request->product_id;
        $cart->save();
       }
         session()->flush('Success','Product Added Successfully');
         return  back();
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
        $cart = Cart::find($id);
        if(!is_null($cart) )
        {
            $cart->product_quantity = $request->product_quantity;
            $cart->save();
        }else{
            return redirect()->route('carts');
            
        }
            session()->flush('Succcess','Cart  Item Update Success');
            return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carts = Cart::find($id);
        if(!is_null($carts) ){
        $carts->delete();
        }
        return back();
    }
}
