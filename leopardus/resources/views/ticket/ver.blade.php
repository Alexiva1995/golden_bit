@extends('layouts.dashboard')

@section('content')

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