<div class="popular-cars">
    <h2 class="heading2">Popular Cars</h2>
    @foreach($popularCars as $car)
    <div class="car-block text-center">
        <a href="{{ $car->permalink }}">
            <img alt="{{ $car->model_image_title ?? $car->model_name }}" src="{{ $car->featuredImage}}">
        </a>
        <h3 class="heading3"><a href="{{ $car->permalink }}">{{ $car->model_name }}</a></h3>
        <div class="car-info">
            <h4 class="heading4"><a href="{{ $car->permalink }}">{{ $car->priceInWords }}</a></h4>
        </div>
    </div>
    @endforeach
</div>
