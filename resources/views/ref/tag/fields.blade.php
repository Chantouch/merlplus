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

{!! Form::label('slug', __('admin.slug')) !!}
<div class="form-group">
    <div class="form-line">
        {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Enter your slug']) !!}
    </div>
    @if ($errors->has('slug'))
        <span class="help-block">
            <strong>{{ $errors->first('slug') }}</strong>
        </span>
    @endif
</div>

<!--Feature image for tag -->
<label for="feature_image">{!! __('admin.thumbnail') !!} (Size: 1920x760)</label>
<div class="form-group{{ $errors->has('thumbnail') ? ' has-error' : '' }}">
    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
        <div class="form-control" data-trigger="fileinput">
            <i class="glyphicon glyphicon-file fileinput-exists"></i>
            <span class="fileinput-filename"></span>
        </div>
        <span class="input-group-addon btn btn-default btn-file">
            <span class="fileinput-new">{!! __('admin.select_image') !!}</span>
            <span class="fileinput-exists">{!! __('admin.change') !!}</span>
            <input type="file" name="thumbnail" accept="image/*">
        </span>
        <a href="javascript:void (0)" class="input-group-addon btn btn-default fileinput-exists"
           data-dismiss="fileinput">{!! __('admin.remove') !!}</a>
    </div>
    @if ($errors->has('thumbnail'))
        <span class="help-block">
            <small>{{ $errors->first('thumbnail') }}</small>
        </span>
    @endif
</div>

<!--Menu image for tag -->
<label for="menu_thumbnail">{!! __('admin.menu_thumbnail') !!} (Size: 112x72)</label>
<div class="form-group{{ $errors->has('menu_thumbnail') ? ' has-error' : '' }}">
    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
        <div class="form-control" data-trigger="fileinput">
            <i class="glyphicon glyphicon-file fileinput-exists"></i>
            <span class="fileinput-filename"></span>
        </div>
        <span class="input-group-addon btn btn-default btn-file">
            <span class="fileinput-new">{!! __('admin.select_image') !!}</span>
            <span class="fileinput-exists">{!! __('admin.change') !!}</span>
            <input type="file" name="menu_thumbnail" accept="image/*">
        </span>
        <a href="javascript:void (0)" class="input-group-addon btn btn-default fileinput-exists"
           data-dismiss="fileinput">{!! __('admin.remove') !!}</a>
    </div>
    @if ($errors->has('menu_thumbnail'))
        <span class="help-block">
            <small>{{ $errors->first('menu_thumbnail') }}</small>
        </span>
    @endif
</div>

<div class="checkbox checkbox-info">
    {{ Form::hidden('is_menu', '0') }}
    {!! Form::checkbox('is_menu', '1', null, ['id'=> 'is_menu']) !!}
    <label for="is_menu"> <span>{!! __('app.is_menu') !!}</span> </label>
</div>

<div class="checkbox checkbox-success">
    {{ Form::hidden('status', '0') }}
    {!! Form::checkbox('status', '1', null, ['id'=> 'status']) !!}
    <label for="status"> <span>{!! __('admin.active') !!}</span> </label>
</div>

<button class="btn btn-primary m-t-15 waves-effect">{!! __('admin.submit') !!}</button>
<a href="{!! route('admin.ref.tag.index') !!}" class="btn btn-primary m-t-15 waves-effect">{!! __('admin.cancel') !!}</a>