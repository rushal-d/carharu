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
            {{ Form::open(['route' => ['model.updatevariant', $model->model_id], 'enctype' => 'multipart/form-data', 'method' => 'PATCH']) }}
            <section id="tabs" class="project-tab">
                <div class="row">
                    <div class="col-md-12">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Basic Info</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Specifications</a>
                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Attributes</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="row">
                                    <div class="col-lg-7"><!-- first column -->
                                        <div class="card custom-card create-wrapper">
                                            <div class="card-header">
                                                <h3>Edit Model</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="contact-form">
                                                    <div class="row"><!-- main row open-->
                                                        <!-- opening of one field -->
                                                        <div class="col-lg-6">
                                                            <div class="row">
                                                                {!! Form::label('model_name', 'Model Name: <span class="required-field">*</span>', ['class' => 'col-xs-3 col-md-3'], false); !!}
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
                                    <div class="col-lg-5">

                                        <div class="card">
                                            <div class="card-header"><h3>Other Details</h3></div>
                                            <div class="card-body">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        {!! Form::label('parent_model', 'Parent Model: <span class="required-field">*</span>', ['class' => 'col-xs-3 col-md-3'], false); !!}
                                                        <div class="col-xs-9 col-md-9 form-group">
                                                            {!! Form::select('parent_model', $models, $model->parent_id, ['class' => 'form-control down', 'placeholder' => 'Select model']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        {!! Form::label('fuel_type', 'Fuel Type: <span class="required-field">*</span>', ['class' => 'col-xs-3 col-md-3'], false); !!}
                                                        <div class="col-xs-9 col-md-9 form-group">
                                                            {!! Form::select('fuel_type[]', $fuel_type, $model->fuels, ['multiple' => 'multiple', 'class' => 'form-control trans', 'placeholder' => 'Select body type', 'required' => 'required']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        {!! Form::label('transmission_type', 'Transmission Type: <span class="required-field">*</span>', ['class' => 'col-xs-3 col-md-3'], false); !!}
                                                        <div class="col-xs-9 col-md-9 form-group">
                                                            {!! Form::select('transmission_type[]', $transmission_type, $model->transmissions, ['multiple' => 'multiple', 'class' => 'form-control trans', 'placeholder' => 'Select type', 'required' => 'required']) !!}
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
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        {!! Form::label('price', 'Price (NPR): <span class="required-field">*</span>', ['class' => 'col-xs-3 col-md-3'], false); !!}
                                                        <div class="col-xs-9 col-md-9 form-group">
                                                            {!! Form::text('price', doubleval($model->price), ['class' => 'form-control']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        {!! Form::label('mileage', 'Mileage (KM/L): <span class="required-field">*</span>', ['class' => 'col-xs-3 col-md-3'], false); !!}
                                                        <div class="col-xs-9 col-md-9 form-group">
                                                            {!! Form::text('mileage', doubleval($model->mileage), ['class' => 'form-control']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        {!! Form::label('engine', 'Engine (CC): <span class="required-field">*</span>', ['class' => 'col-xs-3 col-md-3'], false); !!}
                                                        <div class="col-xs-9 col-md-9 form-group">
                                                            {!! Form::text('engine', doubleval($model->engine), ['class' => 'form-control']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        {!! Form::label('seats', 'Seats: <span class="required-field">*</span>', ['class' => 'col-xs-3 col-md-3'], false); !!}
                                                        <div class="col-xs-9 col-md-9 form-group">
                                                            {!! Form::number('seats', $model->seats, ['class' => 'form-control']) !!}
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
                                                            <?php  $fileManagerURL = asset('') . 'filemanager/dialog.php?type=1&field_id=model_image&relative_url=1&multiple=false'; ?>
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


                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div class="row">
                                    @foreach($specs as $spec)
                                        @if($spec->id !== 6)
                                            <div class="col-lg-3 col-md-4 col-sm-2 col-12"><!-- first column -->
                                                <div class="card custom-card create-wrapper">
                                                    <div class="card-header">
                                                        <h3>{{$spec->specification}}</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="contact-form">
                                                            <!-- opening of one field -->

                                                            {{--                                    {!! Form::hidden('model_id', $model->model_id) !!}--}}

                                                            @foreach($feats as $feat)
                                                                <?php
                                                                $inputId = $feat->id;
                                                                ?>
                                                                @if($feat->spec->specification == $spec->specification)
                                                                    <p>
                                                                        {{$feat->feature}}
                                                                        {!! Form::text("features[$inputId]", $model->detail->where('feature_id', $inputId)->first()->value ?? '', ['class' => 'form-control']) !!}
                                                                    </p>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            @php /*<div class="col-lg-6">
                                                <div class="card custom-card create-wrapper">
                                                    <div class="card-header">
                                                        <h3>{{$spec->specification}}</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="contact-form">
                                                            @foreach($feats as $feat)
                                                                <?php
                                                                $inputId = $feat->id;
                                                                ?>
                                                                @if($feat->spec->specification == $spec->specification)
                                                                    <?php
                                                                    $colorArrayValue = $model->detail->where('feature_id', $inputId);
                                                                    ?>
                                                                    {{$feat->feature}}
                                                                    @if(count($colorArrayValue) > 0)
                                                                        @foreach($colorArrayValue as $cos)
                                                                            <?php
                                                                                $co = explode(',', $cos->value);
                                                                            ?>
                                                                            <div class="to-be-clone color-box">
                                                                                {!! Form::text("color[{$loop->iteration}][coname]", $co[0], ['class' => 'form-control name_input', 'placeholder' => 'Color']) !!}
                                                                                {!! Form::text("color[{$loop->iteration}][picker]", $co[1], ['class' => 'form-control picker_input', 'id' => 'demo', 'placeholder' => 'Pick a Color', 'autocomplete' => 'off']) !!}
                                                                                <div class="color-box-preview" style="width:32px; height:32px; background: {{$co[1]}}"></div>
                                                                                {!! Form::hidden('feat_id', $feat->id) !!}
                                                                            </div>
                                                                        @endforeach
                                                                    @else
                                                                        <div class="to-be-clone color-box">
                                                                            {!! Form::text("color[1][coname]", null, ['class' => 'form-control name_input', 'placeholder' => 'Color']) !!}
                                                                            {!! Form::text("color[1][picker]", null, ['class' => 'form-control picker_input', 'id' => 'demo', 'placeholder' => 'Pick a Color', 'autocomplete' => 'off']) !!}
                                                                            {!! Form::hidden('feat_id', $feat->id) !!}
                                                                        </div>
                                                                    @endif
                                                                    <p class="text-right" style="margin-left: 140px">
                                                                        <a href="javascript:void(0);" class="btn btn-sm custom-btn btn-success" id="add" type="submit"><i class="fa fa-plus"></i></a>
                                                                        <a href="javascript:void(0);" class="btn btn-sm custom-btn btn-danger remove" id="remove" type="submit"><i class="fa fa-times"></i></a>
                                                                    </p>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> */ @endphp
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <div class="row">

                                    @foreach($attributes as $attribute)
                                        <div class="col-lg-4">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3>{{$attribute->name}}</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="contact-form">
                                                        @foreach($subs as $sub)
                                                            <?php
                                                            $subId = $sub->id;
                                                            ?>
                                                            @if($sub->attribute_id == $attribute->id)
                                                                <p>
                                                                    {{$sub->name}}
                                                                    {!! Form::text("sub_attributes[$subId]", $model->attribute_model->where('sub_attribute_id', $subId)->first()->value ?? '', ['class' => 'form-control']) !!}
                                                                </p>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <p class="text-right mt-1">
                <button class="btn btn-success btn-lg" type="submit">Update</button>
                <a style="color:#ffffff;" href="{{route('model.variants')}}" class="btn btn-danger btn-lg" type="submit">Cancel</a>
            </p>
            {!! Form::close() !!}
        </div>
    </section>

@endsection

@section('scripts')
    <script>
        $('.down').selectize();
        $('.date').flatpickr();
        $('#demo').colorpicker();
        $('.model_category').selectize({
            maxItems: 5
        });
        $('.trans').selectize({
           maxItems: 5
        });

        $(document).ready(function(){
            $("body").on("click", "#add", function(){
                const count = $('.to-be-clone').length + 1;
                var html = $(".to-be-clone").first().clone();
                html.find('.name_input').attr('name', "color["+count+"][coname]").val('');
                html.find('.color-box-preview').remove();
                html.find('.picker_input').attr('name', "color["+count+"][picker]").val('').colorpicker();
                $(".to-be-clone").parent().find(".to-be-clone").last().after(html);
            });
        })
        $('.remove').click(function(){
            if($(".to-be-clone").length>1){
                $(".contact-form").find(".to-be-clone").last().remove();
            }
        })

        //File Manager
        function responsive_filemanager_callback(field_id) {
            var url = "{{ asset('') }}thumbs/" + jQuery('#' + field_id).val();
            var files = jQuery('#' + field_id).val();
            if (files.indexOf('[') !== -1) { //multiple files
                var mFiles = JSON.parse(files);
                mFiles.forEach(function (file) {
                    var fileNameWithoutExt = (file.substr(0, file.lastIndexOf(".")));
                    fileNameWithoutExt = fileNameWithoutExt.substring(fileNameWithoutExt.lastIndexOf('/')+1);
                    var ext = file.split(".");
                    ext = (ext[(ext.length) - 1]);
                    var filePath = "{{ asset('') }}thumbs/" + file;
                    var docs = '<input type="hidden" name="'+field_id+'[]" value="' + file + '"/>';
                    var field = '#' + field_id;
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
                    selectedImg += '<input value="'+ fileNameWithoutExt +'" placeholder="Title" class="form-control selected-img-title" type="text" name="'+field_id+'_title[]"></div>';

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
                var field = '#' + field_id;
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
                selectedImg += '<input value="'+ fileNameWithoutExt +'" placeholder="Title" class="form-control" type="text" name="'+field_id+'_title[]"></div>';
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

    </script>
@endsection
