@extends('layouts.app')
@section('styles')

@endsection

@section('content')
    <section class="padding-block">
        <div class="container-fluid">
            {{ Form::open(['route' => 'review.store']) }}
            <div class="row">
                <div class="col-lg-8"><!-- first column -->
                    <div class="card custom-card create-wrapper">
                        <div class="card-header">
                            <h3>Write a Review</h3>
                        </div>
                        <div class="card-body">
                            <div class="contact-form">
                                <div class="row"><!-- main row open-->
                                    <!-- opening of one field -->
                                    {!! Form::hidden('model_id', $model->model_id) !!}
                                    {!! Form::label('name', 'Name: <span class="required-field"> *</span>', ['class' => 'col-xs-2 col-md-2'], false); !!}
                                    <div class="col-xs-10 col-md-10 form-group">
                                        {!! Form::text('name', null, ['class' => 'form-control', 'data-validation' => 'required']) !!}
                                    </div>
                                    {!! Form::label('title', 'Title: <span class="required-field"> *</span>', ['class' => 'col-xs-2 col-md-2'], false); !!}
                                    <div class="col-xs-10 col-md-10 form-group">
                                        {!! Form::text('title', null, ['class' => 'form-control', 'data-validation' => 'required']) !!}
                                    </div>
                                    {!! Form::label('description', 'Description: <span class="required-field"></span>', ['class' => 'col-xs-2 col-md-2'], false); !!}
                                    <div class="col-xs-10 col-md-10 form-group">
                                        {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '4']) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    {!! Form::label('Rating', 'Rating:', ['class' => 'col-xs-2 col-md-2'], false); !!}
                                    <div class="rateyo-readonly-widg" data-task="{{$model->uuid}}"
                                         data-rating="{{!is_null($model->rating) ? $model->rating : 0}}"
                                         id="rateyo"></div>
                                    {!! Form::hidden('rating', null, ['id' => 'rating']) !!}
                                </div>
                            </div>
                            <p class="text-right">
                                <button class="btn custom-btn btn-success" type="submit">Create</button>
                                <a href="{{route('model.show', $model->model_id)}}" class="btn custom-btn btn-clear" type="submit">Cancel</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </section>

@endsection

@section('scripts')
    <script>
        $(function () {
            var rating = $('#rateyo').data('rating');
            $(".rateyo-readonly-widg").rateYo({
                rating: rating,
                halfStar: true,
                spacing: "10px",
                multiColor: {
                    "startColor": "#FF0000", //RED
                    "endColor"  : "#00FF00"  //GREEN
                },
                numStars: 5,
                precision: 0,
                minValue: 1,
                maxValue: 5
            }).on("rateyo.change", function (e, data) {
                $('#rating').val(data.rating);
            });
        });
    </script>
@endsection
