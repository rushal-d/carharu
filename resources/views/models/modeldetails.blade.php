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
                                <div class="col-2">
                                    <h3>{{$model->model_name}}</h3>
                                </div>
                                <div class="col-10 text-right mb-2">
                                    <a href="{{route('review.create', ['id' => $model->model_id])}}" class="btn btn-success">Write a Review</a>
                                    <a href="{{route('blogs.create', ['id' => $model->model_id])}}" class="btn btn-success">Write a Blog</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- filter ends -->
                            <div class="table-responsive" id="tableid">
                                <table class="table table-striped table-hover department-table">
                                    <thead>
                                    <tr>
                                        <th scope="col">S.No.</th>
                                        <th scope="col">Variant Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($listofmodels as $listofmodel)
                                            <tr>
                                                <th scope="row">{{ ($listofmodels->currentpage()-1) * $listofmodels->perpage() + $loop->index + 1 }}</th>
                                                <td>
                                                    <a style="color:#0c0e10" href="{{route('model.variantdetails', $listofmodel->model_id)}}">{{$listofmodel->model_name}}</a>
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-warning" href="{{route('model.edit', $listofmodel->model_id)}}"><i class="fas fa-edit"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="100%" class="text-center">Currently there are no variants.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="text-center">{{$listofmodels->links()}}</div>
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
        $(function () {
            $('.rateyo-readonly-widg').each(function(i, obj) {
                var rating = $(this).data('rating');
                $(this).rateYo({
                    rating: $(this).data('rating'),
                    readOnly: true,
                    halfStar: true,
                    spacing: "10px",
                    multiColor: {
                        "startColor": "#FF0000", //RED
                        "endColor"  : "#00FF00"  //GREEN
                    },
                    numStars: 5,
                    precision: 0,
                    minValue: 1,
                    maxValue: 5
                })
            });
        });
    </script>
@endsection

