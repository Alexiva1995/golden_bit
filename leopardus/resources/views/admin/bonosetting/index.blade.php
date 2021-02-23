@extends('layouts.dashboard')

@section('content')
{{-- option datatable --}}
@include('dashboard.componentView.optionDatatable')
@push('custom_js')
<script>
    $(document).ready(function () {
        $('#mytable2').DataTable({
            dom: 'flBrtip',
            responsive: true,
            order: [5, ['desc']]
        });
    });
</script>
@endpush
{{-- alertas --}}
@include('dashboard.componentView.alert')
<section>
    {{-- Bono Directo --}}
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Bono Directo</h4>
            <button class="btn btn-primary float-right" data-toggle="modal" data-target="#bonodirecto">
                <i class="fa fa-edit"></i>
            </button>
        </div>
        <div class="card-body">
            <table id="mytable2" class="table zero-configuration">
                <thead>
                    <tr class="text-center">
                        <th>Bronce</th>
                        <th>Plata</th>
                        <th>Oro</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        <td>{{($bonodirecto->settings_bono->bronce * 100)}} %</td>
                        <td>{{($bonodirecto->settings_bono->plata * 100)}} %</td>
                        <td>{{($bonodirecto->settings_bono->oro * 100)}} %</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    {{-- Fin Bono Directo --}}

    {{-- Bono Directo --}}
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Bono BlackBox</h4>
        </div>
        <div class="card-body">
            @if (empty($bonoblackbox))
                    <form action="{{route('bonosetting.store')}}" method="post">
                        {{ csrf_field() }}
                @else
                <form action="{{route('bonosetting.update', $bonoblackbox->id)}}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                @endif
                <h5 class="text-center">
                    <strong>Nota:</strong>
                    El Monto Aqui colocado, sera el cobrado por el usuario
                </h5>
                <input type="hidden" name="type_bono" value="blackbox">
                <div class="form-group">
                    <label for="">BlackBox</label>
                    <input type="number" name="blackbox" class="form-control" required value="{{(!empty($bonoblackbox)) ? $bonoblackbox->settings_bono->blackbox : 0}}">
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-primary">Agregar</button>
                </div>
            </form>
        </div>
    </div>
    {{-- Fin Bono Directo --}}

    {{-- Bono Matriz --}}
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Bono Matrix</h4>
            <button class="btn btn-primary float-right" data-toggle="modal" data-target="#bonomatrix">
                <i class="fa fa-edit"></i>
            </button>
        </div>
        <div class="card-body">
            <table id="mytable2" class="table zero-configuration">
                <thead>
                    <tr class="text-center">
                        <th>Nivel</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 1; $i < 11; $i++)
                    <tr class="text-center">
                        <td>Nivel {{$i}}</td>
                        <td>{{$bonomatrix->settings_bono->$i}} $</td>
                    </tr> 
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
    {{-- Fin Bono Matriz --}}
</section>

@include('admin.bonosetting.modalBonoDirecto')
@include('admin.bonosetting.modalBonoMatrix')
@endsection