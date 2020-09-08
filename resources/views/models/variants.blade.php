@extends('layouts.app')

@section('content')
    <section class="padding-block">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header level">
                            <div class="row">
                                <div class="col-11">
                                    <h3 class="flex">All Variants</h3>
                                </div>
                                <div class="col-1">
                                    <b>Total: {{$models->count()}}</b>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- filter -->
                            <div class="filter">
                                <div class="row form-group">
                                    <div class="col-lg-12">
                                        <div class="add-new mb-3">
                                            <a href="{{route('model.createvariant')}}" class="btn btn-success">
                                                Add New Variant <i class="fas fa-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                {!! Form::open(['route' => 'model.variants', 'method' => 'GET']) !!}
                                <div class="row">

                                    <div class="col-lg-2 form-group">
                                        <label>Model Name</label>
                                        {!! Form::text('model', request()->get('model') ?? null, ['class' => 'form-control', 'placeholder' => 'Search by name']) !!}
                                    </div>

                                    <div class="col-lg-2 form-group">
                                        <label>Base/Parent</label>
                                        {!! Form::select('base', $cars, request()->get('base') ?? null, ['class' => 'form-control okay', 'placeholder' => 'Search by base']) !!}
                                    </div>

                                    <div class="col-lg-2 form-group">
                                        <label>Brand Name</label>
                                        {!! Form::select('brand', $brands, request()->get('brand') ?? null, ['class' => 'form-control okay', 'placeholder' => 'Search by brand']) !!}
                                    </div>
                                    <div class="col-lg-2">
                                        <p class="mt-4">
                                            <button class="btn custom-btn btn-primary" type="submit">Filter
                                            </button>
                                            <a class="btn custom-btn btn-danger" type="reset" id="reset" href="{{ route('model.variants') }}">
                                                Reset
                                            </a>
                                        </p>

                                    </div><!--  -->
                                </div>
                                {!! Form::close() !!}
                            </div>



                            <!-- filter ends -->
                            <div class="table-responsive col-lg-12" id="tableid">

                                <table class="table table-striped table-hover department-table">
                                    <thead>
                                    <tr>
                                        <th scope="col">S.No.</th>
                                        <th scope="col">Model Name</th>
                                        <th scope="col">Base</th>
                                        <th scope="col">Brand</th>
                                        <th scope="col">Launch Date</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($models) && count($models)>0)
                                        @foreach($models as $model)
                                            <tr>
                                                <th scope="row">{{ ($models->currentpage()-1) * $models->perpage() + $loop->index + 1 }}</th>
                                                <td>
                                                    <a href="{{route('model.editvariant', $model->model_id)}}">{{$model->model_name}}</a>
                                                </td>
                                                <td><a href="{{route('model.edit', $model->base)}}">{{$model->base->model_name}}</a></td>
                                                <td>{{$model->brand->brand_name}}</td>
                                                <td>
                                                    {{$model->launch_date}}
                                                </td>
                                                <td>
                                                    {{$model->created_at}}
                                                </td>
                                                <td>
                                                    <a href="{{route('model.clonevariant', $model->model_id)}}"
                                                       class="btn btn-sm btn-dark">
                                                        <i class="fas fa-copy" data-toggle="tooltip"
                                                           data-placement="top" title="Clone"></i></a>
                                                    <a href="{{route('model.editvariant', $model->model_id)}}" class="btn btn-sm btn-primary">
                                                        <i class="far fa-edit" data-toggle="tooltip" data-placement="top"
                                                           title="Edit"></i>
                                                    </a>
                                                    <a href="{{route('model.destroy', $model->model_id)}}" data-uuid="{{$model->model_id}}"
                                                       data-name="{{$model->model_name}}"
                                                       class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash" data-toggle="tooltip"
                                                           data-placement="top" title="Delete"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                                <div class="text-center">{{$models->links()}}</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection

@section('scripts')
    <script>
        $('select').selectize();
    </script>
@endsection
