@extends('layouts.app')
@section('styles')

@endsection

@section('content')
    <section class="padding-block">
        <div class="container-fluid">
            {{ Form::open(array('route' => 'post-category.store', 'files' => true,'class' => 'categoryform repeater' ))  }}
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
                                        {{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Title'))  }}
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        {{ Form::label('slug', 'Slug') }}
                                        {{ Form::text('slug', null, array('id' => 'slug', 'disabled'=>'disabled', 'class' => 'form-control')) }}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12 col-sm-12">
                                        {{ Form::label('description', 'Description')  }}
                                        {{ Form::textarea('description', null, array('class' => 'form-control')) }}
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
                                        {{ Form::select('parent_id', $category, null, array('class' => 'form-control', 'placeholder' => 'Choose one')) }}
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
                                        <a class="text-primary open-filemanager" data-fancybox data-type="iframe" data-src="{{ asset('') }}filemanager/dialog.php?type=1&field_id=image&relative_url=1" href="javascript:;">Set Image</a>
                                        {{ Form::hidden('image', null, array('id' => 'image', 'class' => 'form-control')) }}
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
                                        {{ Form::text('order', null, array('class' => 'form-control')) }}
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
