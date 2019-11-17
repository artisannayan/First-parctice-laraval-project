@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
        	<a href="#" class="close" data-dimidd="alert" aria-lavel="close">&times;</a>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::has('success'))
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="alert alert-success">
             <p>{{ Session::get('success')}}</p>
        </div>
      </div>
    </div>
</div>


  
@endif

 @if(Session::has('errors'))
 <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="alert alert-danger">
         <p>{{ Session::get('errors') }}</p>
        </div>
      </div>
    </div>
</div>
@endif 