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
            {{ Form::open(['route' => ['posts.update', $post->id], 'method' => 'PATCH', 'enctype' => 'multipart/form-data']) }}
            <div class="row">
                <div class="col-lg-8"><!-- first column -->
                    <div class="card custom-card create-wrapper">
                        <div class="card-header">
                            <h3>Add a Post</h3>
                        </div>
                        <div class="card-body">
                            <div class="contact-form">
                                <div class="form-group row">
                                    <div class="col-md-6 col-sm-12 required-field">
                                        {{ Form::label('name', 'Title') }}
                                        {{ Form::text('name', $post->name, array('class' => 'form-control', 'placeholder' => 'Title', 'data-validation' => 'required'))  }}
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        {{ Form::label('slug', 'Slug') }}
                                        {{ Form::text('slug', $post->slug, array('id' => 'slug', 'disabled'=>'disabled', 'class' => 'disabled-field form-control')) }}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12 col-sm-12">
                                        {{ Form::label('description', 'Description')  }}
                                        {{ Form::textarea('description', $post->description, array('class' => 'form-control ok')) }}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12 col-sm-12">
                                        {{ Form::label('excerpt', 'Excerpt (Summary)')  }}
                                        {{ Form::textarea('excerpt', $post->excerpt, array('class' => 'form-control')) }}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card create-wrapper custom-card">
                        <div class="card-header">
                            <h3>SEO</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    {!! Form::label('seo_title', 'SEO Title:', false); !!}
                                    {!! Form::textarea('seo_title', $post->seo_title ?? null, ['class' => 'form-control normalTextArea', 'rows' => '3']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    {!! Form::label('seo_description', 'SEO Description:', false); !!}
                                    {!! Form::textarea('seo_description', $post->seo_description ?? null, ['class' => 'form-control normalTextArea', 'rows' => '3']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">

                    <div class="directory-categories card">
                        <div class="card-body">
                            <h5 class="card-title">Category</h5>

                            <div class="card-text">

                                <div class="form-group row">
                                    <div class="col-md-12 col-sm-12">
                                        {{ Form::label('category_ids', 'Select Category') }}
                                        {{ Form::select('category_ids[]', $category,$post->categories, array('required'=> 'required','multiple'=> 'multiple','id' => 'parent_id','class' => 'form-control', 'placeholder' => 'Category')) }}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="mediafiles card">
                        <div class="card-body">
                            <h5 class="card-title">Featured Image</h5>
                            <div class="card-text">

                                <div class="form-group row">

                                    <div class="col-md-12 col-sm-12">
                                        <?php $fileManagerURL = asset('') .'filemanager/dialog.php?type=1&field_id=image&relative_url=1'; ?>
                                        <a class="text-primary open-filemanager" data-fancybox data-type="iframe" data-src="{{ $fileManagerURL  }}" href="javascript:;">Set Image</a>
                                        {{ Form::hidden('featured_image', $post->featured_image, array('id' => 'image', 'class' => 'form-control')) }}

                                        <?php
                                        if(!empty($post->featured_image)){
                                            $root = asset('');
                                            $img = $post->featured_image;
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

                    <div class="card">
                        <div class="card-body">
                            <div class="card-text">
                                <div class="form-group row">
                                    <div class="col-md-12 col-sm-12">
                                        {{ Form::label('published_date_np', 'Published Date (Nepali)') }}
                                        {{ Form::text('published_date_np', $post->published_date_np, array('readonly'=>'readonly','id' =>'published_date_np' ,'class' => 'form-control'))  }}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12 col-sm-12">
                                        {{ Form::label('published_date', 'Published Date (English)') }}
                                        {{ Form::text('published_date',  $post->published_date, array('id' =>'published_date' ,'class' => 'form-control'))  }}
                                    </div>
                                </div>

                                {{--                                <div class="form-group row">--}}
                                {{--                                    <div class="col-md-12 col-sm-12">--}}
                                {{--                                        {{ Form::label('published_date', 'Published Time') }}--}}
                                {{--                                        {{ Form::text('published_time', date('H:i'), array('id' =>'published_time' ,'class' => 'form-control'))  }}--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}

                                <div class="form-group row">
                                    <div class="col-md-12 col-sm-12">
                                        {{ Form::label('sort_order', 'Order') }}
                                        {{ Form::number('sort_order', $post->sort_order, array('min' => 0, 'class' => 'form-control'))  }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <p class="text-right form-control">
                            <button class="btn custom-btn btn-success" type="submit">Update</button>
                            <a href="{{route('posts.index')}}" class="btn custom-btn btn-clear" type="submit">Cancel</a>
                        </p>
                    </div>
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

        $("#parent_id").selectize({
            maxItems:2
        });
        //published date nepali datepicker
        $('#published_date_np').nepaliDatePicker({
            npdMonth: true,
            npdYear: true,
            npdYearCount: 20 ,
            onChange: function(e){
                $('#published_date').val(BS2AD($('#published_date_np').val()));
            }
        });
        //datepicker en
        $("#published_date").flatpickr({
            onChange: function(e){
                $('#published_date_np').val(AD2BS($('#published_date').val()));
            }
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
