@extends('frontend.layouts.app')
@section('title', '')
@section('content')
@include('frontend.layouts.breadcrumbs')
@section('styles')
    <link href="{{asset('css/lightslider.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/lightgallery.min.css')}}" rel="stylesheet">
@endsection
<section class="car-page">

    <div class="car-details-tabs">
        <div class="container">
            <ol class="nav">
                <li class="nav-link text-truncate tab-model-name active"><a href="{{ $model->permalink }}">{{ $model->model_name }}</a></li>
                <li class="nav-link"><a href="{{ $model->specsLink }}">Specs</a></li>
                <li class="nav-link"><a href="#">Price</a></li>
                <li class="nav-link"><a href="#">Features</a></li>
                <li class="nav-link"><a href="#">Variants</a></li>
                <li class="nav-link"><a href="#">Reviews</a></li>
                <li class="nav-link"><a href="#">Compare</a></li>
                <li class="nav-link"><a href="#">News</a></li>
            </ol>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="model-details-box">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="image-gallery">
                                <ul id="imageGallery">
                                    <li data-thumb="{{ $model->featuredImage  }}" data-src="{{ $model->featuredImage  }}">
                                        <img alt="{{ $model->model_image_title }}" src="{{ $model->featuredImage  }}" />
                                    </li>
                                    @if(!empty($exteriorImages))

                                        @foreach($exteriorImages as $image)

                                            <li data-thumb="{{ $image->fullImage }}" data-src="{{ $image->fullImage  }}">
                                                <img alt="{{ $image->title }}" src="{{ $image->fullImage }}" />
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div><!--  -->
                        <div class="col-lg-5">
                            <div class="model-name">
                                <h1 class="heading1">{{$model->model_name}}</h1>
                            </div>
                            <div class="manufacturer-name">
                                <h4 class="heading4">Manufacturer: <a href="{{ $model->brand->permalink }}">{{ $model->brand->brand_name }}</a></h4>
                            </div>
                            <div class="model-price">
                                <h2 class="heading2">{{$model->priceInWords}}</h2>
                            </div>
                            @if(!empty($colorImages) && count($colorImages) > 0)
                            <div class="model-colors">
                                <h3 class="heading3">{{ $model->model_name }} Colors</h3>
                                <div class="color-boxes d-flex flex-row">
                                    @php $colorNames = []; @endphp
                                    @foreach ($colorImages as $color)
                                        @php $colorNames[] = $color->attribute->label; @endphp
                                        <div class="color-box-block">
                                            <div data-toggle="tooltip" title="{{ $color->attribute->label }}" style="background: {{'#'.$color->attribute->value}}" class="color-box"></div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            @if(count($variants) > 0)
                                <div class="model-variants">
                                    <a href="#" class="d-flex align-content-center"><i class="fa fa-tags"></i> <span class="model-variants-label">Variants:</span> <span class="model-variants-num">{{ count($variants) }}</span></a>
                                </div>
                            @endif
                            <div class="product-desc">
                                <div class="basic-info-table">
                                    <div class="row">
                                        <div class="col-4 col-label">Launch Date</div>
                                        <div class="col-8 col-value">{{\Carbon\Carbon::parse($model->launch_date)->format('d M Y')}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4 col-label">Mileage</div>
                                        <div class="col-8 col-value">
                                            {{$model->mileage}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4 col-label">Engine</div>
                                        <div class="col-8 col-value">{{$model->engine}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4 col-label">Transmission</div>
                                        <div class="col-8 col-value">{{ $model->transmissionAll }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4 col-label">Fuel Type</div>
                                        <div class="col-8 col-value">{{ $model->fuelAll }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4 col-label">Seats</div>
                                        <div class="col-8 col-value">{{$model->seats}}</div>
                                    </div>
                                </div>
                            </div>
                        </div><!--  -->
                    </div>
                </div>
            </div><!-- main row close -->

        </div>
    </div>
</section>

<section class="model-more-details">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="full-des mt-3">
                    <p>{!! $model->model_description !!}</p>
                    <p><b>{{ $model->model_name }} Price: </b> {{ $model->model_name }} price start from {{ $model->priceInWords }} to {{ $model->maxPrice }}.</p>
                    <p><b>{{ $model->model_name }} Variants: </b> {{ $model->model_name }} is available in {{ count($variants) }} variants.</p>
                    @if(!empty($colorNames))
                    <p><b>{{ $model->model_name }} Colors: </b> {{ $model->model_name }} has {{ count($colorImages) }} different colors which are
                        {{ count($colorNames) <= 1 ? reset($colorNames) : join(', ', array_slice($colorNames, 0, -1)) . " & " . end($colorNames) }}.</p>
                    @endif
                </div>
                @if(!empty($variants) && count($variants)>0)
                <div class="variants-block">
                    <h2 class="heading1">{{ $model->model_name }} Variants Price List in Nepal</h2>
                    @foreach($variants as $variant)
                        <div class="variant-item">
                            <div class="row">
                                <div class="col-8">
                                    <h3 class="heading3"><a href="{{$variant->permalink}}">{{$variant->model_name}}</a></h3>
                                    <p class="car-basic-info">
                                        {{$variant->mileage}} | {{ $variant->engine }} | {{ $variant->transmissionAll }}
                                    </p>
                                </div>
                                <div class="col-4">
                                    <h4 class="heading4">{{$variant->priceInWords}} </h4>
                                    <a href="{{ $variant->permalink }}" class="btn btn-sm custom-btn">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @endif

                @if(!empty($similarCars) && count($similarCars)>0)
                    <section class="block">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="text-center mb-5">
                                        <h2 class="heading2">Top Competitors of {{ $model->model_name }} </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="carharu-carousel-cars">
                                @foreach($similarCars as $car)
                                    <div class="car-block">
                                        <div class="car-wrapper box-shadow">
                                            <div class="car-img">
                                                <a href="{{$car->permalink}}"><img src='{{asset("uploads/{$car->model_image}")}}'></a>
                                            </div>
                                            <div class="car-body">
                                                <a href="{{$car->permalink}}"><h2 class="heading4">{{$car->model_name}}</h2></a>
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
                @endif


            </div><!-- close og col 8 -->
            <div class="col-lg-4">
                @include('frontend.layouts.partials.carsblock', ['cars' => $sameBrandCars, 'title' => 'More Cars from '. $model->brand->brand_name ])
{{--                @include('frontend.layouts.partials.carsblock', ['cars' => $popularCars, 'title' => 'Popular Cars'])--}}
            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="row">

    </div>
</div>

{{--<section class="block">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center mb-5">
                    <h3 class="main-title">{{$model->model_name}} News and Blogs</h3>
                </div>
            </div>
        </div>
--}}{{--        <div class="row">--}}{{--
--}}{{--            @foreach($blogs as $blog)--}}{{--
--}}{{--                <div class="col-lg-6">--}}{{--
--}}{{--                    <div class="news">--}}{{--
--}}{{--                        <div class="news-img">--}}{{--
--}}{{--                            <div class="bg-black"></div>--}}{{--
--}}{{--                            <img src='{{asset("storage/cover_images/{$blog->first()->blog_cover}")}}'>--}}{{--
--}}{{--                        </div>--}}{{--
--}}{{--                        <div class="news-body">--}}{{--
--}}{{--                            <span>15 May</span>--}}{{--
--}}{{--                            <a href="#"><h3 class="sub-title">{{$blog->first()->main_title}}</h3></a>--}}{{--
--}}{{--                            <p>{{$blog->first()->description}}</p>--}}{{--
--}}{{--                            <button class="btn custom-btn-no">Read More >></button>--}}{{--
--}}{{--                        </div>--}}{{--
--}}{{--                    </div>--}}{{--
--}}{{--                </div><!--  -->--}}{{--
--}}{{--            @endforeach--}}{{--
--}}{{--        </div>--}}{{--
        --}}{{--<div class="row">
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
        </div>--}}{{--
    </div>
</section>--}}

@endsection

@section('scripts')
    <script src="{{asset('js/lightslider.min.js')}}"></script>
    <script src="{{asset('js/lightgallery-all.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip()
            $('#imageGallery').lightSlider({
                gallery:true,
                item:1,
                loop:true,
                thumbItem:10,
                slideMargin:5,
                enableDrag: false,
                currentPagerPosition:'left',
                onSliderLoad: function(el) {
                    el.lightGallery({
                        download: false,
                        selector: '#imageGallery .lslide'
                    });
                },
                nextHtml: '<i class="fa fa-chevron-right"></i>',
                prevHtml: '<i class="fa fa-chevron-left"></i>',
                responsive : [
                    {
                        breakpoint:600,
                        settings: {
                            item:1
                        }
                    }
                ]
            });
        });
    </script>
   {{--
    <script>
        $(function () {
            var rating = $('#rateyo').data('rating');
            $(".rateyo-readonly-widg").rateYo({
                rating: rating,
                readOnly: true,
                halfStar: true,
                starWidth: "15px",
                spacing: "5px",
                multiColor: {
                    "startColor": "#FF0000", //RED
                    "endColor"  : "#00FF00"  //GREEN
                },
                numStars: 5,
                precision: 0,
                minValue: 1,
                maxValue: 5
            }).on("rateyo.change", function (e, data) {
                $('#rating').val(data.rating);
            });
        });
    </script>--}}
@endsection
