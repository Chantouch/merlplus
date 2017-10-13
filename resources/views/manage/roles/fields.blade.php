@if(isset($role))
    <label for="name">
        Slug
        <small>(Can not be changed)</small>
        :
    </label>
@else
    {!! Form::label('name', __('admin.slug')) !!}
@endif
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <div class="form-line">
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter your slug']) !!}
    </div>
    @if ($errors->has('name'))
        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif
</div>

{!! Form::label('display_name', __('admin.name')) !!}
<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    <div class="form-line">
        {!! Form::text('display_name', null, ['class' => 'form-control', 'placeholder' => 'Enter your display name']) !!}
    </div>
    @if ($errors->has('display_name'))
        <span class="help-block">
            <strong>{{ $errors->first('display_name') }}</strong>
        </span>
    @endif
</div>

{!! Form::label('description', __('admin.description')) !!}
<div class="form-group">
    <div class="form-line">
        {!! Form::textarea('description', null, ['class' => 'form-control no-resize auto-growth', 'placeholder' => 'Enter your description','rows'=>1]) !!}
    </div>
    @if ($errors->has('description'))
        <span class="help-block">
            <strong>{{ $errors->first('description') }}</strong>
        </span>
    @endif
    <input type="hidden" :value="permissionsSelected" name="permissions">
</div>

<div class="form-group">
    {!! Form::label('permissions', __('admin.permission')) !!}<br>
    @foreach($permissions as  $permission)
        {{--{!! Form::checkbox('permissions', $permission->id, null, ['class' => 'filled-in', 'id'=> $permission->id,'v-model'=>'permissionsSelected']) !!}--}}
        <input name="permission" type="checkbox" id="{!! $permission->id !!}" value="{!! $permission->id !!}" class="filled-in chk-col-red"
               v-model="permissionsSelected"/>
        <label for="{!! $permission->id !!}">{!! $permission->display_name !!}</label><br>
    @endforeach
    @if ($errors->has('permission'))
        <span class="help-block">
            <strong>{{ $errors->first('permission') }}</strong>
        </span>
    @endif
</div>

<br>
<button class="btn btn-primary m-t-15 waves-effect">{!! __('admin.submit') !!}</button>
<a href="{!! route('admin.manage.role.index') !!}" class="btn btn-primary m-t-15 waves-effect">{!! __('admin.cancel') !!}</a>