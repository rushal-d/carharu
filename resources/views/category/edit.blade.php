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
            {{ Form::model($category, array('route' => ['post-category.update', $category->id], 'files' => true,'class' => 'categoryform repeater','method' => 'PATCH'))  }}
            <h5>{{ $title }}</h5>
            <div class="row">
                <div class="col-md-8 col-sm-12">
                    {{-- Basic Info --}}
                    <div class="basic-info card">

                        <div class="card-body">
                            {{--                            <h5 class="card-title">{{ $title }}</h5>--}}
                            <div class="card-text">
                                <div class="form-group row">
                                    <div class="col-md-6 col-sm-12 required-field">
                                        {{ Form::label('name', 'Title') }}
                                        {{ Form::text('name', $category->name, array('class' => 'form-control', 'placeholder' => 'Title'))  }}
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        {{ Form::label('slug', 'Slug') }}
                                        {{ Form::text('slug', $category->slug, array('id' => 'slug', 'disabled'=>'disabled', 'class' => 'disabled-field form-control')) }}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12 col-sm-12">
                                        {{ Form::label('description', 'Description')  }}
                                        {{ Form::textarea('description', $category->description, array('class' => 'form-control')) }}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>

                {{-- Right Sidebar  --}}
                <div class="col-md-4 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Choose Category</h5>
                            <div class="card-text">
                                <div class="form-group row">
                                    <div class="col-md-12 col-sm-12">
                                        {{ Form::select('parent_id', $parentCategory, null, array('class' => 'form-control', 'placeholder' => 'Choose one')) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--  Media --}}
                    <div class="mediafiles card">
                        <div class="card-body">
                            <h5 class="card-title">Cover Image</h5>

                            <div class="card-text">

                                <div class="form-group row">

                                    <div class="col-md-12 col-sm-12">
                                        <?php $fileManagerURL = asset('') .'filemanager/dialog.php?type=1&field_id=image&relative_url=1'; ?>
                                        <a class="text-primary open-filemanager" data-fancybox data-type="iframe" data-src="{{ asset('') }}filemanager/dialog.php?type=1&field_id=image&relative_url=1" href="javascript:;">Set Image</a>
                                        {{ Form::hidden('image', $category->image, array('id' => 'image', 'class' => 'form-control')) }}
                                            <?php
                                            if(!empty($category->image)){
                                                $root = asset('');
                                                $img = $category->image;
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
                    </div>

                    <div class="icon card">
                        <div class="card-body">
                            <h5 class="card-title">Order</h5>
                            <div class="card-text">

                                <div class="form-group row">

                                    <div class="col-md-12 col-sm-12">
                                        {{ Form::label('order', 'Order')  }}
                                        {{ Form::text('order', $category->order, array('class' => 'form-control')) }}
                                    </div>
                                </div>

                            </div>


                        </div>

                    </div>

                    {{--  Save --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-right form-control">
                                {{ Form::submit('Save',array('class'=>'btn btn-success btn-lg'))}}
                            </div>
                        </div>
                    </div>

                </div>

                {{-- End of sidebar --}}

            </div>

            {{ Form::close()  }}
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
