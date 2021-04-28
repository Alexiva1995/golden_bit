@extends('layouts.dashboard')

@section('content')
<div class="contai2" style="position:relative">
	{{-- alertas --}}
	@include('dashboard.componentView.alert')
	<div class="row">
		{{-- primeros cuadro --}}
		@if (Auth::user()->rol_id == 0)
		@include('dashboard.componenteIndex.admin_square')
		@else
		@include('dashboard.componenteIndex.first_square')
		@endif
		{{-- secundo cuadro --}}
		@if ($data['paquete'] == 0)
		@include('dashboard.componenteIndex.modalGold')
		@endif
		{{-- tecer cuadro --}}
		{{-- @include('dashboard.componenteIndex.third_square') --}}
	</div>
</div>
@endsection

@push('custom_js')
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="{{asset('assets/scripts/graficas.js')}}"></script>

<script type="text/javascript">
	function copyToClipboard(element) {
		var aux = document.createElement("input");
		aux.setAttribute("value", document.getElementById(element).innerHTML.replace('&amp;', '&').trim());
		document.body.appendChild(aux);
		aux.select();
		document.execCommand("copy");
		document.body.removeChild(aux);
		Swal.fire({
			title: '¡Link Copiado!',
			text: "Su link de referido esta listo para pegar",
			type: "success",
			confirmButtonClass: 'btn btn-primary',
			buttonsStyling: false,
		}).then((value) => {
			if (value) {
				window.location.reload()
			}
		})
	}

	/**
	 * Permite modificar el lado binario donde se van a ir registrando los usuarios
	 */
	function updateSideBinary(value) {
		let url = "{{route('change.side')}}"
		let valor = value
		let data = {
			ladoregistrar: valor,
			_token: "{{ csrf_token() }}",
		}
		let lado = (valor == 'D') ? 'Derecha' : 'Izquierda'
		$.post(url, data, function (response) {
			if (response = 1) {
				Swal.fire({
					title: 'Lado Binario Actualizado',
					text: "Su nuevo lado de registro binario es por la " + lado,
					type: "success",
					confirmButtonClass: 'btn btn-primary',
					buttonsStyling: false,
				}).then((value) => {
					if (value) {
						copyToClipboard('copy')
					}
				})
			} else {
				Swal.fire({
					title: 'Error',
					text: "No se pudo actualizar el lado a registrar intente de nuevo",
					type: "danger",
					confirmButtonClass: 'btn btn-primary',
					buttonsStyling: false,
				}).then((value) => {
					if (value) {
						window.location.reload()
					}
				})
			}
		})
	}

	function fbs_click(publi) {
		u = publi.img;
		// t=document.title;
		t = publi.title
		let urlCom = "{{route('publicidad.compartido')}}"
		let url = 'http://www.facebook.com/sharer.php?u=' + encodeURIComponent(u) + '&t=' + encodeURIComponent(t)
		window.open(url, 'sharer', 'toolbar=0,status=0,width=626,height=436')
		data = {
			id: publi.id,
			social: 'facebook',
			_token: '{{ csrf_token() }}'
		}
		$.post(urlCom, data, function () {
			alert('compartido')
			window.location.reload()
		})
		return false;
	}
</script>

@if ($data['paquete'] == 0)
<script>
	$(document).ready(function () {
		$('#myModalGold').modal('show')
	})
</script>
@endif
@endpush

@push('vendor_css')
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/charts/apexcharts.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
@endpush

@push('page_vendor_js')
<script src="{{asset('app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
@endpush