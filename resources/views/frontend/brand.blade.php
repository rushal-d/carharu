@extends('frontend.layouts.app')
@section('title', '')
@section('content')
@include('frontend.layouts.breadcrumbs')
<section class="brand-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="heading1">{{$brand->brand_name}}</h1>
                <div class="page-description showmore">
                    {!! $brand->brand_description !!}
                </div>
            </div>
            <div class="col-lg-8">
                <div class="listing-wrapper">
                    <div class="row">
                        <div class="col-md-8">
                            <h2 class="heading2">{{ $brand->brand_name }} Cars in Nepal</h2>
                        </div>
                        <div class="col-md-4">
                           <div class="changebrand-container">
                               {!! Form::select('brand_name', $brands->pluck('brand_name','permalink'), null, ['id' => 'changebrand', 'class' => 'form-control down', 'placeholder' => 'Change']) !!}
                           </div>
                        </div>
                    </div>
                    @foreach($cars as $car)
                        <div class="row margin-b">
                            <div class="col-lg-4">
                                <a href="{{$car->permalink}}">
                                    <img alt="{{ $car->model_name }}" src='{{ $car->featuredImage }}'>
                                </a>
                            </div>
                            <div class="col-lg-8">
                                <div class="listing-content">
                                    <h2 class="heading2"><a href="{{$car->permalink}}">{{$car->model_name}}</a></h2>
                                    <p class="price"><a href="{{$car->permalink}}">{{ $car->priceInWords }}</a></p>
                                    <p class="car-basic-info">
                                        {{$car->mileage}} | {{ $car->engine }} | {{ $car->transmissionAll }}
                                    </p>
                                    <a href="{{$car->permalink}}"><button class="btn custom-btn">View Details</button></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="brand-container">
                    <h2 class="heading2">Other Brands</h2>

                    <div class="row">
                        @foreach($brands as $brand)
                            <div class="col">
                                <div class="brand-block">
                                    <a href="{{ $brand->permalink }}"><img src="{{ $brand->featuredImage }}"></a>
                                    <h3 class="heading3"><a href="{{ $brand->permalink }}">{{ $brand->brand_name }}</a></h3>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

            <div class="col-lg-4 sidebar sidebar-right">
                @include('frontend.layouts.partials.carsblock', ['cars' => $popularCars, 'title' => 'Popular Cars'])
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
    <script src="{{asset('assets/js/showmore.min.js')}}"></script>
    <script>
        $('#changebrand').selectize({
            onChange: function(value){
                window.location.href = value;
            }
        });
        $(document).ready(function() {
            $('.showmore').showMore({
                speedDown: 300,
                speedUp: 300,
                height: '80px',
                showText: 'Read more',
                hideText: 'Read less'
            });
        });
    </script>
@endsection
