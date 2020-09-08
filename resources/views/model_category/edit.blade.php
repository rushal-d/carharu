@extends('layouts.app')
@section('styles')

@endsection

@section('content')
    <section class="padding-block">
        <div class="container-fluid">
            {{ Form::open(['route' => ['category.update', $category->id], 'method' => 'PATCH']) }}
            <div class="row">
                <div class="col-lg-6"><!-- first column -->
                    <div class="card custom-card create-wrapper">
                        <div class="card-header">
                            <h3>Add a Category</h3>
                        </div>
                        <div class="card-body">
                            <div class="contact-form">
                                <div class="row"><!-- main row open-->
                                    <!-- opening of one field -->
                                    {!! Form::label('category', 'Category: <span class="required-field"> *</span>', ['class' => 'col-xs-3 col-md-3'], false); !!}
                                    <div class="col-xs-9 col-md-9 form-group">
                                        {!! Form::text('category', $category->name, ['class' => 'form-control', 'data-validation' => 'required']) !!}
                                    </div>
                                    {!! Form::label('slug', 'Slug: <span class="required-field"></span>', ['class' => 'col-xs-3 col-md-3'], false); !!}
                                    <div class="col-xs-9 col-md-9 form-group">
                                        {!! Form::text('description', $category->slug, ['class' => 'disabled-field form-control', 'disabled' => 'disabled']) !!}
                                    </div>
                                    {!! Form::label('description', 'Description: <span class="required-field"></span>', ['class' => 'col-xs-3 col-md-3'], false); !!}
                                    <div class="col-xs-9 col-md-9 form-group">
                                        {!! Form::textarea('description', $category->description, ['class' => 'form-control', 'rows' => 4]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card custom-card create-wrapper">
                        <div class="card-header">
                            <h3>SEO</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    {!! Form::label('seo_title', 'SEO Title:', false); !!}
                                    {!! Form::textarea('seo_title', $category->seo_title ?? null, ['class' => 'form-control normalTextArea', 'rows' => '3']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    {!! Form::label('seo_description', 'SEO Description:', false); !!}
                                    {!! Form::textarea('seo_description', $category->seo_description ?? null, ['class' => 'form-control normalTextArea', 'rows' => '3']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="text-right">
                        <button class="btn custom-btn btn-success" type="submit">Update</button>
                        <a href="{{route('category.index')}}" class="btn custom-btn btn-clear" type="submit">Cancel</a>
                    </p>
                </div>
                {!! Form::close() !!}
            </div>
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
