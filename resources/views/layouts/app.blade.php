<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    @include('layouts.header')
    <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    @include('layouts.navbar')
        <div class="app-body">
            @include('layouts.sidebar')
            <main class="main">
                <div id="breadcrumb-container">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="breadcrumb">
                                    <?php $segments = ''; ?>
                                    @foreach(Request::segments() as $segment)
                                        @if(!is_numeric($segment) && !str_contains($segment, 'edit'))
                                        @php $segments .= '/'.$segment; @endphp
                                        <li class="breadcrumb-item">
                                            <a href="{{ asset($segments) }}">{{(str_replace('-',' ',$segment))}}</a>
                                        </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @include('layouts.notification')
                @yield('content')
            </main>
        </div>
    @include('layouts.footer')
    </body>
</html>
