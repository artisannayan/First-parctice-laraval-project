<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Payment;
use App\Models\Order;
use App\Models\Cart;
use Auth;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::orderBy('priority','ASC')->get();
         return view('Frontend.pages.checkout',compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    //    'name' => 'required',
    //     'phone_no'=> 'required',
    //    'shipping_address'=>'required',
       'payment_method'=> 'required'
     ]);

     $order = new Order();

     //chek transaction id  has given or not
    if($request->payment_method !='cash_in'){
           if($request->transaction_id == NULL || empty( $request->transaction_id )){
            //   session()->flash('error','Please give transaction id for your payment');
               return back()->with('msg','Please Give  Trnsaction Id for Your Payment');
           }
    }

    $order->name             = $request->name;
    $order->email            = $request->email;
    $order->phone_no         = $request->phone_no;
    $order->shipping_address = $request->shipping_address;
    $order->message          = $request->message;
    $order->transaction_id   = $request->transaction_id;
    $order->ip_address = request()->ip();
    if(Auth::check()){
        $order->user_id = Auth::id();
    }
     $order->payment_id = Payment::where('short_name',$request->payment_method)->first()->id;
     $order->save();
     foreach(  Cart::totalCarts() as $cart){
         $cart->order_id = $order->id;
         $cart->save();
     }
     return redirect()->route('index')->with('msg','Your Order SuccessFully please Wait admin will soon conform it');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
