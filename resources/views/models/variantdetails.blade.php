@extends('layouts.app')
@section('styles')

@endsection

@section('content')
    <section class="padding-block">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header level">
                            <div class="row">
                                <div class="col-2">
                                    <h3>{{$variant->model_name}}</h3>
                                </div>
                                <div class="col-10 text-right mb-2">
                                    <a href="{{route('review.create', ['id' => $variant->model_id])}}" class="btn btn-success">Write a Review</a>
                                    <a href="{{route('blogs.create', ['id' => $variant->model_id])}}" class="btn btn-success">Write a Blog</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <img height="100%;" width="150px" src='{{asset("storage/cover_images/{$variant->model_image}")}}'>
                                </div>
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <p>Brand Name: {{$variant->brand->brand_name}}</p>
                                        </div>
                                        <div class="col-lg-4">
                                            <p>Launch Date: {{$variant->launch_date}}</p>
                                        </div>
                                        <div class="col-lg-4">
                                            <p>Price (NPR.): {{$variant->price}}</p>
                                        </div>
                                        <div class="col-lg-4">
                                            <p>Mileage (KM/L): {{$variant->mileage}}</p>
                                        </div>
                                        <div class="col-lg-4">
                                            <p>Engine (CC): {{$variant->engine}}</p>
                                        </div>
                                        <div class="col-lg-4">
                                            <p>Seats: {{$variant->seats}}</p>
                                        </div>
                                        <div class="col-lg-4">
                                            <p>Body Type: {{config('constants.model_body_type')[$variant->model_body_type_id]}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <p>
                                    {{$variant->model_description}}
                                </p>
                            </div>
                        </div>
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

