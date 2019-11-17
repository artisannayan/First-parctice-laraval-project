@extends('Backend.layouts.master')

@section('adminpagecontent')
   <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Manage All District</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div>
          <div class="row">
             <div class="col-md-12">
              <div class="card shadow mb-4">
                <div class="card-hear py-3">
                   <h6 class="m-0 font-weight-bold text-primary">View Update Delete  Indivudual District</h6>  
                       @if(Session()->has("msg"))
                         <div class="alert alert-success" role="alert">
                             {{ Session()->get("msg") }}
                         </div>
                         @endif
                </div>
                <div class="card-body">   
                      <table class="table">
                         <thead class="thead-dark">
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">District Name</th>
                        <th scope="col">District Priority</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                      $i = 1;
                      @endphp
                      @foreach($districts as $district)
                      <tr>
                        <th scope="row">{{$i}}</th>
                        <td>{{$district->name}}</td>
                        <td>{{$district->priority}}</td>
                        
                        <td>
                          <div class="btn-group">
                              <!--Update Category Button-->
                              <a href="{{route('admin.district.edit',$district->id)}}" class="btn btn-primary btn-sm">Update</a> 
                                  <!--Delete Category Button-->
                            <a href="#deletedistrict{{$district->id}}" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletedistrict{{$district->id}}">Delete</a> 

                            <!--Delete Category Modal Content Start -->
                            <div class="modal fade" id="deletedistrict{{$district->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                   <div class="modal-content">
                                        <div class="modal-header">
                                           <h5 class="modal-title" id="deletedistrict">Are You Sure to Delete The District</h5>
                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                         </button>
                                       </div>
                                        <div class="modal-body">
                                          <form action="{{route('admin.district.delete',$district->id)}}"method="POST">
                                            {{csrf_field()}}
                                            <button type="submit" class="btn btn-danger btn-block">Confirm Delete</button>
                                          </form>
                                        </div>
                                       <div class="modal-footer">
                                           <button type="button" class="btn btn-secondary"data-dismiss="modal">Close</button>
                                         <button type="button" class="btn btn-primary">Save changes</button>
                                       </div>
                                   </div>
                                </div>
                            </div>
                            <!--Delete Category Modal Content End -->
                          </div>
                        </td>
                      </tr>
                     @php
                      $i++;
                     @endphp 
                    @endforeach
                     
                    </tbody>
                  </table> 
                </div>
              </div>
             </div>
          </div>
     </div>
@endsection
