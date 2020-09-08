@extends('frontend.layouts.app')
@section('title', '')
@section('styles')
    <style>
        .jq-ry-container{
            display: inline-block;
            padding-left: 0px;
        }
    </style>
@endsection

@section('content')
    <section class="block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="model-name">
                        <span style="font-size: 25px">{{$variant->model_name}}</span>
                        <p>
                    <span class="rateyo-readonly-widg" data-task="{{$variant->uuid}}"
                          data-rating="{{!is_null($avg) ? $avg : 0}}"
                          id="rateyo"></span>
                            {{$reviews->count()}} reviews | <a href="{{route('review.create', ['id' => $variant->model_id])}}">Write a Review</a>
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <img src='{{asset("uploads/{$variant->model_image}")}}' />
                            <div class="full-des mt-3">
                                <p>{!! $variant->model_description !!}</p>
                            </div>
                        </div><!--  -->
                        <div class="col-lg-4">
                            <div class="product-desc">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Price</th>
                                        <th scope="col">Rs. {{\App\Helpers\IndianCurrencyFormat::IND_money_format($variant->price)}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">Launch Date</th>
                                        <td>{{$variant->launch_date}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Mileage</th>
                                        <td>{{$variant->mileage}} kmpl</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Engine</th>
                                        <td>{{$variant->engine}} cc</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Transmission</th>
                                        <td>{{$variant->transmission->name ?? "N/A"}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">FuelType</th>
                                        <td>{{$variant->fuel->name ?? "N/A"}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Seating Capacity</th>
                                        <td>{{$variant->seats}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Colors</th>
                                        <td>
                                            @foreach($specifications as $specs)
                                                @if($colorIdInSpecs->id == $specs->id)
                                                    @foreach($variant->detail as $mo)
                                                        @if($mo->feature->spec->id == $colorIdInSpecs->id)
                                                            @php $colorValueArray = explode(',', $mo->value); @endphp
                                                            <div class="color" style="background: {{$colorValueArray[1]}};"></div>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div><!--  -->
                    </div>
                </div><!-- main row close -->
                <div class="col-lg-8">
                    <h3>{{$variant->model_name}} Specifications</h3>
                    <div id="accordion">
                        @if(!empty($specifications))
                            @foreach($specifications as $index => $specs)
                                @if($specs->id != $colorIdInSpecs->id)
                                    <div class="other-spec">
                                        <div class="panel-heading collapsed" id="headingOne">
                                            <h3 class="sub-title accordion-toggle" data-toggle="collapse" data-target="#abc{{$index}}" aria-expanded="true" aria-controls="collapseOne">{{$specs->specification}}</h3>
                                        </div>
                                        <div id="abc{{ $index }}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="other-specs">
                                                <table class="table">
                                                    @foreach($variant->detail as $mo)
                                                        @if($mo->feature->spec->specification == $specs->specification)
                                                            <tbody>
                                                            <tr>
                                                                <td scope="row">{{$mo->feature->feature}}</td>
                                                                <td align="right"><b>{{$mo->value}}</b></td>
                                                            </tr>
                                                            </tbody>
                                                        @endif
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                    <h3 class="mt-5">{{$variant->model_name}} Features</h3>
                    <div id="accordion">
                        @if(!empty($attributes))
                            @foreach($attributes as $index => $attribute)
                                <div class="other-spec">
                                    <div  id="headingOne">
                                        <h3 class="sub-title accordion-toggle" data-toggle="collapse" data-target="#zxc{{$index}}" aria-expanded="true" aria-controls="collapseOne">{{$attribute->name}}</h3>
                                    </div>
                                    <div id="zxc{{ $index }}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="other-specs">
                                            <table class="table">
                                                @foreach($variant->attribute_model as $mo)
                                                    @if($mo->sub_attribute->attribute->id == $attribute->id)
                                                        <tbody>
                                                        <tr>
                                                            <td scope="row">{{$mo->sub_attribute->name}}</td>
                                                            <td align="right"><b>{{$mo->value}}</b></td>
                                                        </tr>
                                                        </tbody>
                                                    @endif
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div><!-- close og col 8 -->

                <div class="col-lg-4">
                    <h3>Popular Cars</h3>
                    @if(!empty($models) && count($models)>0)
                        @foreach($models as $m)
                            <div class="car-wrapper box-shadow">
                                <div class="car-img">
                                    <img src='{{asset("uploads/{$m->model_image}")}}'>
                                </div>
                                <div class="car-body">
                                    <a href="{{route('frontend.modeldetail', ['slug' => $m->slug])}}"><h3 class="sub-title">{{$m->model_name}}</h3></a>
                                    <p class="price">Rs {{\App\Helpers\IndianCurrencyFormat::IND_money_format($m->price)}}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div><!--  -->
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row">

        </div>
    </div>
    <section class="bg-gray top-cars-wrapper block">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <h3 class="main-title">Alternative {{$variant->brand->brand_name}} Cars</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="your-class opat">
                        @foreach($sametopmodels as $same)
                            @if($same->brand_id == $variant->brand_id)
                                <div class="top-cars box-shadow">
                                    <div class="img">
                                        <img src='{{asset("uploads/{$same->model_image}")}}'>
                                    </div>
                                    <div class="body">
                                        <a href="{{route('frontend.modeldetail', ['slug' => $same->slug])}}"><h3 class="sub-title">{{$same->model_name}}</h3></a>
                                        <p> Starting <br><b>Rs. {{\App\Helpers\IndianCurrencyFormat::IND_money_format($same->price)}}</b></p>
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
    <section class="block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <h3 class="main-title">{{$variant->model_name}} News & Blogs</h3>
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
    <section class="block bg-gray top-cars-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <h3 class="main-title">{{$variant->model_name}} Reviews</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?php $reviews_count = $reviews->count() ?>
                    @foreach($reviews as $key => $review)
                        <h3 style="color: #0c5480">{!! $review->title !!}</h3>
                        <div class="hehe" data-task="{{$review->uuid}}"
                                data-rating="{{!is_null($review->rating) ? $review->rating : 0}}"
                                id="rateyo">
                        </div> for <b>{{$variant->model_name}}</b> on {{\Carbon\Carbon::parse($review->created_at)->format('d-M-Y')}} by <b>{{$review->name}}</b>
                        <p>{!! $review->description !!}</p>
                        @if ($key + 1 != $reviews_count)
                            <hr>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
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
    </script>
    <script>
        $(function () {
            $('.hehe').each(function(i, obj) {
                var rating = $(this).data('rating');
                $(this).rateYo({
                    rating: $(this).data('rating'),
                    readOnly: true,
                    halfStar: true,
                    spacing: "5px",
                    starWidth: "15px",
                    multiColor: {
                        "startColor": "#FF0000", //RED
                        "endColor"  : "#00FF00"  //GREEN
                    },
                    numStars: 5,
                    precision: 0,
                    minValue: 1,
                    maxValue: 5
                })
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            // Add minus icon for collapse element which is open by default
            $(".collapse.show").each(function(){
                $(this).prev(".card-header").find(".fas").addClass("fa-minus").removeClass("fa-plus");
            });

            // Toggle plus minus icon on show hide of collapse element
            $(".collapse").on('show.bs.collapse', function(){
                $(this).prev(".card-header").find(".fas").removeClass("fa-plus").addClass("fa-minus");
            }).on('hide.bs.collapse', function(){
                $(this).prev(".card-header").find(".fas").removeClass("fa-minus").addClass("fa-plus");
            });
        });
    </script>
@endsection
