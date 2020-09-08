<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        {{$title ?? 'CarHaru'}}
    </title>
    {!! SEO::generate(true) !!}
    <link rel="shortcut icon" href="{{{ asset('favicon.ico') }}}">
    <!-- CSS Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.css">
    <link href="{{asset('assets/@coreui/icons/css/coreui-icons.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/flag-icon-css/css/flag-icon.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/rateyo/jquery.rateyo.min.css')}}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.0.3/nouislider.css" rel="stylesheet">
    <link href="{{asset('assets/simple-line-icons/css/simple-line-icons.css')}}" rel="stylesheet">
    <link href="{{asset('css/nepali.datepicker.v2.2.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{asset('css/flatpickr.min.css') }}" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/css/selectize.bootstrap3.min.css">
    <!-- Main styles for this application-->
    <link href="{{asset('css/pace.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/theme-default.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/customstyle.css').'?v='.rand(9999,999999) }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/css/vex.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/css/vex-theme-default.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    @yield('styles')
</head>
