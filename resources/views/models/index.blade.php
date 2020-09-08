@extends('layouts.app')
@section('styles')
    <style>
        .btn-warning:hover{
            color: #ffffff;
            background-color: #ffc107;
        }
        .btn-info:hover{
            color: #ffffff;
            background-color: #63c2de;
        }
    </style>
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
                                    <h3 class="flex">All Models</h3>
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
                                            <a href="{{route('model.create')}}" class="btn btn-success">
                                                Add New <i class="fas fa-plus"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <h3 class="d-md-none text-center btn custom-filter-button">Toggle Filter <i class="custom-filter-caret fas fa-caret-down"></i></h3>
                                    <div class="filter custom-filter-bar do-not-display-filter-bar-for-small-device col-md-12">
                                        {!! Form::open(['route' => 'model.index', 'method' => 'GET', 'id' => 'department-form']) !!}
                                        <div class="row">

                                            <div class="col-lg-2 form-group">
                                                <label>Model Name</label>
                                                {!! Form::text('model_name', $_GET['model_name'] ?? null, ['class' => 'form-control', 'placeholder' => 'Search by name']) !!}
                                            </div>
                                            <div class="col-lg-2 form-group">
                                                <label>Brand Name</label>
                                                {!! Form::select('brand_name', $brand, $_GET['brand_name'] ?? null, ['class' => 'form-control okay', 'placeholder' => 'Search by brand']) !!}
                                            </div>
                                            <div class="col-lg-2 form-group">
                                                <label>Model Category</label>
                                                {!! Form::select('model_category', $sortbycategory, $_GET['model_category'] ?? null, ['class' => 'form-control okay', 'placeholder' => 'Search by category']) !!}
                                            </div>
                                            {{--<div class="col-lg-2 form-group">
                                                <label>Price Range</label>
                                                <div id="range" class="mt-1">
                                                    <input type="hidden" class="form-control col-3" id="input1" name="lower" value="$_GET['input1']">
                                                    <input type="hidden" class="form-control col-3" id="input2" name="upper">
                                                </div>
                                                <div class="mt-2">
                                                    Value: <span id="demo1" style="text-transform: capitalize"></span> - <span id="demo2" style="text-transform: capitalize"></span>
                                                </div>
                                            </div>--}}
                                            <div class="col-lg-2">
                                                <p class="mt-4">
                                                    <button class="btn custom-btn btn-primary" type="submit">Search
                                                    </button>
                                                    <a href="{{ route('model.index') }}" class="btn custom-btn btn-danger" id="reset">
                                                        Reset
                                                    </a>
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
                                        <th scope="col">Variants</th>
                                        <th scope="col">Brand</th>
                                        <th scope="col">Category</th>
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
                                                    <a href="{{route('model.edit', $model->model_id)}}">{{$model->model_name}}</a>
                                                </td>
                                                <td>
                                                    <a href="{{route('model.variants', ['base' => $model->model_id])}}">{{$model->variants->count()}}</a>
                                                    <a style="margin-left: 10px;" data-toggle="tooltip" data-placement="top" title="Add Variant" class="btn btn-sm btn-success" href="{{ route('model.createvariant', ['parent_id' => $model->model_id]) }}"><i class="fas fa-plus"></i></a>
                                                </td>
                                                <td>{{$model->brand->brand_name}}</td>
                                                <td>
                                                    {!! Form::select('model_category_id[]', $model_category, $model->categories, ['data-id' => $model->model_id, 'multiple' => 'multiple', 'class' => 'form-control model_category', 'rows' => '4', 'placeholder' => 'Select']) !!}
                                                </td>
                                                <td>
                                                    {{$model->launch_date}}
                                                </td>
                                                <td>
                                                    {{$model->created_at}}
                                                </td>
                                                <td>
                                                    {{--@if($model->parent_id == null)
                                                        <a href="{{route('model.show', $model->model_id)}}"
                                                            class="btn btn-sm btn-success"><i class="far fa-eye" data-toggle="tooltip" data-placement="top" title="View"></i></a>
                                                    @else
                                                        <a href="{{route('model.variantdetails', $model->model_id)}}"
                                                            class="btn btn-sm btn-success"><i class="far fa-eye" data-toggle="tooltip" data-placement="top" title="View"></i></a>
                                                    @endif--}}
                                                    <a href="{{route('model.edit', $model->model_id)}}"
                                                       class="btn btn-sm btn-primary">
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

{{--        <script>--}}
{{--            $('#reset').click(function () {--}}
{{--                $('input').val('');--}}
{{--                $('#department-form').submit();--}}
{{--            });--}}
{{--        </script>--}}
    </section>

@endsection

@section('scripts')

    <script>
        $('.okay').selectize();

       /*var stepSlider = document.getElementById('range');
       var input0 = document.getElementById('input1');
       var input1 = document.getElementById('input2');
       var inputs = [input0, input1];

       noUiSlider.create(stepSlider, {
           start: [1000000, 20000000],
           connect: true,
           tooltips: false,
           range:{
               'min':[1000000,1000000],
               '10%':[2000000,2000000],
               '20%':[3000000, 3000000],
               '30%':[4000000, 4000000],
               '40%':[5000000, 5000000],
               '50%':[6000000, 6000000],
               '60%':[7000000, 7000000],
               '70%':[8000000, 8000000],
               '80%':[9000000, 9000000],
               '90%':[10000000, 10000000],
               'max':20000000
           },
           format: wNumb({
               decimals:0,
           })
       });
       stepSlider.noUiSlider.on('update', function(values, handle){
           inputs[handle].value = values[handle];
           let value0 = (values[0]);
           let value1 = (values[1]);
           ($("#input1").val(values[0]));
           ($("#input2").val(values[1]));
           var x = inWords(value0);
           var y = inWords(value1);
           const amount = (x);
           // console.log(x);
            $("#demo1").html(x);
            $("#demo2").html(y);
       });


       function inWords (num) {
       const a = ['', '1 ', '2 ', '3 ', '4 ', '5 ', '6 ', '7 ', '8 ', '9 ', '10 ', '11 ', '12 ', '13 ', '14 ', '15 ', '16 ', '17 ', '18 ', '19 ']
       const b = ['', '', '20', '30', '40', '50', '60', '70', '80', '90']
           if ((num = num.toString()).length > 9) {
               throw new Error('overflow') // Does not support converting more than 9 digits yet
           }
            console.log(num);
           const n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
           if (!n) return

           let str = ''
           str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : ''
           str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : ''
           str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : ''
           str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : ''
           str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) : ''

           return str.trim()
       }*/
        $('.model_category').selectize({
            plugins: ['remove_button'],
            maxItems: 10,
            onItemAdd: function(value, $item){
                const _this = $(this)[0]
                updateModelCategory(_this, value, $item, 0);
            },
            onItemRemove: function(value, $item){
                const _this = $(this)[0]
                updateModelCategory(_this, value, $item, 1);
            }
        });

        function updateModelCategory(_this, value, $item, removeFlag){
            const allValues = [(value)]
            const model_id = $(_this.$input['0']).data('id');
            //update the categories of the model accordingly
            $.ajax({
                url: '{{route('model.ajaxcategoryupdate')}}',
                type: 'POST',
                data:{
                    _token: '{{ csrf_token() }}',
                    model_id: model_id,
                    ids : allValues,
                    remove: removeFlag,
                },
                success: function(data){
                    //console.log(data);
                    if(!data.status){
                        toastr.error(data.mesg);
                        (_this).removeItem($item)
                    }

                }
            });
        }
    </script>

@endsection
