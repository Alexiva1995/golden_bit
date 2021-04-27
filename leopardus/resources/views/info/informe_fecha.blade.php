@extends('layouts.dashboard')

@section('content')
{{-- option datatable --}}
@include('dashboard.componentView.optionDatatable')


<div class="card">
	<div class="card-content">
		<div class="card-body">
			<div class="table-responsive">
				<table id="mytable" class="table zero-configuration">
					<thead>
						<tr>
							<th>N° de Orden</th>
							<th>Fecha</th>
							<th>Concepto</th>
							<th>Total</th>
							<th>Estado</th>
						</tr>
					</thead>
					<tbody>
						@php
						$cont = 0;
						@endphp
						@foreach ($ordenes as $orden)
						@php
						$cont++;

						$numOrden = DB::table($settings->prefijo_wp.'postmeta')
						->select('meta_value')
						->where('post_id', '=', $orden->post_id)
						->where('meta_key', '=', '_order_key')
						->first();

						$fechaOrden = DB::table($settings->prefijo_wp.'posts')
						->select('post_date')
						->where('ID', '=', $orden->post_id)
						->first();

						$estado = DB::table($settings->prefijo_wp.'posts')
						->select('post_status')
						->where('ID', '=', $orden->post_id)
						->first();

						$totalOrden = DB::table($settings->prefijo_wp.'postmeta')
						->select('meta_value')
						->where('post_id', '=', $orden->post_id)
						->where('meta_key', '=', '_order_total')
						->first();

						$itemsOrden = DB::table($settings->prefijo_wp.'woocommerce_order_items')
						->select('order_item_name')
						->where('order_id', '=', $orden->post_id)
						->where('order_item_type', '=', 'line_item')
						->get();

						$estadoEntendible = '';
						switch ($estado->post_status) {
						case 'wc-completed':
						$estadoEntendible = 'Completado';
						break;
						case 'wc-pending':
						$estadoEntendible = 'Pendiente de Pago';
						break;
						case 'wc-processing':
						$estadoEntendible = 'Procesando';
						break;
						case 'wc-on-hold':
						$estadoEntendible = 'En Espera';
						break;
						case 'wc-cancelled':
						$estadoEntendible = 'Cancelado';
						break;
						case 'wc-refunded':
						$estadoEntendible = 'Reembolsado';
						break;
						case 'wc-failed':
						$estadoEntendible = 'Fallido';
						break;
						}
						@endphp
						@if(date('d-m-Y', strtotime($fechaOrden->post_date)) == $primero && $estadoEntendible ==
						'Completado')
						<tr>
							<td>{{ $orden->post_id }}</td>
							<td>{{ date('d-m-Y', strtotime($fechaOrden->post_date)) }}</td>
							<td>@foreach ($itemsOrden as $item)
								{{ $item->order_item_name }}.
								@endforeach
							</td>
							<td>$ {{ $totalOrden->meta_value }}</td>
							<td>{{ $estadoEntendible }}</td>
						</tr>
						@endif
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection