<img title="{{ ucwords($data->display_name) }}" src="{{ $data->avatarTree }}" style="width:64px"
    onclick="nuevoreferido('{{base64_encode($data->ID)}}', '{{$type}}')">
<div class="inforuser">
    <div class="card mb-0" style="background: #000d2f">
        <div class="card-header mx-auto">
            <div class="avatar avatar-xl">
                <img class="img-fluid" src="{{ $data->avatarTree }}" alt="img placeholder">
            </div>
        </div>
        <div class="card-content">
            <div class="card-body text-center " style="background: #000d2f">
                <div class="d-flex justify-content-center">
                    <div>
                        <h6 class="text-white">
                            <strong>Usuario:</strong> {{$data->fullname}} 
                        </h6>
                        <h6 class="text-white">
                            <strong>Fecha Ingreso:</strong> {{date('d-m-Y', strtotime($data->created_at))}}
                        </h6>
                        <h4 class="mt-2 text-white">
                            Total Invertido
                            <br>
                             <strong>{{$data->invertido}}</strong>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>