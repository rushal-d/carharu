@extends('layouts.app')
@section('styles')

@endsection

@section('content')
    <section class="padding-block">
        <div class="container-fluid">
            {{ Form::open(['route' => ['divisions.update', $division->id], 'enctype' => 'multipart/form-data', 'method' => 'PATCH']) }}
            <div class="row">
                <div class="col-lg-8"><!-- first column -->
                    <div class="card custom-card create-wrapper">
                        <div class="card-header">
                            <h3>Update Division</h3>
                        </div>
                        <div class="card-body">
                            <div class="contact-form">
                                <div class="row"><!-- main row open-->
                                    <!-- opening of one field -->
                                    {!! Form::label('Name', 'Name: <span class="required-field"> *</span>', ['class' => 'col-xs-2 col-md-2'], false); !!}
                                    <div class="col-xs-10 col-md-10 form-group">
                                        {!! Form::text('name', $division->name ?? null, ['class' => 'form-control', 'data-validation' => 'required']) !!}
                                    </div>
                                    {!! Form::label('slug', 'Slug: <span class="required-field"> *</span>', ['class' => 'col-xs-2 col-md-2'], false); !!}
                                    <div class="col-xs-10 col-md-10 form-group">
                                        {!! Form::text('slug', $division->slug ?? null, ['class' => 'form-control disabled-field', 'data-validation' => 'required', 'disabled' => 'disabled']) !!}
                                    </div>
                                    {!! Form::label('description', 'Description: <span class="required-field"></span>', ['class' => 'col-xs-2 col-md-2'], false); !!}
                                    <div class="col-xs-10 col-md-10 form-group">
                                        {!! Form::textarea('description', $division->description ?? null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                            <p class="text-right">
                                <button class="btn custom-btn btn-success" type="submit">Update</button>
                                <a href="{{route('divisions.index')}}" class="btn custom-btn btn-clear" type="submit">Cancel</a>
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
        $(document).ready(function() {
            $('body').on('dblclick','.disabled-field', function () {
                $(this).prop('disabled', false);
                $(this).focus();
            });
        });
    </script>

@endsection
