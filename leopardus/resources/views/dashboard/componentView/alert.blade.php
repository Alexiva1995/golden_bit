@if (Session::has('msj'))
<div class="alert alert-success">
	<strong>{{Session::get('msj')}}</strong>
</div>
@endif

@if (Session::has('msj2'))
<div class="alert alert-warning">
	<strong>{{Session::get('msj2')}}</strong>
</div>
@endif

@if (Session::has('msj3'))
<div class="alert alert-danger">
  <button class="close" data-close="alert"></button>
  <span>
    {{Session::get('msj3')}}
  </span>
</div>
@endif

@if($errors->any())
<div class="alert alert-danger">
	<button class="close" data-close="alert"></button>
	<span>
		<ul class="no-margin">
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</span>
</div>
<br>
@endif