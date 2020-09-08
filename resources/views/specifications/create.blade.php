@extends('layouts.app')
@section('styles')

@endsection

@section('content')
    <section class="padding-block">
        <div class="container-fluid">
            {{ Form::open(['route' => 'specs.store']) }}
            <div class="row">
                <div class="col-lg-6"><!-- first column -->
                    <div class="card custom-card create-wrapper">
                        <div class="card-header">
                            <h3>Add a Specification</h3>
                        </div>
                        <div class="card-body">
                            <div class="contact-form">
                                <div class="row"><!-- main row open-->
                                    <!-- opening of one field -->
                                    {!! Form::label('specs', 'Specification: <span class="required-field"> *</span>', ['class' => 'col-xs-3 col-md-3'], false); !!}
                                    <div class="col-xs-9 col-md-9 form-group">
                                        {!! Form::text('specs', null, ['class' => 'form-control', 'data-validation' => 'required']) !!}
                                    </div>
                                </div>
                                <p class="text-right">
                                    <button class="btn custom-btn btn-success" type="submit">Create</button>
                                    <a href="{{route('specs.index')}}" class="btn custom-btn btn-clear" type="submit">Cancel</a>
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

@endsection
