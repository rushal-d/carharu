@foreach($mods as $model)
    <div class="col-lg-3" style="background-color: #ffffff;border: 1px solid #000000">
        <h3>{{$model->model_name}}</h3>
    </div>
@endforeach
