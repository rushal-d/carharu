<div id="breadcrumb-container">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('frontend') }}">home</a>
                    </li>
                    <?php $segments = ''; ?>
                    @foreach(Request::segments() as $segment)
                        <?php $segments .= '/'.$segment; ?>
                        <li class="breadcrumb-item">
                            <a href="{{ asset($segments) }}">{{(str_replace('-',' ',$segment))}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
