{!! Form::label('name', __('admin.name')) !!}
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <div class="form-line">
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter your page name']) !!}
    </div>
    @if ($errors->has('name'))
        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif
</div>

{!! Form::label('slug', __('admin.slug')) !!}
<div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
    <div class="form-line">
        {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Enter your advertise type slug']) !!}
    </div>
    @if ($errors->has('slug'))
        <span class="help-block">
            <strong>{{ $errors->first('slug') }}</strong>
        </span>
    @endif
</div>

<div class="row">
    <div class="col-md-6">

        {!! Form::label('width', __('admin.width')) !!}
        <div class="form-group{{ $errors->has('width') ? ' has-error' : '' }}">
            <div class="form-line">
                {!! Form::text('width', null, ['class' => 'form-control', 'placeholder' => 'Enter your advertise type width']) !!}
            </div>
            @if ($errors->has('width'))
                <span class="help-block">
                    <strong>{{ $errors->first('width') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        {!! Form::label('height', __('admin.height')) !!}
        <div class="form-group{{ $errors->has('height') ? ' has-error' : '' }}">
            <div class="form-line">
                {!! Form::text('height', null, ['class' => 'form-control', 'placeholder' => 'Enter your advertise type height']) !!}
            </div>
            @if ($errors->has('height'))
                <span class="help-block">
                    <strong>{{ $errors->first('height') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="checkbox checkbox-success">
    {{ Form::hidden('active', '0') }}
    {!! Form::checkbox('active', '1', null, ['id'=> 'status']) !!}
    <label for="status"> <span>{!! __('admin.active') !!}</span> </label>
</div>

<button class="btn btn-primary m-t-15 waves-effect">{!! __('admin.submit') !!}</button>
<a href="{!! route('admin.advertise-type.index') !!}" class="btn btn-primary m-t-15 waves-effect">{!! __('admin.cancel') !!}</a>