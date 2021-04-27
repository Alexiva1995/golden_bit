@extends('install::layouts.master')

@section('content')
    <div class="container">
    	<div class="text-center">
    		<h1 style="margin: -30px 0 40px">{!! $settings->name_styled !!}</h1>
            
            @switch($step)
                @case(1)
                    @include('install::steps.first')
                    @break

                @case(2)
                    @include('install::steps.second')
                    @break

                @default
                    @include('install::steps.first')
            @endswitch
    		
    	</div>
    </div>
@stop
