<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
@include('frontend.layouts.header')
<body class="app header-fixed">
{{--@include('frontend.layouts.navbar')--}}
<div class="main-container">
        {{--                @include('layouts.breadcrumb')--}}
        @yield('content')
</div>
@include('frontend.layouts.footer')
</body>
</html>
