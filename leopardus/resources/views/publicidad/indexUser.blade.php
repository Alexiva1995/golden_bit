@extends('layouts.dashboard')

@section('content')
{{-- alertas --}}
@include('dashboard.componentView.alert')
<br>

{{-- option datatable --}}
@include('dashboard.componentView.optionDatatable')
<div class="card">
    <div class="card-content">
        <div class="card-body">
            <div class="table-responsive">
                <table id="mytable" class="table zero-configuration">
                    <thead>
                        <tr>
                            {{-- <th class="text-center">
                                Product ID
                            </th> --}}
                            <th class="text-center">
                                Imagen
                            </th>
                            <th class="text-center">
                                Nombre
                            </th>
                            <th class="text-center">
                                Descripcion
                            </th>
                            <th>
                                Acción
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($publicidades as $publicidad)
                        <tr>
                            {{-- <td class="text-center">
                                {{$publicidad->id}}
                            </td> --}}
                            <td class="text-center">
                                <img src="{{$publicidad->img}}" height="50">
                            </td>
                            <td class="text-center">
                                {{$publicidad->titulo}}
                            </td>
                            <td class="text-center">
                                {{$publicidad->descripcion}}
                            </td>
                            <td>
                                @foreach ($publicidad['social'] as $social)
                                @if ($social == 'facebook')
                                <button type="button" class="btn btn-icon btn-outline-primary mr-1 mb-1"
                                    onclick="fbs_click({{json_encode($publicidad)}})">
                                    <i class="feather icon-facebook"></i>
                                </button>
                                @endif
                                @endforeach
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom_js')
<script src="{{asset('assets/scripts/graficas.js')}}"></script>

<script type="text/javascript">
	function fbs_click(publi) {
		u=publi.img;
		// t=document.title;
   		t=publi.title
		let urlCom = "{{route('publicidad.compartido')}}"
		let url = 'http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t)
   		window.open(url, 'sharer', 'toolbar=0,status=0,width=626,height=436')
		data = {
			id: publi.id,
            social: 'facebook'
            _token: '{{ csrf_token() }}'
        }
		$.post(urlCom, data, function(){
            alert('compartido')
			window.location.reload()
		})
		return false;
	}
</script>
@endpush