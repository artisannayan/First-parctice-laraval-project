
@extends('Frontend.layouts.maintemplate')

@section('bodycontent')
<div class="container">
   <div class="row">
     <div class="col-md-4">
        <div class="list-group">
         <a href="#" class="list-group-item">
            <img src = "{{ App\Helpers\ImageHelper::getUserImage(Auth::user()->id) }}"width="100px">
          </a>
        <a href="{{ route('user.dashboard')}} " class="list-group-item {{ Route::is('user.dashboard') ?'active': '' }}">Dashboard</a>
        <a href="{{ route('user.profile')}} " class="list-group-item {{ Route::is('user.profile') ?'active': '' }}">Update Profile</a>
        <a href="{{ route('logout')}} " class="list-group-item {{ Route::is('logout') ?'active': '' }}">Log Out</a>
        </div>
     </div>
     <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                @yield('subcontent')
            </div>
          </div>
     </div>
   </div>
</div>
@endsection