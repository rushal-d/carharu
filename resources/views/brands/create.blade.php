@extends('layouts.app')
@section('styles')

@endsection

@section('content')
    <section class="padding-block">
        <div class="container-fluid">
            {{ Form::open(['route' => 'brand.store', 'enctype' => 'multipart/form-data']) }}
            <div class="row">
                <div class="col-lg-8"><!-- first column -->
                    <div class="card custom-card create-wrapper">
                        <div class="card-header">
                            <h3>Add a Brand</h3>
                        </div>
                        <div class="card-body">
                            <div class="contact-form">
                                <div class="row"><!-- main row open-->
                                    <!-- opening of one field -->
                                    {!! Form::label('brand_name', 'Brand Name: <span class="required-field"> *</span>', ['class' => 'col-xs-2 col-md-2'], false); !!}
                                    <div class="col-xs-10 col-md-10 form-group">
                                        {!! Form::text('brand_name', null, ['class' => 'form-control', 'data-validation' => 'required']) !!}
                                    </div>
                                    {!! Form::label('slug', 'Slug: <span class="required-field"> *</span>', ['class' => 'col-xs-2 col-md-2'], false); !!}
                                    <div class="col-xs-10 col-md-10 form-group">
                                        {!! Form::text('slug', null, ['class' => 'form-control', 'data-validation' => 'required', 'disabled' => 'disabled']) !!}
                                    </div>
                                    {!! Form::label('brand_description', 'Brand Description: <span class="required-field"></span>', ['class' => 'col-xs-2 col-md-2'], false); !!}
                                    <div class="col-xs-10 col-md-10 form-group">
                                        {!! Form::textarea('brand_description', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card custom-card create-wrapper">
                        <div class="card-header">
                            <h3>SEO</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    {!! Form::label('seo_title', 'SEO Title:', false); !!}
                                    {!! Form::textarea('seo_title', null, ['class' => 'form-control normalTextArea', 'rows' => '3']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    {!! Form::label('seo_description', 'SEO Description:', false); !!}
                                    {!! Form::textarea('seo_description', null, ['class' => 'form-control normalTextArea', 'rows' => '3']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card custom-card create-wrapper shadow">
                        <div class="card-header">
                            <h3>Brand Image(Only One)</h3>
                        </div>
                        <div class="card-body">
                            <div class="input-group col-12 text-center">
                                <a style="color: #0c0e10 !important;" class="text-primary btn btn-info btn-sm" data-fancybox data-type="iframe"
                                   data-src="{{ asset('') }}filemanager/dialog.php?type=0&field_id=brand_image&relative_url=1"
                                   href="javascript:;">Select Image</a>
                                {{ Form::hidden('brand_image', '', array('id' => 'brand_image', 'class' => 'form-control')) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p class="text-right">
                <button class="btn custom-btn btn-success" type="submit">Create</button>
                <a href="{{route('brand.index')}}" class="btn custom-btn btn-clear" type="submit">Cancel</a>
            </p>
            {!! Form::close() !!}
        </div>
    </section>

@endsection

@section('scripts')
    <script>
        //File Manager
        function responsive_filemanager_callback(field_id) {
            var url = "{{ asset('') }}thumbs/" + jQuery('#' + field_id).val();
            var files = jQuery('#' + field_id).val();
            console.log(files);
            if (files.indexOf('[') !== -1) {
                var mFiles = JSON.parse(files);
                mFiles.forEach(function (file) {
                    var ext = file.split(".");
                    ext = (ext[(ext.length) - 1]);
                    var filePath = "{{ asset('') }}thumbs/" + file;
                    var docs = '<input type="hidden" name="docs[]" value="' + file + '"/>';
                    var field = '#' + field_id;
                    var fileManagerURL = jQuery(field).prev().data('src');
                    //jQuery(field).parent().find('.selected-img-box').remove();
                    var selectedImg = '<div class="selected-img-box col-4"  data-toggle="tooltip" data-placement="top" title="' + file + '"><div class="selected-img">';

                    if (ext == 'jpg' || ext == 'jpeg' || ext == 'png') {
                        selectedImg += '<a data-fancybox data-type="iframe" data-src="' + fileManagerURL + '" href="javascript:;">' +
                            '<img src="' + filePath + '" class="img-fluid">' +
                            '</a>';
                    } else if (ext == 'doc' || ext == 'docx') {
                        selectedImg += '<a data-fancybox data-type="iframe" data-src="' + fileManagerURL + '" href="javascript:;">' +
                            '<i class="fas fa-file-word fa-4x"></i>' +
                            '</a>';
                    } else {
                        selectedImg += '<a data-fancybox data-type="iframe" data-src="' + fileManagerURL + '" href="javascript:;">' +
                            '<i class="fas fa-file-pdf fa-4x"></i>' +
                            '</a>';
                    }
                    selectedImg += '</div>';

                    var removeImg = '<a class="btn btn-sm btn-outline-danger remove-image"><i class="fas fa-minus"></i></a></div>';
                    jQuery(field).parent().after(docs + selectedImg + removeImg);
                });

            } else {
                var filePath = "{{ asset('') }}thumbs/" + files;
                var docs = '<input type="hidden" name="docs[]" value="' + files + '"/>';
                var ext = files.split(".");
                ext = (ext[(ext.length) - 1]);
                var field = '#' + field_id;
                var fileManagerURL = jQuery(field).prev().data('src');
                // jQuery(field).parent().find('.selected-img-box').remove();
                var selectedImg = '<div class="selected-img-box col-4"  data-toggle="tooltip" data-placement="top" title="' + files + '"><div class="selected-img">';

                if (ext == 'jpg' || ext == 'jpeg' || ext == 'png') {
                    selectedImg += '<a data-fancybox data-type="iframe" data-src="' + fileManagerURL + '" href="javascript:;">' +
                        '<img src="' + filePath + '" class="img-fluid">' +
                        '</a>';
                } else if (ext == 'doc' || ext == 'docx') {
                    selectedImg += '<a data-fancybox data-type="iframe" data-src="' + fileManagerURL + '" href="javascript:;">' +
                        '<i class="fas fa-file-word fa-4x"></i>' +
                        '</a>';
                } else {
                    selectedImg += '<a data-fancybox data-type="iframe" data-src="' + fileManagerURL + '" href="javascript:;">' +
                        '<i class="fas fa-file-pdf fa-4x"></i>' +
                        '</a>';
                }
                selectedImg += '</div>';
                var removeImg = '<a class="btn btn-sm btn-outline-danger remove-image"><i class="fas fa-minus"></i></a></div>';
                jQuery(field).parent().after(selectedImg + docs + removeImg);
            }
            $('.selected-img-box').tooltip();
        }

        //remove image
        $(document).on('click', '.remove-image', function () {
            var removeImage = $(this);
            vex.dialog.confirm({
                className: 'vex-theme-default', // Overwrites defaultOptions
                message: 'Are you absolutely sure you want to remove the image?',
                callback: function (value) {
                    if (value) {
                        $(removeImage).parent().prev().val(''); //clear the value of image field
                        $(removeImage).parent().remove(); //remove image box
                    }
                }
            });
        });
    </script>

@endsection
