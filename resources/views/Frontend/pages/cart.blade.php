
@extends('Frontend.layouts.maintemplate')

@section('bodycontent')
<div class="container">
    <div class="row">
      <div class="col-md-12">
       <ul class="breadcrumb">
        <li><a href="" <i class="fa fa-home"></i></a></li>
        <li><a href="">Cart page</a></li>
       </ul>
      </div>
    </div>
    <div class="row">
        <div class="col-md-12">
        <h2>Carts Page</h2>


              <table class="table table-striped table-bordered">
                <thead class="thead-dark ">
                  <tr>
                    <th scope="col">Sl No.</th>
                    <th scope="col">Product Title</th>
                    <th scope="col">Product Iamge</th>
                    <th scope="col">Product Quantity</th>
                     <th scope="col">Price</th> 
                     <th scope="col">Total parice</th> 
                    <th scope="col"> Delete</th>
                  </tr>
                </thead>
                <tbody>
                  @php 
                  $total_price = 0;
                  @endphp
                  @foreach (App\Models\Cart::totalCarts() as $cart )
                  <tr>
                  <th scope="row">{{ $loop->index + 1}}</th>
                  <td><a href="{{ route('products.show',$cart->product->id) }}">{{ $cart->product->slug }}</a></td>
                        <td> @if($cart->product->images->count() > 0) 
                        <img src="{{ asset('image/product-image/'.$cart->product->images->first()->image ) }}" width="120">
                        @endif
                        </td>
                        
                        <td> 
                           <form action="{{ route('carts.update', $cart->id)}}" method="POST">
                                @csrf
                            <input type="number" name="product_quantity" class="form-control" value="{{ $cart->product_quantity }}">
                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                          </form>
                        </td>
                        <td>
                          {{ $cart->product->price }} Taka
                        </td>
                        <td>
                        @php 
                          $total_price += $cart->product->price * $cart->product_quantity;
                          @endphp
                          {{ $cart->product->price * $cart->product_quantity }} Taka
                        </td>
                      <td><form action="{{ route('carts.destroy',$cart->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="cart_id" >
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                          </form>
                        </td>
                      </tr>
                  @endforeach
                  <tr>
                    <td colspan="4"></td>
                    <td colspan="2">
                     <strong> Total Amount:</strong>
                    </td>
                    <td>
                       <strong>{{ $total_price }} Taka</strong>
                    </td>
                  </tr>
                  <!--Proseed to Check out-->
                  <tr>
                      <td colspan="4"></td>
                      <td colspan="1"></td>
                      <td colspan="2">
                      <a href="{{ route('products')}}" class="btn btn-dark" style="float:right">More Items</a>
                      <a href="{{ route('chekouts')}}" class="btn btn-dark" style="float:right">Proceed To Check Out</a>
                      </td>
                    </tr>
                </tbody>
              </table>
              
              
             
        </div>
    </div>
</div>
@endsection