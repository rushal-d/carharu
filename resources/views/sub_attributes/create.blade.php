@extends('layouts.app')
@section('styles')

@endsection

@section('content')
    <section class="padding-block">
        <div class="container-fluid">
            {{ Form::open(['route' => 'sub-attribute-store']) }}
            <div class="row">
                <div class="col-lg-6"><!-- first column -->
                    <div class="card custom-card create-wrapper">
                        <div class="card-header">
                            <h3>Add a Sub-Attribute</h3>
                        </div>
                        <div class="card-body">
                            <div class="contact-form">
                                <div class="row"><!-- main row open-->
                                    <!-- opening of one field -->
                                    {!! Form::label('attribute', 'Attribute: <span class="required-field"> *</span>', ['class' => 'col-xs-3 col-md-3'], false); !!}
                                    <div class="col-xs-9 col-md-9 form-group">
                                        {!! Form::select('attribute_id', $attributes, null, ['class' => 'form-control drop', 'data-validation' => 'required', 'placeholder' => 'Select']) !!}
                                    </div>
                                </div>
                                <div class="row to-be-clone">
                                    {!! Form::label('sub_attribute', 'Sub-Attribute: <span class="required-field"> *</span>', ['class' => 'col-xs-3 col-md-3'], false); !!}
                                    <div class="col-xs-9 col-md-9 form-group">
                                        {!! Form::text('name[1][attributes]', null, ['class' => 'form-control attributes_input', 'data-validation' => 'required']) !!}
                                    </div>
                                </div>
                                <p class="text-left" style="margin-left: 140px">
                                    <a href="javascript:void(0);" class="btn btn-sm custom-btn btn-success" id="add" type="submit"><i class="fa fa-plus"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-sm custom-btn btn-danger remove" id="remove" type="submit"><i class="fa fa-times"></i></a>
                                </p>
                                <p class="text-right">
                                    <button class="btn custom-btn btn-success" type="submit">Create</button>
                                    <a href="{{route('sub-attribute-index')}}" class="btn custom-btn btn-clear" type="submit">Cancel</a>
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

    //clone and remove
    var count = 1;
    $(document).ready(function () {
        $("body").on("click", "#add", function () {
            count++;
            var html = $('.to-be-clone').first().clone();
            html.find('.attributes_input').attr('name', "name["+count+"][attributes]").val();
            $(".to-be-clone").parent().find('.to-be-clone').last().after(html);
        });
    })
    $('.remove').click(function () {
        if($(".to-be-clone").length > 1){
            $(".contact-form").find('.to-be-clone').last().remove();
        }
        return false;
    });

</script>
@endsection
