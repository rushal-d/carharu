
@extends('frontend.layouts.app')
@section('title', '')
@section('content')
    <section class="block">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">

                    <div class="listing-wrapper">
                        @foreach($modelsbasedonbrands as $car)
                            <div class="row margin-b">
                                <div class="col-lg-4">
                                    <a href="{{$car->permalink}}"><img src='{{ $car->featuredImage }}'></a>
                                </div><!--  -->
                                <div class="col-lg-8">
                                    <div class="listing-content">
                                        <h3 class="sub-title"><a href="{{$car->permalink}}">{{$car->model_name}}</a></h3>
                                        <p class="price"><a href="{{$car->permalink}}">{{ $car->priceInWords }}</a></p>
                                        <a class="btn custom-btn" href="{{ $car->permalink }}">View Details</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div><!-- main col close -->
                <div class="col-lg-4">
                    {{--                    <h3>Popular Cars</h3>--}}
                    @if(!empty($models) && count($models)>0)
                        @foreach($models as $car)
                            <div class="car-wrapper box-shadow">
                                <div class="car-img">
                                    <a href="{{$car->permalink}}"><img src='{{ $car->featuredImage }}'></a>
                                </div>
                                <div class="car-body">
                                    <h3 class="sub-title"><a href="{{$car->permalink}}">{{$car->model_name}}</a></h3>
                                    <p class="price"><a href="{{$car->permalink}}">{{ $car->priceInWords }}</a></p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
    {{--    <section class="bg-gray top-cars-wrapper block">--}}
    {{--        <div class="container-fluid">--}}
    {{--            <div class="row">--}}
    {{--                <div class="col-lg-12">--}}
    {{--                    <div class="text-center mb-5">--}}
    {{--                        <h3 class="main-title">Alternative Brands</h3>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="row">--}}
    {{--                <div class="col-lg-12">--}}
    {{--                    <div class="your-class opat">--}}
    {{--                        @foreach($brands as $brand)--}}
    {{--                            <div class="top-cars box-shadow">--}}
    {{--                                <div class="img">--}}
    {{--                                    <img src='{{asset("uploads/{$brand->brand_image}")}}'>--}}
    {{--                                </div>--}}
    {{--                                <div class="body">--}}
    {{--                                    <a href="{{route('frontend.filterpage', $brand->brand_id)}}"><h3 class="sub-title">{{$brand->brand_name}}</h3></a>--}}
    {{--                                        <p> Starting <br><b>Rs. {{\App\Helpers\IndianCurrencyFormat::IND_money_format($same->price)}}</b></p>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        @endforeach--}}
    {{--                    </div>--}}
    {{--                </div><!--  -->--}}
    {{--                <div class="col-lg-12">--}}
    {{--                    <div class="text-center mt-4">--}}
    {{--                        <a href="#"><button class="btn custom-btn">See All</button></a>--}}
    {{--                    </div>--}}
    {{--                </div><!--  -->--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </section>--}}
@endsection
