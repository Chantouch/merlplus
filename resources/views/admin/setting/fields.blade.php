<div class="row">
    <div class="col-md-12">
        {!! Form::label('name', __('admin.name')) !!}
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <div class="form-line">
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter your name']) !!}
            </div>
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        {!! Form::label('description', __('admin.description')) !!}
        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            <div class="form-line">
                {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Enter description']) !!}
            </div>
            @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        @if(isset($json))
            {!! Form::label($json->name, $json->label . ':') !!}
        @endif
        <div class="form-group{{ $errors->has('value') ? ' has-error' : '' }}">
            <div class="form-line">
                @if($json->type == 'image')
                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                        <div class="form-control" data-trigger="fileinput">
                            <i class="glyphicon glyphicon-file fileinput-exists"></i>
                            <span class="fileinput-filename"></span>
                        </div>
                        <span class="input-group-addon btn btn-default btn-file">
                            <span class="fileinput-new">Select file</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file" name="value" accept="image/*">
                        </span>
                        <a href="javascript:void (0)" class="input-group-addon btn btn-default fileinput-exists"
                           data-dismiss="fileinput">Remove</a>
                    </div>
                @elseif($json->type == 'checkbox')
                    {{ Form::hidden('value', '0') }}
                    {!! Form::checkbox('value', '1', null, ['class' => 'filled-in', 'id'=> 'value']) !!}
                @elseif($json->type =='select_from_array')
                    {!! Form::select('value', $json->options, null, ['class' => 'form-control']) !!}
                @else
                    {!! Form::text('value',null , ['class' => 'form-control', 'placeholder' => 'Enter value']) !!}
                @endif
            </div>
            @if ($errors->has('value'))
                <span class="help-block">
                    <strong>{{ $errors->first('value') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<button class="btn btn-primary m-t-15 waves-effect">{!! __('admin.submit') !!}</button>
<a href="{!! route('admin.settings.index') !!}" class="btn btn-primary m-t-15 waves-effect">{!! __('admin.cancel') !!}</a>