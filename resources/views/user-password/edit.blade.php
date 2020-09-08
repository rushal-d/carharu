@extends('layouts.app')

@section('styles')
    @parent()
    <link href="{{asset('assets/selectize/dist/css/selectize.bootstrap3.css') }}" type="text/css" rel="stylesheet"/>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="custom-color">
                        <h6><i class="far fa-plus-square"></i> Add Users</h6>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-offset-2">
                            {!! Form::model($user,['route' => ['user-password.update', $user->id], 'enctype'=>"multipart/form-data",
                          'id'=>'maindiv', 'method' => 'PATCH' ]) !!}
                            <div class="form-group row col-md-12">
                                {!! Form::label('name', 'Name', ['class' => 'col-md-3']) !!}
                                <div class="col-md-9">
                                    <p>{{$user->name}}</p>
                                </div>
                            </div>
                            <div class="form-group row col-md-12">
                                {!! Form::label('username', 'User Name', ['class' => 'col-md-3']) !!}
                                <div class="col-md-9">
                                    <p>{{$user->username}}</p>
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
                                {!! Form::label('email', 'Email Address', ['class' => 'col-md-3']) !!}
                                <div class="col-md-9">
                                    <p>{{$user->email}}</p>
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
                                <label for="mobile_number" class="col-md-3">Mobile Number</label>
                                <div class="col-md-9">
                                    <p>{{$user->mobile_number}}</p>
                                </div>
                            </div>

                            @if(!auth()->user()->hasRole('Administrator'))
                                <div class="form-group row col-md-12">
                                    {!! Form::label('old_password', 'Old Password', ['class' => 'col-md-3']) !!}
                                    <div class="col-md-9">
                                        {!! Form::password('old_password', ['class' => 'form-control ', 'placeholder' => 'Enter Old Password', 'required', 'data-validation' => 'required']) !!}
                                    </div>
                                </div>
                            @else
                                {!! Form::hidden('is_admin_changed', 1) !!}
                            @endif

                            <div class="form-group row col-md-12">
                                {!! Form::label('password', 'Password', ['class' => 'col-md-3']) !!}
                                <div class="col-md-9">
                                    {!! Form::password('password', ['class' => 'form-control ', 'placeholder' => 'Enter Password', 'required', 'data-validation' => 'required']) !!}
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
                                {!! Form::label('password_confirmation', 'Confirm Password', ['class' => 'col-md-3']) !!}
                                <div class="col-md-9">
                                    {!! Form::password('password_confirmation', ['class' => 'form-control ', 'placeholder' => 'Enter Password Again', 'data-validation' => 'required']) !!}
                                </div>
                            </div>

                            <div style="text-align: center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{route('user.index')}}" type="reset" class="btn btn-outline-secondary"
                                   value="Reset">Cancel
                                </a>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent()
    <script src="{{ asset('assets/selectize/dist/js/standalone/selectize.js') }}"></script>

    <script>
        $('select').selectize({});
    </script>
@endsection
