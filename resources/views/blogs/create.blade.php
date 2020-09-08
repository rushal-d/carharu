@extends('layouts.app')
@section('styles')
    <style>
        img{
            max-height: 120px;
            display: inline-block;
            margin: 0 auto;
        }

        .selected-img{
            text-align: center;
        }

        .remove-image {
            margin: 0 auto;
            width: 150px;
            text-align: center;
            display: block;
        }

        .open-filemanager{
            display: block;
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <section class="padding-block">
        <div class="container-fluid">
            {{ Form::open(['route' => 'blogs.store', 'enctype' => 'multipart/form-data']) }}
            <div class="row">
                <div class="col-lg-8"><!-- first column -->
                    <div class="card custom-card create-wrapper">
                        <div class="card-header">
                            <h3>Write A Blog</h3>
                        </div>
                        <div class="card-body">
                            <div class="contact-form">
                                <div class="row"><!-- main row open-->
                                    <!-- opening of one field -->
                                    {!! Form::hidden('model_id', $model->model_id) !!}
                                    {!! Form::label('main_title', 'Main Title: <span class="required-field"> *</span>', ['class' => 'col-xs-2 col-md-2'], false); !!}
                                    <div class="col-xs-10 col-md-10 form-group">
                                        {!! Form::text('main_title', null, ['class' => 'form-control', 'data-validation' => 'required']) !!}
                                    </div>
                                    {!! Form::label('description', 'Description: <span class="required-field"></span>', ['class' => 'col-xs-2 col-md-2'], false); !!}
                                    <div class="col-xs-10 col-md-10 form-group">
                                        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mediafiles card">
                        <div class="card-body">
                            <h5 class="card-title">Featured Image</h5>

                            <div class="card-text">

                                <div class="form-group row">

                                    <div class="col-md-12 col-sm-12">
                                        <a class="text-primary open-filemanager" data-fancybox data-type="iframe" data-src="{{ asset('') }}filemanager/dialog.php?type=1&field_id=image&relative_url=1" href="javascript:;">Set Image</a>
                                        {{ Form::hidden('blog_image', null, array('id' => 'image', 'class' => 'form-control')) }}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p class="text-right mr-3">
                <button class="btn custom-btn btn-success" type="submit">Create</button>
                <a href="{{route('blogs.index')}}" class="btn custom-btn btn-clear" type="submit">Cancel</a>
            </p>
            {!! Form::close() !!}
        </div>
    </section>

@endsection

@section('scripts')
    <script>
        //responsive filemanager on select callback
        function responsive_filemanager_callback(field_id){
            var url = "{{ asset('') }}thumbs/" + jQuery('#'+field_id).val();
            var field = '#' + field_id;
            var fileManagerURL = jQuery(field).prev().data('src');
            jQuery(field).parent().find('.selected-img-box').remove();
            var selectedImg = '<div class="selected-img-box"><div class="selected-img"><a data-fancybox data-type="iframe" data-src="'+fileManagerURL+'" href="javascript:;">' +
                '<img src="'+ url +'"></a></div>';
            var selectedImgUpdate = '<p class="selected-img-update text-center">Click the image to edit or update</p>';
            var removeImg = '<a class="btn btn-sm btn-outline-danger remove-image"><i class="fas fa-minus"></i> Remove Image</a></div>';
            jQuery(field).after(selectedImg + selectedImgUpdate + removeImg);
        }
        //remove image
        $(document).on('click', '.remove-image', function(){
            var removeImage = $(this);
            vex.dialog.confirm({
                className: 'vex-theme-default', // Overwrites defaultOptions
                message: 'Are you absolutely sure you want to remove the image?',
                callback: function (value) {
                    if(value){
                        $(removeImage).parent().prev().val(''); //clear the value of image field
                        $(removeImage).parent().remove(); //remove image box
                    }
                }
            });
        });
    </script>
@endsection
