<section class="padding-block">
    <div class="container-fluid">
        {{ Form::open(['route' => 'sub-attributes-options-store', 'id' => 'main-form']) }}
        <div class="row">
            <div class="col-lg-12"><!-- first column -->
                <div class="card custom-card create-wrapper">
                    <div class="card-header">
                        <h3>Add</h3>
                    </div>
                    <div class="card-body">
                        <div class="row"><!-- main row open-->
                            <!-- opening of one field -->
                            {!! Form::label('attribute', 'Feature: <span class="required-field"> *</span>', ['class' => 'col-xs-3 col-md-3'], false); !!}
                            <div class="col-xs-9 col-md-9 form-group">
                                {!! Form::select('subattribute_id', $features, array_keys($features->toArray()), ['class' => 'form-control selectize-select', 'data-validation' => 'required', 'placeholder' => 'Select']) !!}
                            </div>
                        </div>
                        <div class="row">
                            {!! Form::label('Color Name', 'Color Name: <span class="required-field"> *</span>', ['class' => 'col-xs-3 col-md-3'], false); !!}
                            <div class="col-xs-9 col-md-9 form-group">
                                {!! Form::text('label', null, ['class' => 'form-control label', 'required' => 'required']) !!}
                            </div>
                        </div>
                        <div class="row">
                            {!! Form::label('Color Value', 'Hex (# Not needed) <span class="required-field"> *</span>', ['class' => 'col-xs-3 col-md-3'], false); !!}
                            <div class="col-xs-9 col-md-9 form-group">
                                {!! Form::text('value', null, ['minLength' => 6, 'maxLength' => 6, 'class' => 'form-control value', 'required' => 'required']) !!}
                            </div>
                        </div>
                        <p class="text-right">
                            <button id="btn-submit" class="btn custom-btn btn-success" type="submit">Create</button>
                        </p>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</section>
