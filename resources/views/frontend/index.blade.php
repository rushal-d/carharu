@extends('frontend.layouts.app')
@section('title', '')
@section('content')
    <section class="slider">
        <div class="slider-img">
            <img src="{{ $slider->featured_image }}" alt="{{ $title }}">
        </div>
        <div class="search-container">
            <div class="search-t">
                <div class="main-searchbar">
                    <div class="searchbar-input">
                        <h3 class="slider-title">Search your dream car here</h3>
                        <form action="{{route('frontend.search')}}" method="GET" class="searchform cf">
                            <input type="text" id="car-search" name="model_name" placeholder="Search..." autocomplete="off">
                            <button class="btn custom-btn2">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <h3 class="main-title">FEATURED CARS</h3>
                    </div>
                </div>
            </div>

            <div class="carharu-carousel">
                @foreach($featuredCars as $car)
                <div class="car-block">
                    <div class="car-wrapper box-shadow">
                        <div class="car-img">
                            <a href="{{$car->permalink}}"><img src='{{asset("uploads/{$car->model_image}")}}'></a>
                        </div>
                        <div class="car-body">
                            <a href="{{$car->permalink}}"><h3 class="sub-title">{{$car->model_name}}</h3></a>
                            <p class="price">
                                <a href="{{$car->permalink}}">{{ $car->priceInWords }} </a>
                            </p>
                        </div>
                    </div>
                </div><!--  -->
                @endforeach
            </div>
        </div>
    </section>
    <section class="block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-wrappers">
                        <ul class="nav nav-tabs no-gutters" id="myTab" role="tablist">
                            <li class="nav-item col">
                                <a class="nav-link active" id="brand-tab" data-toggle="tab" href="#brand" role="tab" aria-controls="brand" aria-selected="true">Brand</a>
                            </li>
                            <li class="nav-item col">
                                <a class="nav-link" id="Body-type-tab" data-toggle="tab" href="#Body-type" role="tab" aria-controls="Budget" aria-selected="false">Body Type</a>
                            </li>
                            <li class="nav-item col">
                                <a class="nav-link" id="Transmission-tab" data-toggle="tab" href="#Transmission-type" role="tab" aria-controls="Budget" aria-selected="false">Transmission</a>
                            </li>
                            <li class="nav-item col">
                                <a class="nav-link" id="Fuel-tab" data-toggle="tab" href="#Fuel-type" role="tab" aria-controls="Budget" aria-selected="false">Fuel</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="brand" role="tabpanel" aria-labelledby="brand-tab">
                                <div class="row">
                                    @foreach($brands as $brand)
                                    <div class="col-lg-2">
                                        <div class="mb-4">
                                            <a href="{{route('frontend.filterpage', ['brand' => $brand->slug])}}"><h3 class="tab-title">{{$brand->brand_name}}</h3></a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div><!--  -->
                            </div>
                            <div class="tab-pane fade" id="Body-type" role="tabpanel" aria-labelledby="Body-type-tab">
                                <div class="row">
                                    @foreach($body_types as $body)
                                    <div class="col-lg-2">
                                        <div class="mb-4">
                                            <a href="{{route('frontend.filterpage', ['body' => $body->slug])}}"><h3 class="tab-title">{{$body->name}}</h3></a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div><!--  -->
                            </div>
                            <div class="tab-pane fade" id="Transmission-type" role="tabpanel" aria-labelledby="Transmission-type-tab">
                                <div class="row">
                                    @foreach($transmissions as $transmission)
                                        <div class="col-lg-2">
                                            <div class="mb-4">
                                                <a href="{{route('frontend.filterpage', ['transmission' => $transmission->slug])}}"><h3 class="tab-title">{{$transmission->name}}</h3></a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div><!--  -->
                            </div>
                            <div class="tab-pane fade" id="Fuel-type" role="tabpanel" aria-labelledby="Transmission-type-tab">
                                <div class="row">
                                    @foreach($fuel_types as $fuel)
                                        <div class="col-lg-2">
                                            <div class="mb-4">
                                                <a href="{{route('frontend.filterpage', ['fuel' => $fuel->slug])}}"><h3 class="tab-title">{{$fuel->name}}</h3></a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div><!--  -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <h3 class="main-title">POPULAR CARS</h3>
                    </div>
                </div>
            </div>
            <div class="carharu-carousel">
                @foreach($popularCars as $car)
                    <div class="car-block">
                        <div class="car-wrapper box-shadow">
                            <div class="car-img">
                                <a href="{{$car->permalink}}"><img src='{{asset("uploads/{$car->model_image}")}}'></a>
                            </div>
                            <div class="car-body">
                                <a href="{{$car->permalink}}"><h3 class="sub-title">{{$car->model_name}}</h3></a>
                                <a href="{{$car->permalink}}"><p class="price">{{ $car->priceInWords }}</p></a>
                            </div>
                        </div>
                    </div><!--  -->
                @endforeach
            </div>
        </div>
    </section>

    {{--@if(count($just_launched) > 0)
    <section class="block bg-gray top-cars-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <h3 class="main-title">JUST LAUNCHED</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="your-class opat">
                        @foreach($just_launched as $just)
                            @if($today->diffInDays($just->launch_date) < 30)
                                <div class="top-cars box-shadow">
                                    <div class="img">
                                        <img src='{{asset("uploads/{$just->model_image}")}}'>
                                    </div>
                                    <div class="body">
                                        <a href="{{route('frontend.modeldetail', ['slug' => $just->slug])}}"><h3 class="sub-title">{{$just->model_name}}</h3></a>
                                        <p> Starting <br><b>Rs. {{\App\Helpers\IndianCurrencyFormat::IND_money_format($just->price)}}</b></p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div><!--  -->
                <div class="col-lg-12">
                    <div class="text-center mt-4">
                        <a href="#"><button class="btn custom-btn">See All</button></a>
                    </div>
                </div><!--  -->
            </div>
        </div>
    </section>
    @endif--}}
    <section class="parallex block">
        <div class="bg-black">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="parallex-content text-center">
                            <h1>You can compare two to four cars before you settle for one. Go ahead and give it a try.</h1>
                            <br>
                            <br>
                            <p class="text-center"><a href="{{route('frontend.compare')}}"><button class="btn custom-btn">Compare</button></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(count($upcoming) > 0)
    <section class="bg-gray top-cars-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <h3 class="main-title">UPCOMING CARS</h3>
                    </div>
                </div>
            </div>
            <div class="{{  (count($upcoming) >= 3) ? 'carharu-carousel' : 'row' }}">
                @foreach($upcoming as $car)
                    <div class="col-md-4 car-block">
                        <div class="car-wrapper box-shadow">
                            <div class="car-img">
                                <a href="{{$car->permalink}}"><img src='{{asset("uploads/{$car->model_image}")}}'></a>
                            </div>
                            <div class="car-body">
                                <a href="{{$car->permalink}}"><h3 class="sub-title">{{$car->model_name}}</h3></a>
                               {{-- <p class="price">
                                    <a href="{{$car->permalink}}">{{ $car->priceInWords }} </a>
                                </p>--}}
                            </div>
                        </div>
                    </div><!--  -->
                @endforeach
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mt-4">
                        <a href="#"><button class="btn custom-btn">See All</button></a>
                    </div>
                </div><!--  -->
            </div>
        </div>
    </section>
    @endif
    @if(count($blogs) > 0)
    <section class="block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <h3 class="main-title">News & Blogs</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($blogs as $blog)
                    <div class="col-lg-4">
                        <div class="news">
                            <div class="news-img">
                                <div class="bg-black"></div>
                                <img src='{{asset("uploads/{$blog->blog_cover}")}}'>
                            </div>
                            <div class="news-body">
                                <span>{{\Carbon\Carbon::parse($blog->created_at)->format('d M Y')}}</span>
                                <h3 class="sub-title">{{$blog->title}}</h3>
                                <a href="{{route('blog-details', ['id' => $blog->id])}}" class="btn custom-btn-no">Read More >></a>
                            </div>
                        </div>
                    </div><!--  -->
                @endforeach
            </div>
        </div>
    </section>
    @endif
@endsection

@section('scripts')
<script>
    {{--var $select = $('#model_ko_naam').selectize({--}}
    {{--    valueField: 'id',--}}
    {{--    labelField: 'model_name',--}}
    {{--    searchField: ['model_name'],--}}
    {{--    options: [],--}}
    {{--    preload: true,--}}
    {{--    maxItems: 1,--}}
    {{--    create: false,--}}
    {{--    load: function (query, callback) {--}}
    {{--        if (!query.length) return callback();--}}
    {{--        $.ajax({--}}
    {{--            url: '{{ route('get-model') }}?search=' + encodeURIComponent(query),--}}
    {{--            type: 'GET',--}}
    {{--            error: function () {--}}
    {{--                callback();--}}
    {{--            },--}}
    {{--            success: function (res) {--}}
    {{--                callback(res.models);--}}
    {{--            }--}}
    {{--        });--}}
    {{--    }--}}
    {{--});--}}
</script>
@endsection
