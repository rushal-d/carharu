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
                            <h3 class="flex">Post Category</h3>
                        </div>
                        <div class="card-body">
                            <!-- filter -->
                            <div class="filter">
                                <div class="row form-group">
                                    <div class="col-lg-12">
                                        <div class="add-new mb-3">
                                            <a href="{{route('post-category.create')}}" class="btn btn-success">
                                                Add New <i class="fas fa-plus"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <h3 class="d-md-none text-center btn custom-filter-button">Toggle Filter <i class="custom-filter-caret fas fa-caret-down"></i></h3>
                                    <div class="filter custom-filter-bar do-not-display-filter-bar-for-small-device col-md-12">
                                        {!! Form::open(['route' => 'category.index', 'method' => 'GET', 'id' => 'department-form']) !!}
                                        <div class="row">

                                            <div class="col-lg-3 form-group">
                                                <label>Post Category</label>
                                                {!! Form::text('post_category', $_GET['post_category'] ?? null, ['class' => 'form-control', 'placeholder' => 'Search by category']) !!}
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
                            <div class="table-responsive col-lg-8" id="tableid">
                                <table class="table table-bordered table-hover department-table">
                                    <thead>
                                    <tr>
                                        <th scope="col">S.No.</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Slug</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($categories) && count($categories)>0)
                                        @foreach($categories as $category)
                                            <tr>
                                                <th scope="row">{{ ($categories->currentpage()-1) * $categories->perpage() + $loop->index + 1 }}</th>
                                                <td>
                                                    {{$category->name}}
                                                </td>
                                                <td>
                                                   {{$category->slug}}
                                                </td>
                                                <td>
                                                    <a href="{{route('post-category.edit', $category->id)}}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                    <a href="{{route('post-category.destroy', $category->id)}}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                                <div class="text-center">{{$categories->links()}}</div>
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


