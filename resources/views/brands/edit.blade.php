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
            {{ Form::open(['route' => ['brand.update', $brand->brand_id], 'enctype' => 'multipart/form-data', 'method' => 'PATCH']) }}
            <div class="row">
                <div class="col-lg-8"><!-- first column -->
                    <div class="card custom-card create-wrapper">
                        <div class="card-header">
                            <h3>Update</h3>
                        </div>
                        <div class="card-body">
                            <div class="contact-form">
                                <div class="row"><!-- main row open-->
                                    <!-- opening of one field -->
                                    {!! Form::label('brand_name', 'Brand Name: <span class="required-field"> *</span>', ['class' => 'col-xs-2 col-md-2'], false); !!}
                                    <div class="col-xs-10 col-md-10 form-group">
                                        {!! Form::text('brand_name', $brand->brand_name ?? null, ['class' => 'form-control', 'data-validation' => 'required']) !!}
                                    </div>
                                    {!! Form::label('slug', 'Slug: <span class="required-field"> *</span>', ['class' => 'col-xs-2 col-md-2'], false); !!}
                                    <div class="col-xs-10 col-md-10 form-group">
                                        {!! Form::text('slug', $brand->slug ?? null, ['class' => 'disabled-field form-control', 'data-validation' => 'required', 'disabled' => 'disabled']) !!}
                                    </div>
                                    {!! Form::label('brand_description', 'Brand Description: <span class="required-field"></span>', ['class' => 'col-xs-2 col-md-2'], false); !!}
                                    <div class="col-xs-10 col-md-10 form-group">
                                        {!! Form::textarea('brand_description', $brand->brand_description ?? null, ['class' => 'form-control']) !!}
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
                                    {!! Form::textarea('seo_title', $brand->seo_title ?? null, ['class' => 'form-control normalTextArea', 'rows' => '3']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    {!! Form::label('seo_description', 'SEO Description:', false); !!}
                                    {!! Form::textarea('seo_description', $brand->seo_description ?? null, ['class' => 'form-control normalTextArea', 'rows' => '3']) !!}
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
                            <?php $fileManagerURL = asset('') .'filemanager/dialog.php?type=1&field_id=image&relative_url=1'; ?>
                            <a class="text-primary open-filemanager" data-fancybox data-type="iframe" data-src="{{ $fileManagerURL  }}" href="javascript:;">Set Image</a>
                            {{ Form::hidden('brand_image', $brand->brand_image, array('id' => 'image', 'class' => 'form-control')) }}

                            <?php
                            if(!empty($brand->brand_image)){
                                $root = asset('');
                                $img = $brand->brand_image;
                                $fullImgURL = $root . '/thumbs/'. $img;
                                $thumbImgURL = $root . '/uploads/'. $img;
                                $selectedImg = '<div class="selected-img-box"><div class="selected-img"><a data-fancybox data-type="iframe" data-src="'. $fileManagerURL .'" href="javascript:;">
	                                                      <img src="'.$thumbImgURL.'"></a></div>';
                                $selectedImgUpdate = '<p class="selected-img-update text-center">Click the image to edit or update</p>';
                                $removeImg = '<a class="btn btn-sm btn-outline-danger remove-image"><i class="fas fa-minus"></i> Remove Image</a></div>';
                                echo $selectedImg . $selectedImgUpdate . $removeImg;
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <p class="text-right">
                <button class="btn custom-btn btn-success" type="submit">Update</button>
                <a href="{{route('brand.index')}}" class="btn custom-btn btn-clear" type="submit">Cancel</a>
            </p>
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
