
@extends('Frontend.pages.user.dashboardMaster')

@section('subcontent')

<!--Pages BradeCrumbs Start-->

<!--Pages BradeCrumbs End-->

<div class="row">
  <div class="card card-body">
      <div class="col-md-6">
          <h1> Welcome {{ $user->first_name . '' . $user->last_name }}</h1>
          <h5> You Can Change/Update Your Profile Informatino fron this pages </h5>
        </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
     <a href="{{ route('user.profile') }}">Update Profile</a
  </div>
</div>

@endsection