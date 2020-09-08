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
                            <h3 class="flex">Colors</h3>
                        </div>
                        <div class="card-body">
                            <!-- filter -->
                            <div class="filter">
                                <div class="row form-group">
                                    <div class="col-lg-12">
                                        <div class="add-new mb-3">
                                            <a href="{{route('sub-attributes-options-create')}}" class="btn btn-success">
                                                Add New <i class="fas fa-plus"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <h3 class="d-md-none text-center btn custom-filter-button">Toggle Filter <i class="custom-filter-caret fas fa-caret-down"></i></h3>
                                    <div class="filter custom-filter-bar do-not-display-filter-bar-for-small-device col-md-12">
                                        {!! Form::open(['route' => 'sub-attribute-index', 'method' => 'GET', 'id' => 'department-form']) !!}
                                        <div class="row">

                                            <div class="col-lg-3 form-group">
                                                <label>Search</label>
                                                {!! Form::text('search', request()->get('search') ?? null, ['class' => 'form-control', 'placeholder' => 'Search...']) !!}
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
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover department-table">
                                        <tr>
                                            <th>Name</th>
                                            <th>Hex</th>
                                            <th>Color</th>
                                            <th>Actions</th>
                                        </tr>
                                        @foreach($options as $option)
                                            <tr>
                                                <td><a href="{{ route('sub-attributes-options-edit', [$option->id]) }}">{{ $option->label  }}</a></td>
                                                <td><a href="{{ route('sub-attributes-options-edit', [$option->id]) }}">{{ $option->value  }}</a></td>
                                                <td><a href="{{ route('sub-attributes-options-edit', [$option->id]) }}"><div style="width:32px; height:32px; background: {{ '#'.$option->value }}" class="color-box"></div></a></td>
                                                <td>
                                                   <div class="actions">
                                                       <a class="btn btn-sm btn-outline-danger delete-btn" data-id="{{ $option->id }}" href="javascript:void(0)"
                                                          data-toggle="tooltip" data-html="true" title="Delete">
                                                           <i class="fas fa-minus"></i></a>
                                                   </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
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

@section('scripts')
    <script>
        $('#reset').click(function () {
            $('input').val('');
            $('#department-form').submit();
        });
        $('body').on('click', '.delete-btn',function(){
            $this = $(this)
            vex.dialog.confirm({
                className: 'vex-theme-default', // Overwrites defaultOptions
                message: 'Are you sure you want to delete?',
                callback: function(value) {
                    if(value){ //true if clicked on ok
                        $.ajax({
                            type: "POST",
                            url: '{{ route('sub-attributes-options-destroy') }}',
                            data: {_token : '{{ csrf_token() }}',id: $this.data('id')},
                            success: function(response) {
                                if(response == 'Successfully Deleted'){
                                    $this.parent().parent().parent().remove();
                                }
                                toastr.success('Deleted!', response);
                            },
                            error:function(response){
                                alert(response);
                            }
                        });
                    }
                }
            });
        });
    </script>
@endsection
