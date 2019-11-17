
@extends('Frontend.layouts.maintemplate')

@section('bodycontent')
<div class="container">
  <ul class="breadcrumb">
    <li><a href="index.html"><i class="fa fa-home"></i></a></li>
    <li><a href="{{ route('carts') }}">Change Cart Items</a></li>
    <li><a href="login.html">Checkuts</a></li>
  </ul>
     <div class="row">
        {{-- @include('Backend.allinfo.message') --}}
       
          <div class="col-md-12">
              <div class="card-body">   
                  <table class="table">
                     <thead class="thead-dark">
                  <tr>
                    <th scope="col">Sl</th>
                    <th scope="col">Product Title</th>
                    <th scope="col">Total Quantity</th>
                    <th scope="col">Total Price</th>
                  </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1; 
                 @endphp
                 @foreach (App\Models\Cart::totalCarts() as $cart )
               
                  <tr>
                  <th scope="row">{{ $i++}}</th>
                    <td>{{ $cart->product->title }}</td>
                    <td>{{ $cart->product_quantity }} Pcs</td>
                    <td><b>{{ $cart->product->price}}</b> BDT</td>
                  </tr>
                 @endforeach

               
                </tbody>
              </table> 
              <div>
                    <div class="card" style="float:right;width:33rem;">
                      <div class="card-body">
                         <h5 class="card-title">Total Amount</h5>
                         @php 
                         $total_price = 0;
                         @endphp
                         @foreach ( App\Models\Cart::totalCarts() as $cart )
                             @php
                                $total_price += $cart->product->price  * $cart->product_quantity;
                             @endphp  
                         @endforeach
                      Total Price: <strong>{{ $total_price }}</strong><br>
                      Total Price With Shipping Cost:<strong>{{ $total_price + App\Models\Setting::first()->shipping_cost  }}</strong>
                      </div>
                  </div>
              </div>
            </div>
          </div>    
     </div>
     <div class="row">
        <h1 style="text-align:center;"> Your Shipping Address</h1>
        @if(Session()->has("msg"))
        <div class="alert alert-danger" role="alert">
            {{ Session()->get("msg") }}
        </div>
    @endif
        <div class="col-md-6">
           
        <form action="{{ route('chekouts.store')}}" method="POST">
              @csrf
              <div class="form-group">
                <label>Recever name</label>
                 <input type="text" name="name" class="form-control" value="{{ Auth::check()? Auth::user()->first_name.''.Auth::user()->last_name: '' }}"  required autofucas>
              </div>
              
                <div class="form-group">
                    <label>Email</label>
                <input type="email" name="email" class="form-control"  value="{{ Auth::check() ? Auth::user()->email : '' }}"  required autofucas>
                  </div>
                  <div class="form-group">
                      <label>Phone</label>
                    <input type="text" name="phone_no" class="form-control" value="{{ Auth::check() ? Auth::user()->phone : '' }}"  required autofucas>
                 </div>
                 <div class="form-group">
                        <label>Shipping Address</label>
                        <textarea name="shipping_address" class="form-control"> {{ Auth::check() ? Auth::user()->shipping_address : '' }} </textarea>
                  </div>
                  <div class="form-group">
                    <label> Message (Optional)</label>
                    <textarea name="message" class="form-control">  </textarea>
                  </div>
                  <div class="form-group">
                      <label>Payment Method</label>
                       <select class="form-control" name="payment_method" required="required" id="payments">
                        <option>Select a Payment Method form the Below List</option>
                        @foreach ( $payments as $payment )
                           <option value="{{ $payment->short_name }}">{{ $payment->name }}</option>
                        @endforeach
                       </select>
                       @foreach ( $payments as $payment )
                     
                                @if($payment->short_name == 'cash_in')
                               <div id="payments_{{ $payment->short_name }}" class="hidden">
                                <div class="alert alert-success">
                                  <h3>For Cash in there is Noting nesessary. Just Click Finish Order</h3>
                                  <small>
                                    You will get your product in two or there bussiness days.
                                  </small>
                                </div>
                              </div>
                               @else
                               
                               <div id="payments_{{ $payment->short_name }}" class="hidden">
                                <div class="alert alert-success">
                               <p>
                               <strong>{{ $payment->name }} No:{{ $payment->payment_no}}</strong>
                               <br>
                               <strong>Account Type:{{ $payment->payment_type }}</strong>
                               </p>
                                Please send above mony to this Bkash No and write youer code below there...
                              </div>
                           </div>
                           @endif
                       @endforeach
                      <input type="text" name="transaction_id" id="transaction_id" class="form-control hidden" placeholder="Please Enter Transaction Id">
                  
                  <div class="form-group">
                        <button type="submit" class="btn btn-default">Order Now</button>
                  </div>
             </form>
         </div>
        <!--Payment Method Datiles-->
        <div class="col-md-6">
            <h4> Payment Datails</h4>
        </div>
     </div>
  </div>

@endsection

@section('scripts')
<script type="text/javascript">
  $("#payments").change(function(){
    $payment_method = $("#payments").val();
    if($payment_method == "cash_in"){
      $("#payments_cash_in").removeClass("hidden");
      $("#payments_bkash").addClass("hidden");
      $("#payments_rokect").addClass("hidden");
      
    }else if($payment_method == "bkash"){
      $("#payments_bkash").removeClass("hidden");
      $("#payments_cash_in").addClass("hidden");
      $("#payments_rokect").addClass("hidden");
      $("#transaction_id").removeClass("hidden");
     }else if($payment_method == "rokect"){
      $("#payments_rokect").removeClass("hidden");
      $("#payments_cash_in").addClass("hidden");
      $("#payments_bkash").addClass("hidden");
      $("#transaction_id").removeClass("hidden");
    }
 
  
  });
</script>
@endsection