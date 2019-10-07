@extends('Backend.layouts.master')

@section('adminpagecontent')
   <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Manage All Product</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div>
          <div class="row">
             <div class="col-md-12">
              <div class="card shadow mb-4">
                <div class="card-hear py-3">
                   <h6 class="m-0 font-weight-bold text-primary">View Update Delete  Indivudual</h6>  
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
                        <th scope="col">Title</th>
                        <th scope="col">Category</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                      $i = 1;
                      @endphp
                      @foreach($products as $product)
                      <tr>
                        <th scope="row">{{$i}}</th>
                        <td>{{$product->title}}</td>
                        <td>{{$product->category->name}}</td>
                        <td>{{$product->brand->name}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>
                          <div class="btn-group">
                                 <a href="{{route('editproduct',$product->id)}}" class="btn btn-primary btn-sm">Update</a> 
                            <a href="#deleteproduct{{$product->id}}" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteproduct{{$product->id}}">Delete</a> 
                            <!--Delete Product Modal Content Start -->
                            <div class="modal fade" id="deleteproduct{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                   <div class="modal-content">
                                        <div class="modal-header">
                                           <h5 class="modal-title" id="deleteproduct">Are You Sure to Delete The Product</h5>
                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                         </button>
                                       </div>
                                        <div class="modal-body">
                                          <form action="{{route('admin.product.delete',$product->id)}}"method="POST">
                                            {{csrf_field()}}
                                            <button type="submit" class="btn btn-danger btn-block">Confirm Delete</button>
                                          </form>
                                        </div>
                                       <div class="modal-footer">
                                           <button type="button" class="btn btn-secondary"        data-dismiss="modal">Close</button>
                                         <button type="button" class="btn btn-primary">Save changes</button>
                                       </div>
                                   </div>
                                </div>
                            </div>
                            <!--Delete Product Modal Content End -->
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
