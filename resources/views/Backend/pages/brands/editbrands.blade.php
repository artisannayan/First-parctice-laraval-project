@extends('Backend.layouts.master')

@section('adminpagecontent')
   <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit New Brands</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div>
          <div class="row">
             <div class="col-md-12">
              <div class="card shadow mb-4">
                <div class="card-hear py-3">
                   <h6 class="m-0 font-weight-bold text-primary">Edit The Brands With Informetion</h6> 
                            
                        @if(Session()->has("msg"))
                         <div class="alert alert-success" role="alert">
                             {{ Session()->get("msg") }}
                         </div>
                         @endif
                      
                </div>
                <div class="card-body">
                           <form action="{{route('admin.brand.update',$brand->id)}}" method="POST" enctype="multipart/form-data">
                           {{csrf_field()}}
                            @include('Backend.allinfo.message')
                   <div class="form-group"> 
                       <label for="title">Title</label>
                       <input type="text" name="name" class="form-control" value="{{$brand->name}}">  
                    </div>
                    <div class="form-group"> 
                       <label for="desc">Description</label>
                       <textarea class="form-control" name="desc" rows="10" cols="90">{{$brand->desc}}</textarea>  
                    </div>
              
                    <div class="form-group"> 
                         <label for="brand_image">Brand Image</label>
                         <img src="{{asset('image/brand-image/'.$brand->image)}}" width="120">
                          <br><br>
                         <label for="image">Brand New Image</label>
                         <input type="file" name="image" class="">     
                    </div>
                    <div class="form-group">
                      <input type="submit" name="editbrand" value="update Brand" class="btn btn-primary btn-block"> 
                    </div>
                  </form>
                       
                </div>
              </div>
             </div>
          </div>
     </div>
@endsection