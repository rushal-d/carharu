@extends('layouts.app')

@section('styles')
@endsection

@section('content')

    <section class="padding-block">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card custom-card create">
                        <div class="card-header">
                            <h3>Compare</h3>
                        </div>
                        <div class="card-body">
                            <!-- filter -->
                            <div class="filter">
                                <div class="row form-group">
                                    <h3 class="d-md-none text-center btn custom-filter-button">Toggle Filter <i
                                            class="custom-filter-caret fas fa-caret-down"></i></h3>
                                    <div
                                        class="filter custom-filter-bar do-not-display-filter-bar-for-small-device col-md-12">
                                        {!! Form::open(['route' => 'model.compare', 'method' => 'GET', 'id' => 'form']) !!}
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="row clone">
                                                    <div class="to-be-clone col-lg-3">
                                                        <div class="brand-model-container">
                                                            <div class="form-group brands-div">
                                                                {!! Form::select('brand_id', $brands, null, ['id' => 'brand_id', 'class' => 'form-control brand', 'placeholder' => 'Brands']) !!}
                                                            </div>
                                                            <div class="form-group models-div">
                                                                {!! Form::select('model_id[]', [], null, ['id' => 'model_id', 'class' => 'form-control model', 'placeholder' => 'Models']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <p class="mt-4">
                                                    <button class="btn custom-btn btn-sm btn-success" type="reset"
                                                            id="add">
                                                        Add Model
                                                    </button>
                                                    <button class="btn custom-btn btn-sm btn-danger remove" type="reset"
                                                            id="remove">
                                                        Remove
                                                    </button>
                                                    <button id="compare" class="btn custom-btn btn-sm btn-primary" type="submit">
                                                        Compare
                                                    </button>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="appended-view">
                {{--@if(!empty($mods) && $mods->count() > 0)
                    @foreach($mods as $mod)
                        <div class="col-lg-3" style="background-color: #ffffff;border: 1px solid #000000">
                            <h3>{{$mod->model_name}}</h3>
                        </div>
                    @endforeach
                @else
                @endif--}}
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script>

        //ajax for search and appending the partial view
        $('#compare').click(function (e) {
            e.preventDefault();
            let modelIds = [];
            $('.model').map(function(){
                //console.log(modelIds.push($(this).val()));
            });
            $.ajax(({
                url:'{!! route("compareByAjax", $_GET) !!}',
                type: 'get',
                data: {
                    '_token':'{{csrf_token()}}',
                    modelIds: modelIds
                },
                success:function (data) {
                    $('#appended-view').html(data.view);
                },
            }));
        });

        //cloning and removing
        $(document).ready(function () {
            $("body").on("click", "#add", function (e) {
                e.preventDefault();
                // $('.drop')[0].selectize.destroy();
                if ($(".to-be-clone").length < 4) {
                    var html = $(".to-be-clone").first().clone();
                    var $_what = html.find('.brand-model-container').children('.models-div').find('.model');
                    $_what.find("option").remove();
                    $(".to-be-clone").parent().find('.to-be-clone').last().after(html);
                    // $('.drop').selectize();
                }
                return false;
            });
        })

        $(".remove").click(function () {
            if ($(".to-be-clone").length > 1) {
                $(".clone").find(".to-be-clone").last().remove();
            }
            return false;
        });

        //ajax for dependent dropdown
        $(document).on("change", '.brand', function () {
            let $_this = $(this);
            //console.log($_this.val());
            let $_brand_model_container = $_this.closest('.brand-model-container');
            // console.log($('#brand_id').val());
            $.ajax({
                url: '{{route('ajax-get-models-by-brand-id')}}',
                type: 'GET',
                data:{
                    brand_id: $_this.val(),
                },
                success: function (response){
                  if(response.status === 'false'){

                  }else{
                      // console.log(response.data);
                    let models = response.data;
                      //console.log(models);
                      //console.log($_this);
                      let model_select_input = $_brand_model_container.find('.models-div').find('.model');
                          model_select_input.find('option')
                          .remove()
                          .end()
                      ;
                      $.each(models, function(id, model_name){
                            let $options = $("<option/>", {
                                value: id,
                                text: model_name
                            });

                          model_select_input.append($options);
                      });
                  }
                },
                error: function (response) {

                }
            });
        });

    </script>
@endsection
