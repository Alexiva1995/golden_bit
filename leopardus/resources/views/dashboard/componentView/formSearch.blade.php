<div class="card">
    {{-- <div class="card-header">
        <div class="card-title">
            Date Filter
        </div>
    </div> --}}
    <div class="card-content">
        <div class="card-body">
            <form method="POST" action="{{ route($route) }}">
                <div class="row">
                    {{ csrf_field() }}
                <div class="col-12 col-sm-6 col-md-4">
                    <label class="control-label " style="text-align: center; margin-top:4px;">{{$text1}}</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="{{$type}}" autocomplete="off"
                        name="{{$name1}}" required style="background-color:f7f7f7;" />
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <label class="control-label " style="text-align: center; margin-top:4px;">{{$text1}}</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="{{$type}}" autocomplete="off"
                        name="{{$name2}}" required style="background-color:f7f7f7;" />
                </div>
                <div class="col-12 text-center col-md-2" style="padding-left: 10px;">
                    <button class="btn btn-primary mt-2" type="submit" id="btn">Buscar</button>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>