@extends('Backend.layouts.master')

@section('adminpagecontent')
   <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit New Division</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div>
          <div class="row">
             <div class="col-md-12">
              <div class="card shadow mb-4">
                <div class="card-hear py-3">
                   <h6 class="m-0 font-weight-bold text-primary">Edit The Division With Informetion</h6> 
                            
                        @if(Session()->has("msg"))
                         <div class="alert alert-success" role="alert">
                             {{ Session()->get("msg") }}
                         </div>
                         @endif
                      
                </div>
                <div class="card-body">
                           <form action="{{route('admin.division.update',$division->id)}}" method="POST" enctype="multipart/form-data">
                           {{csrf_field()}}
                            @include('Backend.allinfo.message')
                   <div class="form-group"> 
                       <label for="title">Division Name</label>
                       <input type="text" name="name" class="form-control" value="{{$division->name}}">  
                    </div>
                    <div class="form-group"> 
                      <label for="name">Priority Number in list</label>
                      <input type="text" name="priority" class="form-control" value="{{$division->priority}}"> 	
                     </div>
                   
                    <div class="form-group">
                      <input type="submit" name="editbrand" value="update Division" class="btn btn-primary btn-block"> 
                    </div>
                  </form>
                       
                </div>
              </div>
             </div>
          </div>
     </div>
@endsection