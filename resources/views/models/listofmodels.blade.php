@extends('layouts.app')
@section('styles')
    <style>
        .card-body h3{
            position: relative;
        }
        .card-body h3:after{
            content: "";
            position: absolute;
            background: #FF0000;
            bottom: -5px;
            left: 0;
            width: 150px;
            height: 3px;
        }
    </style>
@endsection

@section('content')
    <section class="padding-block">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Models</h3>
                        </div>
                        @foreach($models as $model)
                            <div class="card-body" style="box-shadow: 0px 2px #2f353a;">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <a href="{{route('model.show', $model->model_id)}}"><img height="150px;" width="100%;" src='{{asset("uploads/{$model->model_image}")}}'></a>
                                    </div>
                                    <div class="col-lg-9">
                                        <h3 style="font-style: italic">{{$model->model_name}}</h3>
                                        <p>
                                            Price: {{$model->price}}
                                        </p>
                                        <p>
                                            Engine: {{$model->engine}}
                                        </p>
                                        <p>
                                            Seats: {{$model->seats}}
                                        </p>
                                        <p>
                                            Body Type: {{$model->model_body_type_id}}
                                        </p>
                                    </div>
                                    <div class="col-lg-1">
                                        <a href="{{route('model.edit', $model->model_id)}}"
                                           class="btn btn-sm btn-primary">
                                            <i class="far fa-edit" data-toggle="tooltip" data-placement="top"
                                               title="Edit"></i>
                                        </a>
                                        <a href="{{route('model.destroy', $model->model_id)}}" data-uuid="{{$model->model_id}}"
                                           data-name="{{$model->model_name}}"
                                           class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash" data-toggle="tooltip"
                                               data-placement="top" title="Delete"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <script>
            $('#reset').click(function () {
                $('input').val('');
                $('#department-form').submit();
            });
        </script>
    </section>

@endsection


