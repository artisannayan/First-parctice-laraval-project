@extends('Backend.layouts.master')

@section('adminpagecontent')
   <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit New Category</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div>
          <div class="row">
             <div class="col-md-12">
              <div class="card shadow mb-4">
                <div class="card-hear py-3">
                   <h6 class="m-0 font-weight-bold text-primary">Edit The Category With Informetion</h6> 
                            
                        @if(Session()->has("msg"))
                         <div class="alert alert-success" role="alert">
                             {{ Session()->get("msg") }}
                         </div>
                         @endif
                      
                </div>
                <div class="card-body">
                           <form action="{{route('admin.category.update',$category->id)}}" method="POST" enctype="multipart/form-data">
                           {{csrf_field()}}
                            @include('Backend.allinfo.message')
                   <div class="form-group"> 
                       <label for="title">Title</label>
                       <input type="text" name="name" class="form-control" value="{{$category->name}}">  
                    </div>
                    <div class="form-group"> 
                       <label for="desc">Description</label>
                       <textarea class="form-control" name="desc" rows="10" cols="90">{{$category->desc}}</textarea>  
                    </div>
          
                 <div class="form-group">
                        <label for="parent_category">Parent Category</label>
                        <select class="form-control" name="parent_id">
                            <option value="">Please Select a Primary Category</option>
                          @foreach ($primary_cetagories as $cat)
                            <option value="{{ $cat->id }}" {{$cat->id == $category->parent_id?'selected': ''}}>{{ $cat->name }}</option>
                          @endforeach
                        </select>
                     </div>
              
                    <div class="form-group"> 
                         <label for="cetagory_image">Category Image</label>
                         <img src="{{asset('image/category-image/'.$category->image)}}" width="120">
                          <br><br>
                         <label for="image">Category New Image</label>
                         <input type="file" name="image" class="">     
                    </div>
                    <div class="form-group">
                      <input type="submit" name="addCategory" value="update Category" class="btn btn-primary btn-block"> 
                    </div>
                  </form>
                       
                </div>
              </div>
             </div>
          </div>
     </div>
@endsection