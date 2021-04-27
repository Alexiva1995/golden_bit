@extends('layouts.app')

@section('content')
	<ul>
		@php
			$acumulado = 0;
		@endphp
		@foreach ($compras_usuario as $compra)
			<li>Post_id: {{ $compra->post_id }}</li>

			@php
				$status_compra = DB::table($settings->prefijo_wp.'posts')
								->select('post_status')
								->where('ID', '=', $compra->post_id)
								->first();

				$total_compra = DB::table($settings->prefijo_wp.'postmeta')
								->select('meta_value')
								->where('post_id', '=', $compra->post_id)
								->where('meta_key', '=', '_order_total')
								->first();
			@endphp
			<li>Status: {{ $status_compra->post_status }}</li>
			<li>Total: {{ $total_compra->meta_value }}</li>
			@php
				if ($status_compra->post_status == 'wc-completed'){
					$acumulado = $acumulado + $total_compra->meta_value;
				}
				$acumulado = $acumulado + $total_compra->meta_value;
			@endphp
		@endforeach
	</ul>

	Total en compras completadas: {{ $acumulado }}
@endsection