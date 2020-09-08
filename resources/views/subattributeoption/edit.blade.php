@extends('layouts.app')
@section('content')
    <section class="padding-block">
        <div class="container-fluid">
            {{ Form::open(['route' => ['sub-attributes-options-update', $option->id], 'id' => 'main-form']) }}
            <div class="row">
                <div class="col-lg-6"><!-- first column -->
                    <div class="card custom-card create-wrapper">
                        <div class="card-header">
                            <h3>Add</h3>
                        </div>
                        <div class="card-body">
                                <div class="row"><!-- main row open-->
                                    <!-- opening of one field -->
                                    {!! Form::label('attribute', 'Feature: <span class="required-field"> *</span>', ['class' => 'col-xs-3 col-md-3'], false); !!}
                                    <div class="col-xs-9 col-md-9 form-group">
                                        {!! Form::select('subattribute_id', $features, $option->subattribute_id, ['class' => 'form-control drop', 'data-validation' => 'required', 'placeholder' => 'Select']) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    {!! Form::label('Color Name', 'Color Name: <span class="required-field"> *</span>', ['class' => 'col-xs-3 col-md-3'], false); !!}
                                    <div class="col-xs-9 col-md-9 form-group">
                                        {!! Form::text('label', $option->label, ['class' => 'form-control label', 'required' => 'required']) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    {!! Form::label('Color Value', 'Hex (# Not needed) <span class="required-field"> *</span>', ['class' => 'col-xs-3 col-md-3'], false); !!}
                                    <div class="col-xs-9 col-md-9 form-group">
                                        {!! Form::text('value', $option->value, ['minLength' => 6, 'maxLength' => 6, 'class' => 'form-control value', 'required' => 'required']) !!}
                                    </div>
                                </div>
                                <p class="text-right">
                                    <button id="btn-submit" class="btn custom-btn btn-success" type="submit">Submit</button>
                                </p>
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

    $('#btn-submit').on('click', function(e){
        e.preventDefault();
        const label = $('.label').val();
        const value = $('.value').val();
        const id = '{{ $option->id }}'
        if(label != '' && value != ''){
            $.ajax({
                method: 'GET',
                url: '{{route('sub-attributes-options-alreadyexits')}}',
                data: {label: label, value: value, id: id},
                success: function(data){
                    //console.log(data.status)
                    if(data.status){
                        alert(data.mesg)
                    }
                    else{
                        $('#main-form')[0].submit();
                    }
                },
                error: function (data) {
                    alert('Error Occurred!');
                }
            })
        }
        else{
            alert('Please enter color name and color hex value!');
        }
    });
</script>
@endsection
