{!! Form::label('name', 'Name:') !!}
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <div class="form-line">
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter your city name']) !!}
    </div>
    @if ($errors->has('name'))
        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif
</div>

{!! Form::label('email', 'Email:') !!}
<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    <div class="form-line">
        {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Enter your email']) !!}
    </div>
    @if ($errors->has('email'))
        <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif
</div>

{!! Form::label('code', 'City Code:') !!}
<div class="form-group">
    <div class="form-line">
        {!! Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'Enter your city code']) !!}
    </div>
    @if ($errors->has('code'))
        <span class="help-block">
            <strong>{{ $errors->first('code') }}</strong>
        </span>
    @endif
</div>

{!! Form::label('description', 'City Description:') !!}
<div class="form-group">
    <div class="form-line">
        {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Enter your city description']) !!}
    </div>
    @if ($errors->has('description'))
        <span class="help-block">
            <strong>{{ $errors->first('description') }}</strong>
        </span>
    @endif
</div>

{{ Form::hidden('status', '0') }}
{!! Form::checkbox('status', '1', null, ['class' => 'filled-in', 'id'=> 'status']) !!}
<label for="status">Active</label>
<br>
<button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
<a href="{!! route('admin.cities.index') !!}" class="btn btn-primary m-t-15 waves-effect">CANCEL</a>