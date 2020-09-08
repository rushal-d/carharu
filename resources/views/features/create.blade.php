@extends('layouts.app')
@section('styles')

@endsection

@section('content')
    <section class="padding-block">
        <div class="container-fluid">
            {{ Form::open(['route' => 'features.store']) }}
            <div class="row">
                <div class="col-lg-8"><!-- first column -->
                    <div class="card custom-card create-wrapper">
                        <div class="card-header">
                            <h3>Add a Feature</h3>
                        </div>
                        <div class="card-body">
                            <div class="contact-form">
                                <div class="row"><!-- main row open-->
                                    <!-- opening of one field -->
                                    {!! Form::label('specs', 'Specification: <span class="required-field"> *</span>', ['class' => 'col-xs-2 col-md-2'], false); !!}
                                    <div class="col-xs-10 col-md-10 form-group">
                                        {!! Form::select('specs_id', $specs, null, ['id' => 'myselection', 'class' => 'form-control drop', 'data-validation' => 'required', 'placeholder' => 'Select a specification']) !!}
                                    </div>
                                </div>
                                <div class="row to-be-clone">
                                    {!! Form::label('features', 'Features: <span class="required-field"> *</span>', ['class' => 'col-xs-2 col-md-2'], false); !!}
                                    <div class="col-xs-10 col-md-10 form-group">
                                        {!! Form::text('feature[1][features]', null, ['class' => 'form-control features_input', 'data-validation' => 'required']) !!}
                                    </div>
                                </div>
                                <p class="text-left" style="margin-left: 140px">
                                    <a href="javascript:void(0);" class="btn btn-sm custom-btn btn-success" id="add" type="submit"><i class="fa fa-plus"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-sm custom-btn btn-danger remove" id="remove" type="submit"><i class="fa fa-times"></i></a>
                                </p>
                                <p class="text-right">
                                    <button class="btn custom-btn btn-success" type="submit">Create</button>
                                    <a href="{{route('features.index')}}" class="btn custom-btn btn-clear" type="submit">Cancel</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $('.drop').selectize();

    var count = 1;
    $(document).ready(function(){
        $("body").on("click", "#add", function(){
            count++;
            var html = $(".to-be-clone").first().clone();
            html.find('.features_input').attr('name', "feature["+count+"][features]").val();
            $(".to-be-clone").parent().find('.to-be-clone').last().after(html);
        });
    })
    $('.remove').click(function(){
        if($(".to-be-clone").length>1){
            $(".contact-form").find(".to-be-clone").last().remove();
        }
        return false;
    });
    </script>
@endsection
