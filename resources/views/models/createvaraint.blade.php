@extends('layouts.app')
@section('styles')
<style>
    .btn:focus{
        box-shadow: none !important;
    }
    /*.card{*/
    /*    box-shadow: 2px 2px #abdff0;*/
    /*}*/
    .project-tab #tabs{
        background: #007b5e;
        color: #eee;
    }
    .project-tab #tabs h6.section-title{
        color: #eee;
    }
    .nav-fill .nav-link.active{
        margin-top: 0px !important;
    }
    .project-tab #tabs .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
        color: #0062cc;
        /*background-color: transparent;*/
        border-color: transparent transparent #f3f3f3;
        border-bottom: 3px solid !important;
        font-size: 16px;
        font-weight: bold;
        overflow: hidden !important;
    }
    .project-tab .nav-link {
        border: 1px solid transparent;
        border-top-left-radius: .25rem;
        border-top-right-radius: .25rem;
        color: #0062cc;
        font-size: 16px;
        font-weight: 600;
        overflow: hidden !important;
    }
    .project-tab .nav-link:hover {
        border: none;
        overflow: hidden !important;
    }
    .project-tab thead{
        background: #f3f3f3;
        color: #333;
    }
    .project-tab a{
        text-decoration: none;
        color: #333;
        font-weight: 600;
        overflow: hidden !important;
    }
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
            {{ Form::open(['route' => 'model.storevariant', 'enctype' => 'multipart/form-data']) }}
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
                                                    <h3>Add Variant</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="contact-form">
                                                        <div class="row"><!-- main row open-->
                                                            <!-- opening of one field -->
                                                            <div class="col-lg-6">
                                                                <div class="row">
                                                                    {!! Form::label('model_name', 'Model Name: <span class="required-field"></span>', ['class' => 'col-xs-4 col-md-4'], false); !!}
                                                                    <div class="col-xs-8 col-md-8 form-group">
                                                                        {!! Form::text('model_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <div class="row">
                                                                    {!! Form::label('slug', 'Slug: <span class="required-field"></span>', ['class' => 'col-xs-4 col-md-4'], false); !!}
                                                                    <div class="col-xs-8 col-md-8 form-group">
                                                                        {!! Form::text('slug', null, ['disabled' => 'disabled', 'class' => 'form-control']) !!}
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-12">
                                                                <div class="row">
                                                                    {!! Form::label('model_description', 'Description: <span class="required-field"></span>', ['class' => 'col-xs-2 col-md-2'], false); !!}
                                                                    <div class="col-xs-10 col-md-10 form-group">
                                                                        {!! Form::textarea('model_description', null, ['class' => 'form-control', 'rows' => '3']) !!}
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
                                                        <a class="btn btn-success" data-fancybox data-type="iframe"
                                                           data-src="{{ asset('') }}filemanager/dialog.php?type=0&field_id=interior_images&relative_url=1"
                                                           href="javascript:;">Choose Image</a>
                                                        {{ Form::hidden('interior_images_tmp[]', '', array('id' => 'interior_images', 'class' => 'form-control')) }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card custom-card create-wrapper inline-images-upload-box">
                                                <div class="card-header">
                                                    <h3>Exterior Images (Multiple)</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="input-group col-12 text-center">
                                                        <a class="btn btn-success" data-fancybox data-type="iframe"
                                                           data-src="{{ asset('') }}filemanager/dialog.php?type=0&field_id=exterior_images&relative_url=1"
                                                           href="javascript:;">Choose Image</a>
                                                        {{ Form::hidden('exterior_images_tmp[]', '', array('id' => 'exterior_images', 'class' => 'form-control')) }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card custom-card create-wrapper inline-images-upload-box">
                                                <div class="card-header">
                                                    <h3>Other Images (Multiple)</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="input-group col-12 text-center">
                                                        <a class="btn btn-success" data-fancybox data-type="iframe"
                                                           data-src="{{ asset('') }}filemanager/dialog.php?type=0&field_id=other_images&relative_url=1"
                                                           href="javascript:;">Choose Image</a>
                                                        {{ Form::hidden('other_images_tmp[]', '', array('id' => 'other_images', 'class' => 'form-control')) }}
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
                                        <div class="col-lg-5">

                                            <div class="card">
                                                <div class="card-header"><h3>Other Details</h3></div>
                                                <div class="card-body">
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            {!! Form::label('parent_model', 'Parent Model : <span class="required-field">*</span>', ['class' => 'col-xs-4 col-md-4'], false); !!}
                                                            <div class="col-xs-8 col-md-8 form-group">
                                                                {!! Form::select('parent_model', $models, request()->get('parent_id') ?? null, ['class' => 'form-control down', 'placeholder' => 'Select base model', 'required' => 'required']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            {!! Form::label('fuel_type', 'Fuel Type: <span class="required-field">*</span>', ['class' => 'col-xs-4 col-md-4'], false); !!}
                                                            <div class="col-xs-8 col-md-8 form-group">
                                                                {!! Form::select('fuel_type[]', $fuel_type, null, ['multiple' => 'multiple', 'class' => 'form-control trans', 'placeholder' => 'Choose one or multiple', 'required' => 'required']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            {!! Form::label('transmission_type', 'Transmission Type: <span class="required-field">*</span>', ['class' => 'col-xs-4 col-md-4'], false); !!}
                                                            <div class="col-xs-8 col-md-8 form-group">
                                                                {!! Form::select('transmission_type[]', $transmission_type, null, ['multiple' => 'multiple', 'class' => 'form-control trans', 'placeholder' => 'Choose one or multiple', 'required' => 'required']) !!}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            {!! Form::label('launch_date', 'Launch Date: <span class="required-field">*</span>', ['class' => 'col-xs-4 col-md-4'], false); !!}
                                                            <div class="col-xs-8 col-md-8 form-group">
                                                                {!! Form::date('launch_date', null, ['class' => 'form-control date', 'placeholder' => 'Pick launch date','required' => 'required']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            {!! Form::label('price', 'Price (NPR): <span class="required-field">*</span>', ['class' => 'col-xs-4 col-md-4'], false); !!}
                                                            <div class="col-xs-8 col-md-8 form-group">
                                                                {!! Form::text('price', null, ['class' => 'form-control','required' => 'required']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            {!! Form::label('mileage', 'Mileage (KM/L): <span class="required-field">*</span>', ['class' => 'col-xs-4 col-md-4'], false); !!}
                                                            <div class="col-xs-8 col-md-8 form-group">
                                                                {!! Form::text('mileage', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            {!! Form::label('engine', 'Engine (CC): <span class="required-field">*</span>', ['class' => 'col-xs-4 col-md-4'], false); !!}
                                                            <div class="col-xs-8 col-md-8 form-group">
                                                                {!! Form::text('engine', null, ['class' => 'form-control','required' => 'required']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            {!! Form::label('seats', 'Seats: <span class="required-field">*</span>', ['class' => 'col-xs-4 col-md-4'], false); !!}
                                                            <div class="col-xs-8 col-md-8 form-group">
                                                                {!! Form::number('seats', null, ['class' => 'form-control','required' => 'required']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card custom-card create-wrapper">
                                                <div class="card-header">
                                                    <h3>Set Featured Image</h3>
                                                </div>
                                                <div class="card-body">
                                                    {!! Form::label('model_image', 'Featured Image: <span class="required-field">*</span>', ['class' => 'col-xs-12 col-md-12'], false); !!}
                                                    <div class="input-group col-12 text-center">

                                                        <a class="btn btn-success" data-fancybox data-type="iframe"
                                                           data-src="{{ asset('') }}filemanager/dialog.php?type=0&field_id=model_image&relative_url=1"
                                                           href="javascript:;">Choose Image</a>
                                                        {{ Form::hidden('model_image_tmp[]', '', array('id' => 'model_image', 'class' => 'form-control')) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <div class="row">
                                        @foreach($specs as $spec)
                                            @if($spec->id !== $colorIdInSpec->id)
                                                <div class="col-lg-3 col-md-4 col-sm-6 col-12"><!-- first column -->
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
                                                                            {!! Form::text("features[$inputId]", null, ['class' => 'form-control']) !!}
                                                                            {{--                                                {!! Form::hidden("features[$inputId]", feat_id) !!}--}}
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
                                                                        {{$feat->feature}}
                                                                        <p class="to-be-clone">
                                                                            {!! Form::text("color[1][coname]", null, ['class' => 'form-control name_input', 'placeholder' => 'Color']) !!}
                                                                            {!! Form::text("color[1][picker]", null, ['class' => 'form-control picker_input', 'id' => 'demo', 'placeholder' => 'Pick a Color', 'autocomplete' => 'off']) !!}
                                                                            {!! Form::hidden('feat_id', $feat->id) !!}
                                                                        </p>
                                                                        <p class="text-right" style="margin-left: 140px">
                                                                            <a href="javascript:void(0);" class="btn btn-sm custom-btn btn-success" id="add" type="submit"><i class="fa fa-plus"></i></a>
                                                                            <a href="javascript:void(0);" class="btn btn-sm custom-btn btn-danger remove" id="remove" type="submit"><i class="fa fa-times"></i></a>
                                                                        </p>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> */@endphp
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
                                                                        {!! Form::text("sub_attributes[$subId]", null, ['class' => 'form-control']) !!}
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
                <button class="btn btn-success btn-lg" type="submit">Create</button>
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

    var count =1;
    $(document).ready(function(){
        $("body").on("click", "#add", function(){
            count++;
           var html = $(".to-be-clone").first().clone();
            html.find('.name_input').attr('name', "color["+count+"][coname]");
            html.find('.picker_input').attr('name', "color["+count+"][picker]").colorpicker();
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
                var selectedImg = '<div class="selected-img-box col-12"  data-toggle="tooltip" data-placement="top" title="' + file + '"><div class="selected-img">';

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
                jQuery(field).parent().after(docs + selectedImg + removeImg);
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
