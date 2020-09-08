@extends('frontend.layouts.app')
@section('content')

    <section class="block">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h1 class="heading1">{{$title}}</h1>
                    <p>
                        {!!  $content!!}
{{--                        {!! $excerpt !!}--}}
                    </p>
                </div>
                @if(!empty($featured_image))
                    <div class="col-lg-4">
                        <img src='{{$featured_image}}'>
                    </div>
                @endif
            </div>
        </div>
    </section>

@endsection
