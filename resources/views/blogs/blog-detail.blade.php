@extends('layouts.app')
@section('styles')
    <style>
        .card-body h3{
            position: relative;
        }
        .card-body h3:after{
            content: "";
            position: absolute;
            background: #FF0000;
            bottom: -5px;
            left: 0;
            width: 100px;
            height: 3px;
        }
    </style>
@endsection

@section('content')
    <section class="padding-block">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Blog</h3>
                        </div>
                        @foreach($blogs as $blog)
                            <div class="card-body" style="box-shadow: 0px 2px #2f353a;">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <img height="150px;" width="100%;" src='{{asset("storage/cover_images/{$blog->blog_cover}")}}'>
                                    </div>
                                    <div class="col-lg-9">
                                        <h3 style="font-style: italic">{{$blog->title}}</h3>
                                        <p>
                                            {!! $blog->description !!}
                                        </p>
                                    </div>
                                    <div class="col-lg-1">
                                        <a href="{{route('blogs.destroy', $blog->id)}}" data-uuid="{{$blog->id}}"
                                           data-name="{{$blog->title}}"
                                           class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash" data-toggle="tooltip"
                                               data-placement="top" title="Delete"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <script>
            $('#reset').click(function () {
                $('input').val('');
                $('#department-form').submit();
            });
        </script>
    </section>



@endsection


