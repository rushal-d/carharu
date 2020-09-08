@extends('layouts.app')

@section('styles')
    <style>
        .border-left-warning {
            border-left: 0.25rem solid #f6c23e !important;
        }
        .border-left-info{
            border-left: .25rem solid #36b9cc!important;
        }
        .border-left-success{
            border-left: .25rem solid #1cc88a!important;
        }
        .border-left-primary{
            border-left: .25rem solid #4e73df!important;
        }
    </style>
@endsection

@section('content')
<section class="padding-block">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Dashboard</h3>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-warning shadow h-100 py-2" style="border-radius: 0.35rem">
                                    <div class="card-body" style="flex: 1 1 auto;padding: 1.25rem;padding-bottom: 0px!important;">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-warning text-uppercase" style="font-weight: 700!important;">Models Count</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800 mt-1" style="color: #5a5c69">{{$model->count()}}</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-car fa-2x text-gray-300" style="color: #dddfeb"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2" style="border-radius: 0.35rem">
                                    <div class="card-body" style="flex: 1 1 auto;padding: 1.25rem;padding-bottom: 0px!important;">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase" style="font-weight: 700!important;">Brands Count</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800 mt-1" style="color: #5a5c69">{{$brand->count()}}</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-copyright fa-2x text-gray-300" style="color: #dddfeb"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2" style="border-radius: 0.35rem">
                                    <div class="card-body" style="flex: 1 1 auto;padding: 1.25rem;padding-bottom: 0px!important;">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase" style="font-weight: 700!important;">Reviews Count</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800 mt-1" style="color: #5a5c69">{{$review->count()}}</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fab fa-rev fa-2x text-gray-300" style="color: #dddfeb"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2" style="border-radius: 0.35rem">
                                    <div class="card-body" style="flex: 1 1 auto;padding: 1.25rem;padding-bottom: 0px!important;">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase" style="font-weight: 700!important;">Blogs Count</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800 mt-1" style="color: #5a5c69">{{$blog->count()}}</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fab fa-blogger fa-2x text-gray-300" style="color: #dddfeb"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
