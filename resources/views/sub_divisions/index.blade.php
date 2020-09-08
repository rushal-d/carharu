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
                            <h3 class="flex">Create a Sub-Division</h3>
                        </div>
                        <div class="card-body">
                            <!-- filter -->
                            {{ Form::open(['route' => 'sub-division.store', 'enctype' => 'multipart/form-data']) }}
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="row">
                                        {!! Form::label('division', 'Division: <span class="required-field"> *</span>', ['class' => 'col-xs-3 col-md-3'], false); !!}
                                        <div class="col-xs-9 col-md-9 form-group">
                                            {!! Form::select('division', $div, null, ['class' => 'form-control division', 'data-validation' => 'required', 'placeholder' => 'Select']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="row">
                                        {!! Form::label('name', 'Name: <span class="required-field"> *</span>', ['class' => 'col-xs-3 col-md-3'], false); !!}
                                        <div class="col-xs-9 col-md-9 form-group">
                                            {!! Form::text('name', null, ['class' => 'form-control', 'data-validation' => 'required']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="row">
                                        {!! Form::label('slug', 'Slug: <span class="required-field"></span>', ['class' => 'col-xs-3 col-md-3'], false); !!}
                                        <div class="col-xs-9 col-md-9 form-group">
                                            {!! Form::text('slug', null, ['class' => 'form-control', 'data-validation' => 'required', 'disabled' => 'disabled']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="row">
                                        {!! Form::label('seo_title', 'SEO Title: <span class="required-field"></span>', ['class' => 'col-xs-3 col-md-3'], false); !!}
                                        <div class="col-xs-9 col-md-9 form-group">
                                            {!! Form::text('seo_title', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="row">
                                        {!! Form::label('seo_description', 'SEO Description: <span class="required-field"></span>', ['class' => 'col-xs-3 col-md-3'], false); !!}
                                        <div class="col-xs-9 col-md-9 form-group">
                                            {!! Form::textarea('seo_description', null, ['class' => 'form-control normalTextArea', 'rows' => '5']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="row">
                                        {!! Form::label('description', 'Description: <span class="required-field"></span>', ['class' => 'col-xs-3 col-md-3'], false); !!}
                                        <div class="col-xs-9 col-md-9 form-group">
                                            {!! Form::textarea('description', null, ['class' => 'form-control normalTextArea', 'rows' => 5]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="text-right">
                                <button class="btn custom-btn btn-success" type="submit">Create</button>
                            </p>
                            {{Form::close()}}
                            <!-- filter ends -->
                        </div>
                    </div>
                    <div class="row mt-5">
                        @foreach($divisions as $division)
                            <div class="col-lg-3">
                                <div class="card create-wrapper custom-card">
                                    <div class="card-header">
                                        <h3>{{$division->name}}</h3>
                                    </div>
                                    <div class="card-body">
                                        @foreach($subs as $sub)
                                            @if($division->id == $sub->division_id)
                                                <p>{{$sub->name}}<a class="ml-2" href="{{route('sub-division.destroy', $sub->id)}}"><i class="fas fa-times"></i></a></p>
                                            @endif
                                        @endforeach
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

@section('scripts')
<script>
    $('.division').selectize();
</script>
@endsection


