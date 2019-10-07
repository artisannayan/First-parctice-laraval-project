@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
        	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


{{-- @if(Session::has('errors'))
<div class="alert alert-danger">
    <p>{{ Session::get('errors') }}</p>
</div>
@endif --}}