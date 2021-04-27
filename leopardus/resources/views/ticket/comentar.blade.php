@extends('layouts.dashboard')

@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Nuevo Comentario</h4>
    </div>
    <div class="card-content">
        <div class="card-body">
            <form method="post" action="{{ route('subir') }}">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{$ticket->id}}">
                <div class="form-group">
                    <label class="control-label">Comentario</label>
                    <textarea name="comentario" style=" width: 100%; height: 200px;">
                        </textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-info" type="submit" id="btn">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="card">
    <div class="card-header">
        <h4 class="card-title">Ticket - {{$ticket->titulo}}</h4>
    </div>
    <div class="card-content">
        <div class="card-body">
            <div class="media">
                <div class="media-body">
                    <h5 class="mt-0">{{$ticket->user}}</h5>
                    <p>{!! $ticket->comentario !!}</p>
                    <p style="float:right;">{{date('d-m-Y', strtotime($ticket->created_at))}}</p>
                    @foreach ($ticket->comentarios as $comen)
                    <div class="media mt-3">
                        <div class="media-body">
                            <h5 class="mt-0">{{$comen->user}}</h5>
                            {!! $comen->comentario !!}
                            <p style="float:right;">{{date('d-m-Y', strtotime($comen->created_at))}}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom_js')
<script src="https://cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('comentario');
</script>
@endpush