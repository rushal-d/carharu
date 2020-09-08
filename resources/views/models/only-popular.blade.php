@extends('layouts.app')
@section('styles')

@endsection

@section('content')
    <section class="padding-block">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header level">
                            <div class="row">
                                <div class="col-11">
                                    <h3 class="flex">Featured Models</h3>
                                </div>
                                <div class="col-1">
                                    <b>Total: {{$popular->count()}}</b>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- filter -->
                            <div class="filter">
                                <div class="row form-group">
                                    <div class="col-lg-12">
                                        <div class="add-new mb-3">
                                            <a href="{{route('model.create')}}" class="btn btn-success">
                                                Add New <i class="fas fa-plus"></i>
                                            </a>
                                            <a href="{{route('model.index')}}" class="btn btn-success">
                                                All Models</i>
                                            </a>
                                            <a href="{{route('model.index')}}" class="btn btn-success">
                                                All Models</i>
                                            </a>
                                        </div>
                                    </div>

                                    <h3 class="d-md-none text-center btn custom-filter-button">Toggle Filter <i class="custom-filter-caret fas fa-caret-down"></i></h3>
                                    <div class="filter custom-filter-bar do-not-display-filter-bar-for-small-device col-md-12">
                                        {!! Form::open(['route' => 'model.index', 'method' => 'GET', 'id' => 'department-form']) !!}
                                        <div class="row">

                                            <div class="col-lg-3 form-group">
                                                <label>Model Name</label>
                                                {!! Form::text('model_name', $_GET['model_name'] ?? null, ['class' => 'form-control', 'placeholder' => 'Search by name']) !!}
                                            </div>

                                            <div class="col-lg-2">
                                                <p class="mt-4">
                                                    <button class="btn custom-btn btn-primary" type="submit">Search
                                                    </button>
                                                    <button class="btn custom-btn btn-danger" type="reset" id="reset">
                                                        Reset
                                                    </button>
                                                </p>
                                            </div><!--  -->
                                        </div>
                                        {!! Form::close() !!}
                                    </div>

                                </div>
                            </div>
                            <!-- filter ends -->
                            <div class="table-responsive col-lg-12" id="tableid">
                                <table class="table table-striped table-hover department-table">
                                    <thead>
                                    <tr>
                                        <th scope="col">S.No.</th>
                                        <th scope="col">Model Name</th>
                                        <th scope="col">Launch Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($popular) && count($popular)>0)
                                        @foreach($popular as $p)
                                            <tr>
                                                <th scope="row">{{ ($popular->currentpage()-1) * $popular->perpage() + $loop->index + 1 }}</th>
                                                <td>
                                                    <a href="{{route('model.show', $p->model_id)}}">{{$p->model_name}}</a>
                                                </td>
                                                <td>
                                                    {{$p->launch_date}}
                                                </td>
                                                <td>
                                                    <a href="{{route('model.show', $p->model_id)}}"
                                                       class="btn btn-sm btn-success"><i class="far fa-eye" data-toggle="tooltip" data-placement="top" title="View"></i></a>
                                                    <a href="{{route('model.edit', $p->model_id)}}"
                                                       class="btn btn-sm btn-primary">
                                                        <i class="far fa-edit" data-toggle="tooltip" data-placement="top"
                                                           title="Edit"></i>
                                                    </a>
                                                    <a href="{{route('model.destroy', $p->model_id)}}" data-uuid="{{$p->model_id}}"
                                                       data-name="{{$p->model_name}}"
                                                       class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash" data-toggle="tooltip"
                                                           data-placement="top" title="Delete"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                                <div class="text-center">{{$popular->links()}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $('#reset').click(function () {
                $('input').val('');
                $('#department-form').submit();
            });
        </script>
    </section>

@endsection
