@extends('Backend.layouts.master')

@section('adminpagecontent')
   <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Upload New Product</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div>
          <div class="row">
          	 <div class="col-md-12">
          	 	<div class="card shadow mb-4">
          	 		<div class="card-hear py-3">
          	 		   <h6 class="m-0 font-weight-bold text-primary">Upload The Product With Informetion</h6>	
                      
                      
          	 		</div>
          	 		<div class="card-body">
          	 	             <form action="{{route('admin.product.createproduct')}}" method="POST" enctype="multipart/form-data">
          	 	        	    {{csrf_field()}}
                            @include('Backend.allinfo.message')
          	 				<div class="form-group"> 
          	 				   <label for="title">Title</label>
          	 				   <input type="text" name="title" class="form-control" placeholder="Product Title"> 	
          	 				</div>
          	 				<div class="form-group"> 
          	 				   <label for="desc">Description</label>
          	 				   <textarea class="form-control" name="desc" placeholder="Product Description"></textarea>	
          	 				</div>
          	 				<div class="form-group"> 
          	 				   <label for="quantity">Quantity</label>
          	 				   <input type="number" name="quantity" class="form-control" placeholder="Quantity"> 	
          	 				</div>

                    <div class="form-group"> 
                       <label for="quantity">Select Category</label>
                       <select class="form-control" name="catagory_id">
                         <option value="">Please Select Category for the Product </option>

                          @foreach(App\Models\cetagory::orderBy('name','asc')->where('parent_id',NULL)->get() as $parent)

                           <option value=" {{ $parent->id }} "> {{ $parent->name }} </option>
                          
                          @foreach(App\Models\cetagory::orderBy('name','asc')->where('parent_id',$parent->id)->get() as $child)
                          <option value="{{$child->id}}">-->{{$child->name}}</option>
                          @endforeach

                          @endforeach
                       </select>  
                    </div>
                   
                     <div class="form-group">
                         <label for="brand">Select Brand</label>
                         <select class="form-control" name="brand_id">
                          <option value="">Please Select Product Brand</option>
                           @foreach(App\Models\brand::orderBy('name','asc')->get() as $brand)
                           <option value="{{ $brand->id }}">{{$brand->name}}</option>
                           @endforeach
                         </select>
                     </div>

          	 				<div class="form-group"> 
          	 				   <label for="price">Price</label>
          	 				   <input type="number" name="price" class="form-control" placeholder="Price"> 	
          	 				</div>
          	 				<div class="form-group"> 
          	 				   <label for="offer_price">Offer Price</label>
          	 				   <input type="number" name="offer_price" class="form-control" placeholder="Offer Price"> 	
          	 				</div>
                       <div class="form-group"> 
                           <label for="product_image">Upload Product Image</label>
                           <input type="file" name="product_image[]" class="">     
                        </div>
                                  
                          <div class="form-group"> 
                             <label for="product_image">Upload Product Image</label>
                              <input type="file" name="product_image[]" class="">     
                           </div>
                           <div class="form-group"> 
                              <label for="product_image">Upload Product Image</label>
                              <input type="file" name="product_image[]" class="">     
                           </div>
                           <div class="form-group"> 
                              <label for="product_image">Upload Product Image</label>
                              <input type="file" name="product_image[]" class="">     
                           </div>
          	 				<div class="form-group">
          	 				  <input type="submit" name="submit" value="Upload Product" class="btn btn-primary btn-block">	
          	 				</div>
          	 			</form>
                       
          	 		</div>
          	 	</div>
          	 </div>
          </div>
     </div>
@endsection