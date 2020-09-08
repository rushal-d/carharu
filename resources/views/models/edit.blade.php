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

        .img-fluid{
            max-width: 150px;
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
            {{ Form::open(['route' => ['model.update', $model->model_id], 'method' => 'PATCH']) }}
            <section>
                <div class="row">
                    <div class="col-lg-9"><!-- first column -->
                        <div class="card custom-card create-wrapper">
                            <div class="card-header">
                                <h3>Add a Model</h3>
                            </div>
                            <div class="card-body">
                                <div class="contact-form">
                                    <div class="row"><!-- main row open-->

                                        <div class="col-lg-6">
                                            <div class="row">
                                                {!! Form::label('model_name', 'Model Name: <span class="required-field"></span>', ['class' => 'col-xs-3 col-md-3'], false); !!}
                                                <div class="col-xs-9 col-md-9 form-group">
                                                    {!! Form::text('model_name', $model->model_name, ['class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <a href="{{ $model->permalink }}"  target="_blank" class="btn btn-outline-primary">Preview</a>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="row">
                                                {!! Form::label('model_description', 'Model Description: <span class="required-field"></span>', ['class' => 'col-xs-12 col-md-12'], false); !!}
                                                <div class="col-xs-12 col-md-12 form-group">
                                                    {!! Form::textarea('model_description', $model->model_description, ['class' => 'form-control', 'rows' => '4']) !!}
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card custom-card">
                            <div class="card-header"><h3>Available Colors</h3></div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="ml-4 mt-2 required-field">* Color option must have both color and image</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="add-new-color-container text-right m-2">
                                        <a href="javascript:;" data-toggle="modal" data-target="#color-form" class="btn btn-outline-dark"><i class="fa fa-plus-circle"></i> Add New Color</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="choose-color-box-container">
                                            @foreach($model->colorImages as $key => $colorImage)
                                            <div class="choose-color-box">
                                                <div class="choose-color-box-wrapper">
                                                    @php $fileManagerURL = asset('') . 'filemanager/dialog.php?type=1&field_id=color_images['.$key.']&relative_url=1'; @endphp
                                                    <select required name="color_options[]" class="choose-color" placeholder="Pick a color...">
                                                        <option selected value="{{ $colorImage->subattribute_option_id }}">{{ $colorImage->attribute->label }}</option>
                                                    </select>
                                                    <input type="hidden" value="{{ $colorImage->id }}" name="color_ids[]">
                                                    <a  class="btn btn-success" data-index="{{ $key }}" data-fancybox data-type="iframe"
                                                       data-src="{{ $fileManagerURL }}"
                                                       href="javascript:;">Choose Image</a>
                                                    <input name="color_images_tmp[]" type="hidden" id="color_images[{{ $key }}]">
                                                    @php

                                                    if (!empty($colorImage->image)) {
                                                            $image = $colorImage->image;
                                                            $image_title = $image->title;
                                                            $root = asset('');
                                                            $img = $image->image;
                                                            $docs = '<input type="hidden" name="color_images['.$key.'][]" value="' . $img . '"/>';
                                                            $fullImgURL = $root . '/thumbs/' . $img;
                                                            $thumbImgURL = $root . '/uploads/' . $img;
                                                            $selectedImg = '<div class="selected-img-box"><div class="selected-img"><a data-fancybox data-type="iframe" data-src="' . $fileManagerURL . '" href="javascript:;">
                                                              <img class="table-image" src="' . $fullImgURL . '"></a></div>';
                                                            $removeImg = '<a class="btn btn-sm btn-outline-danger remove-image"><i class="fas fa-minus"></i> Remove Image</a></div>';
                                                            $selectedImg .= '<input placeholder="Title" class="form-control selected-img-title" value="'.$image_title.'" type="text" name="title_color_images[]">';
                                                            $selectedImg .= '<input type="hidden" value="'.$image->id.'" type="text" name="color_images_ids[]">';
                                                            $removeImg .= '<a data-toggle="tooltip" data-placement="top" title="Remove Color and Image" class="btn btn-sm btn-warning remove-color-box" href="javascript:;"><i class="fa fa-minus"></i></a>';
                                                            echo $selectedImg . $docs . $removeImg;

                                                    }
                                                    @endphp
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="repeater-actions text-left">
                                            <a class="btn btn-sm btn-primary add-color-block" href="javascript:;"><i class="fa fa-plus"></i> Add More Color</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card custom-card create-wrapper inline-images-upload-box">
                            <div class="card-header">
                                <h3>Interior Images (Multiple)</h3>
                            </div>
                            <div class="card-body">

                                <div class="input-group col-12 text-center">
                                    <div class="col-md-12 text-left">
                                        <a class="btn btn-success" data-fancybox data-type="iframe"
                                           data-src="{{ asset('') }}filemanager/dialog.php?type=0&field_id=interior_images&relative_url=1"
                                           href="javascript:;">Choose Image</a>
                                    </div>
                                    {{ Form::hidden('interior_images_tmp[]', '', array('id' => 'interior_images', 'class' => 'form-control')) }}
                                        <?php
                                        $fileManagerURL = asset('') . 'filemanager/dialog.php?type=1&field_id=interior_images&relative_url=1';
                                        if (!empty($interior_images)) {
                                            foreach ($interior_images as $image){
                                                $image_title = $image->title;
                                                $root = asset('');
                                                $img = $image->image;
                                                $docs = '<input type="hidden" name="interior_images[]" value="' . $img . '"/>';
                                                $fullImgURL = $root . '/thumbs/' . $img;
                                                $thumbImgURL = $root . '/uploads/' . $img;
                                                $selectedImg = '<div class="selected-img-box"><div class="selected-img"><a data-fancybox data-type="iframe" data-src="' . $fileManagerURL . '" href="javascript:;">
                                                              <img class="table-image" src="' . $fullImgURL . '"></a></div>';
                                                $removeImg = '<a class="btn btn-sm btn-outline-danger remove-image"><i class="fas fa-minus"></i> Remove Image</a></div>';
                                                $selectedImg .= '<input placeholder="Title" class="form-control selected-img-title" value="'.$image_title.'" type="text" name="interior_images_title[]">';
                                                $selectedImg .= '<input type="hidden" value="'.$image->id.'" type="text" name="interior_images_ids[]">';
                                                echo $selectedImg . $docs . $removeImg;
                                            }
                                        }
                                        ?>

                                </div>
                            </div>
                        </div>

                        <div class="card custom-card create-wrapper inline-images-upload-box">
                            <div class="card-header">
                                <h3>Exterior Images (Multiple)</h3>
                            </div>
                            <div class="card-body">

                                <div class="input-group col-12 text-center">
                                    <div class="col-md-12 text-left">
                                        <a class="btn btn-success" data-fancybox data-type="iframe"
                                           data-src="{{ asset('') }}filemanager/dialog.php?type=0&field_id=exterior_images&relative_url=1"
                                           href="javascript:;">Choose Image</a>
                                    </div>
                                    {{ Form::hidden('exterior_images_tmp[]', '', array('id' => 'exterior_images', 'class' => 'form-control')) }}
                                    <?php
                                    $fileManagerURL = asset('') . 'filemanager/dialog.php?type=1&field_id=exterior_images&relative_url=1';
                                    if (!empty($exterior_images)) {
                                        foreach ($exterior_images as $image){
                                            $image_title = $image->title;
                                            $root = asset('');
                                            $img = $image->image;
                                            $docs = '<input type="hidden" name="exterior_images[]" value="' . $img . '"/>';
                                            $fullImgURL = $root . '/thumbs/' . $img;
                                            $thumbImgURL = $root . '/uploads/' . $img;
                                            $selectedImg = '<div class="selected-img-box"><div class="selected-img"><a data-fancybox data-type="iframe" data-src="' . $fileManagerURL . '" href="javascript:;">
                                                              <img class="table-image" src="' . $fullImgURL . '"></a></div>';
                                            $removeImg = '<a class="btn btn-sm btn-outline-danger remove-image"><i class="fas fa-minus"></i> Remove Image</a></div>';
                                            $selectedImg .= '<input placeholder="Title" class="form-control selected-img-title" value="'.$image_title.'" type="text" name="exterior_images_title[]">';
                                            $selectedImg .= '<input type="hidden" value="'.$image->id.'" type="text" name="exterior_images_ids[]">';
                                            echo $selectedImg . $docs . $removeImg;
                                        }
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>

                        <div class="card custom-card create-wrapper inline-images-upload-box">
                            <div class="card-header">
                                <h3>Other Images (Multiple)</h3>
                            </div>
                            <div class="card-body">

                                <div class="input-group col-12 text-center">
                                    <div class="col-md-12 text-left">
                                        <a class="btn btn-success" data-fancybox data-type="iframe"
                                           data-src="{{ asset('') }}filemanager/dialog.php?type=0&field_id=other_images&relative_url=1"
                                           href="javascript:;">Choose Image</a>
                                    </div>
                                    {{ Form::hidden('other_images_tmp[]', '', array('id' => 'other_images', 'class' => 'form-control')) }}
                                    <?php
                                    $fileManagerURL = asset('') . 'filemanager/dialog.php?type=1&field_id=other_images&relative_url=1';
                                    if (!empty($other_images)) {
                                        foreach ($other_images as $image){
                                            $image_title = $image->title;
                                            $root = asset('');
                                            $img = $image->image;
                                            $docs = '<input type="hidden" name="other_images[]" value="' . $img . '"/>';
                                            $fullImgURL = $root . '/thumbs/' . $img;
                                            $thumbImgURL = $root . '/uploads/' . $img;
                                            $selectedImg = '<div class="selected-img-box"><div class="selected-img"><a data-fancybox data-type="iframe" data-src="' . $fileManagerURL . '" href="javascript:;">
                                                              <img class="table-image" src="' . $fullImgURL . '"></a></div>';

                                            $removeImg = '<a class="btn btn-sm btn-outline-danger remove-image"><i class="fas fa-minus"></i> Remove Image</a></div>';
                                            $selectedImg .= '<input placeholder="Title" class="form-control selected-img-title" value="'.$image_title.'" type="text" name="other_images_title[]">';
                                            $selectedImg .= '<input type="hidden" value="'.$image->id.'" type="text" name="other_images_ids[]">';
                                            echo $selectedImg . $docs  . $removeImg;
                                        }
                                    }
                                    ?>

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
                                        {!! Form::textarea('seo_title', $model->seo_title ?? null, ['class' => 'form-control normalTextArea', 'rows' => '3']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        {!! Form::label('seo_description', 'SEO Description:', false); !!}
                                        {!! Form::textarea('seo_description', $model->seo_description ?? null, ['class' => 'form-control normalTextArea', 'rows' => '3']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-3">


                        <div class="card">
                            <div class="card-header"><h3>Other Details</h3></div>
                            <div class="card-body">
                                <div class="col-lg-12">
                                    <div class="row">
                                        {!! Form::label('brand_name', 'Brand: <span class="required-field"> *</span>', ['class' => 'col-xs-3 col-md-3'], false); !!}
                                        <div class="col-xs-9 col-md-9 form-group">
                                            {!! Form::select('brand_name', $brands, $model->brand_id, ['class' => 'form-control selectize-select', 'placeholder' => 'Select brand', 'data-validation' => 'required']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        {!! Form::label('model_body_type', 'Body Type: <span class="required-field"></span>', ['class' => 'col-xs-3 col-md-3'], false); !!}
                                        <div class="col-xs-9 col-md-9 form-group">
                                            {!! Form::select('model_body_type', $body_type, $model->model_body_type_id, ['class' => 'form-control  selectize-select', 'placeholder' => 'Select body type', 'data-validation' => 'required']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        {!! Form::label('launch_date', 'Launch Date: <span class="required-field"></span>', ['class' => 'col-xs-3 col-md-3'], false); !!}
                                        <div class="col-xs-9 col-md-9 form-group">
                                            {!! Form::date('launch_date', $model->launch_date, ['class' => 'form-control date', 'placeholder' => 'Pick launch date']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h3>Set Featured Image</h3>
                            </div>
                            <div class="card-body">
                                {!! Form::label('model_image', 'Featured Image: <span class="required-field">*</span>', ['class' => 'col-xs-12 col-md-12'], false); !!}
                                <div class="card-text">
                                    <div class="form-group row">
                                        <div class="col-md-12 col-sm-12">
                                            <?php $fileManagerURL = asset('') . 'filemanager/dialog.php?type=1&field_id=model_image&relative_url=1&multiple=false'; ?>
                                            <a class="btn btn-success open-filemanager" data-fancybox
                                               data-type="iframe"
                                               data-src="{{$fileManagerURL}}"
                                               href="javascript:;">Set Image</a>
                                            {{ Form::hidden('model_image_tmp[]', null, array('id' => 'model_image', 'class' => 'form-control single')) }}

                                            <?php
                                            if (!empty($model->model_image)) {
                                                $model_image_title = $model->model_image_title;
                                                $root = asset('');
                                                $img = $model->model_image;
                                                $docs = '<input type="hidden" name="model_image[]" value="' . $img . '"/>';
                                                $fullImgURL = $root . '/thumbs/' . $img;
                                                $thumbImgURL = $root . '/uploads/' . $img;
                                                $selectedImgUpdate = '<p class="selected-img-update">Click the image to edit or update</p>';
                                                $selectedImg = '<div class="selected-img-box"><div class="selected-img"><a data-fancybox data-type="iframe" data-src="' . $fileManagerURL . '" href="javascript:;">
                                                              <img class="table-image" src="' . $fullImgURL . '"></a></div>';
                                                $removeImg = '<a class="btn btn-sm btn-outline-danger remove-image"><i class="fas fa-minus"></i> Remove Image</a></div>';
                                                $selectedImg .= '<input placeholder="Title" class="form-control selected-img-title" value="'.$model_image_title.'" type="text" name="model_image_title[]">';
                                                echo  $selectedImg . $selectedImgUpdate.  $docs . $removeImg;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <p class="text-right mt-1">
                            <button class="btn btn-success btn-lg" type="submit">Update</button>
                            <a style="color:#ffffff;" href="{{route('model.index')}}" class="btn btn-danger btn-lg" type="submit">Cancel</a>
                        </p>

                    </div>
                </div>
            </section>

            {!! Form::close() !!}
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="color-form" tabindex="-1" role="dialog" aria-labelledby="color-form" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add new color</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @include('sub_attributes.createform')
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('sub_attributes.createformscript')
    <script>
        const selectionColorOptions = {
            valueField: 'id',
            labelField: 'label',
            searchField: 'label',
            options: [],
            create: false,
            preload: true,
            render: {
                option: function(item, escape) {
                    //console.log(item)
                    return '<div class="color-options">' +
                        '<div style="width:32px; height:32px; background: #'+item.value+';" class="color-options-box"></div>'+
                        '<div class="color-options-label">'+item.label+'</div>'+
                        '</div>';
                }
            },
            load: function(query, callback) {
                //if (!query.length) return callback();
                $.ajax({
                    url: '{{ route('all-colors') }}',
                    type: 'POST',
                    data: {_token : '{{ csrf_token() }}', search: encodeURIComponent(query)},
                    error: function() {
                        callback();
                    },
                    success: function(res) {
                        callback(res.colors);
                    }
                });
            }
        };
        $('.choose-color').selectize(selectionColorOptions);
        $('.date').flatpickr();
        $('.selectize-select').selectize({
            plugins: ['remove_button'],
            maxItems: 1,
        });

        //File Manager
        function responsive_filemanager_callback(field_id) {
            field_id = field_id.replace(/\\|\//g,'');
            var url = "{{ asset('') }}thumbs/" + jQuery('#' + field_id).val();
            var files = document.getElementById(field_id).value;
            if (files.indexOf('[') !== -1) { //multiple files
                var mFiles = JSON.parse(files);
                mFiles.forEach(function (file) {
                    var fileNameWithoutExt = (file.substr(0, file.lastIndexOf(".")));
                    fileNameWithoutExt = fileNameWithoutExt.substring(fileNameWithoutExt.lastIndexOf('/')+1);
                    var ext = file.split(".");
                    ext = (ext[(ext.length) - 1]);
                    var filePath = "{{ asset('') }}thumbs/" + file;
                    var docs = '<input type="hidden" name="'+field_id+'[]" value="' + file + '"/>';
                    var field = '#' + $.escapeSelector(field_id);
                    var fileManagerURL = jQuery(field).prev().data('src');
                    //jQuery(field).parent().find('.selected-img-box').remove();
                    var selectedImg = '<div class="selected-img-box"  data-toggle="tooltip" data-placement="top" title="' + file + '"><div class="selected-img">';

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
                    //different case for color images -- double array index doesnt work
                    if(field_id.indexOf('color_images') !== -1){
                        selectedImg += '<input value="'+ fileNameWithoutExt +'" placeholder="Title" class="form-control selected-img-title" type="text" name="title_'+field_id+'"></div>';
                    }
                    else{
                        selectedImg += '<input value="'+ fileNameWithoutExt +'" placeholder="Title" class="form-control selected-img-title" type="text" name="'+field_id+'_title[]"></div>';
                    }

                    var removeImg = '<a class="btn btn-sm btn-outline-danger remove-image"><i class="fas fa-minus"></i></a></div>';
                    jQuery(field).after(docs + selectedImg + removeImg);
                });

            } else {
                var fileNameWithoutExt = (files.substr(0, files.lastIndexOf(".")));
                fileNameWithoutExt = fileNameWithoutExt.substring(fileNameWithoutExt.lastIndexOf('/')+1);
                var filePath = "{{ asset('') }}thumbs/" + files;
                var docs = '<input type="hidden" name="'+field_id+'[]" value="' + files + '"/>';
                var ext = files.split(".");
                ext = (ext[(ext.length) - 1]);
                var field = '#' + $.escapeSelector(field_id);
                var fileManagerURL = jQuery(field).prev().data('src');
                // jQuery(field).parent().find('.selected-img-box').remove();
                var selectedImg = '<div class="selected-img-box"  data-toggle="tooltip" data-placement="top" title="' + files + '"><div class="selected-img">';

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
                //different case for color images -- double array index doesnt work
                if(field_id.indexOf('color_images') !== -1){
                    selectedImg += '<input value="'+ fileNameWithoutExt +'" placeholder="Title" class="form-control selected-img-title" type="text" name="title_'+field_id+'"></div>';
                }
                else{
                    selectedImg += '<input value="'+ fileNameWithoutExt +'" placeholder="Title" class="form-control selected-img-title" type="text" name="'+field_id+'_title[]"></div>';
                }
                var removeImg = '<a class="btn btn-sm btn-outline-danger remove-image"><i class="fas fa-minus"></i></a></div>';
                jQuery(field).after(selectedImg + docs + removeImg);
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
                        $(removeImage).parent().remove(); //remove image box
                    }
                }
            });
        });

        const baseURL = '{{ asset('') }}';
        $(document).on('click', '.add-color-block', function(){
            var lastIndex = parseInt($('.choose-color-box-container').find('.btn-success').last().data('index')) + 1;
            console.log(lastIndex);
            if(lastIndex == undefined || Number.isNaN(lastIndex)){
                lastIndex = 0;
            }
            const repeaterBlock = '<div class="choose-color-box"><div class="choose-color-box-wrapper">' +
                '                                    <select required name="color_options[]" class="choose-color" placeholder="Pick a color..."></select>' +
                '                                    <a class="btn btn-success" data-index="'+lastIndex+'" data-fancybox data-type="iframe"' +
                '                                       data-src="'+ baseURL +'filemanager/dialog.php?type=0&field_id=color_images['+lastIndex+']&relative_url=1"' +
                '                                       href="javascript:;">Choose Image</a>' +
                '                                    <input name="color_images_tmp[]" type="hidden" id="color_images['+lastIndex+']">' +
                '                                <a data-toggle="tooltip" data-placement="top" title="Remove Color and Image" class="btn btn-sm btn-warning remove-color-box" href="javascript:;"><i class="fa fa-minus"></i></a></div></div>';

            $('.choose-color-box-container').append(repeaterBlock);
            $('.choose-color-box:last-child .choose-color').selectize(selectionColorOptions);
            $('.remove-color-box').tooltip();
        });
        $('.remove-color-box').tooltip();
        $(document).on('click', '.remove-color-box', function(){
            var _this = $(this);
            vex.dialog.confirm({
                className: 'vex-theme-default', // Overwrites defaultOptions
                message: 'Are you absolutely sure you want to remove the color option?',
                callback: function (value) {
                    if (value) {
                        $(_this).parent().parent().remove();
                    }
                }
            });

        });

    </script>
@endsection
