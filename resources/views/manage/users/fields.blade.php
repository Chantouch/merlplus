<div class="row">
    <div class="col-md-6">
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            {!! Form::label('name', 'Name:',['class'=>'col-md-12']) !!}
            <div class="col-md-12">
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter your name']) !!}
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        {!! Form::label('email', 'Email:') !!}
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <div class="col-md-12">
                {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Enter your email']) !!}
            </div>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <!--Image of ads-->
        <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
            <label class="col-sm-12">Avatar <span>(Please follow the ads size of image)</span></label>
            <div class="col-sm-12">
                <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                    <div class="form-control" data-trigger="fileinput">
                        <i class="glyphicon glyphicon-file fileinput-exists"></i>
                        <span class="fileinput-filename"></span>
                    </div>
                    <span class="input-group-addon btn btn-default btn-file">
                        <span class="fileinput-new">Select file</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" name="avatar" accept="image/*">
                    </span>
                    <a href="javascript:void (0)" class="input-group-addon btn btn-default fileinput-exists"
                       data-dismiss="fileinput">Remove
                    </a>
                </div>
                @if ($errors->has('avatar'))
                    <span class="help-block">
                        <small>{{ $errors->first('avatar') }}</small>
                    </span>
                @endif
            </div>
        </div>
        <div class="m-b-20">
            @if(isset($user))
                @if($user->hasThumbnail())
                    <img src="{!! asset('storage/uploads/user/'.$user->thumbnail()->filename) !!}" alt="{!! $user->name !!}" class="img-responsive">
                @endif
            @endif
        </div>
    </div>
</div>
{!! Form::label('password', 'Password:') !!}<br>
@if(isset($user))
    <div class="form-group">
        <div class="col-md-12">
            <input name="password_options" type="radio" id="keep" value="keep" class="with-gap radio-col-red"
                   checked/>
            <label for="keep">Do Not Change Password</label>
        </div>
    </div>
@endif
<div class="form-group">
    <div class="col-md-12">
        <input name="password_options" type="radio" id="auto" value="auto" class="with-gap radio-col-pink"/>
        <label for="auto">Auto-Generate New Password</label>
    </div>
</div>
<div class="form-group">
    <div class="col-md-12">
        <input name="password_options" type="radio" id="manual" value="manual"
               class="with-gap radio-col-purple"/>
        <label for="manual">Manually Set New Password</label>
    </div>
</div>
<div class="form-group" id="password_manual">
    @if ($errors->has('password'))
        <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
    @endif
</div>
<div class="form-group">
    <div class="col-md-12">
        {!! Form::label('roles', 'Roles:') !!}<br>
        @foreach($roles as  $role)
            {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'filled-in', 'id'=> $role->id]) !!}
            <label for="{!! $role->id !!}">{!! $role->display_name !!}</label><br>
        @endforeach
        @if ($errors->has('roles[0]'))
            <span class="help-block">
                <strong>{{ $errors->first('roles[0]') }}</strong>
            </span>
        @endif
    </div>
</div>
<br>
<button class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
<a href="{!! route('admin.manage.user.index') !!}" class="btn btn-primary m-t-15 waves-effect">CANCEL</a>