<div class="col-12">
    <section class="mt-1 mb-1">
        <div class="row">
            {{-- grafico semanal --}}
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Publicidad diaria</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div id="g_publicidad"></div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- fin grafico semanal --}}
            {{-- publicidad --}}
            <div class="col-12">
                <div class="card">
                    {{-- <div class="card-header">
                        <h4 class="card-title">Publicidad diaria</h4>
                    </div> --}}
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="card h-100">
                                        <div class="card-header">
                                            <h4 class="card-title">Publicidad</h4>
                                        </div>
                                        <div class="card-contetn">
                                            <div class="card-body">
                                                <ul class="list-group list-group-flush">
                                                    @foreach ($data['publicidades'] as $item)
                                                    <li class="list-group-item" >
                                                        <div class="media">
                                                            <a class="media-left align-self-center" href="#">
                                                                <img src="{{$item->img}}" alt="Generic placeholder image" height="64" width="64">
                                                            </a>
                                                            <div class="media-body">
                                                                <h5 class="media-heading">{{$item->titulo}}</h5>
                                                                <p class="mb-0">
                                                                    {!!$item->descripcion!!}
                                                                </p>
                                                                <p class="text-right">
                                                                    @foreach ($item['social'] as $social)
                                                                        @if ($social == 'facebook')
                                                                        <button type="button" class="btn btn-icon btn-outline-primary mr-1 mb-1" onclick="fbs_click({{json_encode($item)}})">
                                                                            <i class="feather icon-facebook"></i>
                                                                        </button>
                                                                        @endif
                                                                    @endforeach
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="card h-100">
                                        <div class="card-header">
                                            <h4 class="card-title">Grafica Circular</h4>
                                        </div>
                                        <div class="card-contetn">
                                            <div class="card-body">
                                                <div id="grafica_public"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- fin publicidad --}}
        </div>
    </section>
</div>