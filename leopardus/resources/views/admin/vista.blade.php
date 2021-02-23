@extends('layouts.dashboard')

@section('content')

<style>
	.p {
		width: 50% !important;
		text-align: center;
	}

	@media screen and (max-width: 700px) {
		#yo {
			font-size: 12px;
		}

		#mytable {
			width: 100% !important;
		}
	}
</style>

<div class="wrapper-md" style="padding: 15px;">
	<div class="col-md-12 buq">
		<form method="GET" action="{{ route('admin.vista') }}">
			{{ csrf_field() }}

			<div class="col-sm-4">

				<label class="control-label " style="text-align: center; margin-top:4px;">Search user</label>
				<input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off"
					name="user_email" placeholder="ID o Correo" required style="background-color:f7f7f7;" />

			</div>

			<div class="col-sm-2" style="padding-left: 10px;">
				<button class="btn green padding_both_small" type="submit" id="btn"
					style="margin-bottom: 15px; margin-top: 28px;">Search</button>
			</div>

		</form>
	</div>
</div>
<h4 style="margin-left: 15px;">User Overview</h4>
<hr>

<div class="row"
	style="padding: 15px 15px; background-color:white; margin-top:10px; margin-right: 15px; margin-left: 15px; margin-bottom:25px;">
	<table id="mytable" class="table table-bordered table-responsive" style="width: 70%; margin: 100px auto;">
		<thead>

		</thead>
		<tbody>
			@php
			$cont = "";
			@endphp
			@foreach($user as $usuario)
			@php
			$faltante = DB::table('user_campo')
			->where('ID', '=', $usuario->ID)
			->get();
			@endphp
			<tr>
				<td HEIGHT="50" WIDTH="30" COLSPAN=2>
					@if ($usuario->gender == 'F')
						<img src="{{(empty($usuario->icono_activo)) ? asset('assets/img/avatares/Woman/N/1.png') : asset($usuario->icono_activo)}}" class="center-block" alt="">
					@else
						<img src="{{(empty($usuario->icono_activo)) ? asset('assets/img/avatares/Men/N/1.png') : asset($usuario->icono_activo)}}" class="center-block" alt="">
					@endif
					{{-- <img src="{{asset($usuario->icono_activo)}}" class="center-block" alt=""> --}}
				</td>
			</tr>
			@foreach($faltante as $falta)
			<tr>
				<td class="p">Name</td>

				<td class="p" id="yo">{{$falta->firstname}}</td>

			</tr>
			<tr>
				<td class="p">lastname</td>

				<td class="p" id="yo">{{$falta->lastname}}</td>

			</tr>
			<tr>
				<td class="p">Nameuser</td>

				<td class="p" id="yo">{{$falta->nameuser}}</td>

			</tr>
			<tr>
				<td class="p">Date of birth</td>
				<td class="p" id="yo">{{ $falta->edad }}</td>

			</tr>
			<tr>
				<td class="p">Gender</td>
				@if($falta->genero == 'M')
				<td class="p" id="yo">Male</td>
				@else
				<td class="p" id="yo">Female</td>
				@endif

			</tr>
			<tr>
				<td class="p">Phone</td>
				<td class="p" id="yo">{{ $falta->phone }}</td>

			</tr>
			@endforeach
			<tr>
				<td class="p">Email</td>
				<td class="p" id="yo">{{ $usuario->user_email }}</td>

			</tr>
			@endforeach
		</tbody>
	</table>

	<div class="row" style="background-color: #fff; margin-top:50px;">
		@if (Auth::user()->ID == 1)
		<div class="col-sm-2 col-md-offset-1">
			@foreach($user as $usuario)
			<a href="{{ route('gestion.verusuario', Crypt::encrypt($usuario->ID)) }}">
				@endforeach
				<div class="panel-group">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<center><i class="far fa-address-book" style="font-size: 23px;"></i></center>
						</div>
						<div class="panel-footer">
							<center>Profile</center>
						</div>
					</div>
				</div>
		</div>
		@endif

		@if (Auth::user()->ID == 1)
		<div class="col-sm-2">
			@foreach($user as $usuario)
			<a href="{{ route('gestion.ingresos', Crypt::encrypt($usuario->ID)) }}">
				@endforeach
				<div class="panel-group">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<center><i class="fa fa-money" style="font-size: 23px;"></i></center>
						</div>
						<div class="panel-footer">
							<center>Income</center>
						</div>
					</div>
				</div>
		</div>
		@endif

		<div class="col-sm-2">
			@foreach($user as $usuario)
			<a href="{{ route('gestion.referidos', Crypt::encrypt($usuario->ID)) }}">
				@endforeach
				<div class="panel-group">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<center><i class="far fa-user-circle" style="font-size: 23px;"></i></center>
						</div>
						<div class="panel-footer">
							<center>Referrals</center>
						</div>
					</div>
				</div>
		</div>

		<div class="col-sm-2">
			@foreach($user as $usuario)
			<a href="{{ route('gestion.wallet', Crypt::encrypt($usuario->ID)) }}">
				@endforeach
				<div class="panel-group">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<center><i class="fas fa-wallet" style="font-size: 23px;"></i></center>
						</div>
						<div class="panel-footer">
							<center>Coin purse</center>
						</div>
					</div>
				</div>
		</div>

		@if (Auth::user()->ID == 1)
		<div class="col-sm-2">
			@foreach($user as $usuario)
			<a href="{{ route('gestion.pago', Crypt::encrypt($usuario->ID)) }}">
				@endforeach
				<div class="panel-group">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<center><i class="fa fa-money" style="font-size: 23px;"></i></center>
						</div>
						<div class="panel-footer">
							<center>Released</center>
						</div>
					</div>
				</div>
		</div>
		@endif
	</div>
</div>

@endsection