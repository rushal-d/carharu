@extends('layouts.app')
@section('styles')

@endsection

@section('content')
    <section class="padding-block">
        <div class="container-fluid">
            {{ Form::open(['route' => 'details.store']) }}
            <div class="row">
                @foreach($specs as $spec)
                <div class="col-lg-6"><!-- first column -->
                    <div class="card custom-card create-wrapper">
                        <div class="card-header">
                            <h3>Add a {{$spec->specification}}</h3>
                        </div>
                        <div class="card-body">
                            <div class="contact-form">
                                    <!-- opening of one field -->

                                {!! Form::hidden('model_id', $model->model_id) !!}

                                @foreach($feats as $feat)
                                    <?php
                                        $inputId = $feat->id;
                                    ?>
                                    @if($feat->spec->specification == $spec->specification)
                                        <p>
                                            {{$feat->feature}}
                                            {!! Form::text("features[$inputId]", null, ['class' => 'form-control', 'data-validation' => 'required']) !!}
                                        </p>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                    @endforeach
                </div>
                    <p class="text-right">
                        <button class="btn custom-btn btn-success" type="submit">Create</button>
                        <a href="{{route('details.index')}}" class="btn custom-btn btn-clear" type="submit">Cancel</a>
                    </p>
                {!! Form::close() !!}
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script>
        $('.drop').selectize();
    </script>
@endsection
