@if(!isset($permission))
    <div class="form-group">
        {!! Form::radio('permission_type', 'basic', null, ['class' => 'with-gap radio-col-red', 'id'=> 'basic','v-model'=>'permissionType']) !!}
        <label for="basic">Basic Permission</label>
        {!! Form::radio('permission_type', 'crud', null, ['class' => 'with-gap radio-col-purple', 'id'=> 'crud','v-model'=>'permissionType']) !!}
        <label for="crud">CRUD Permission</label>
    </div>
@endif
<div id="basic_form" v-if="permissionType == 'basic'">
    {!! Form::label('name', 'Name:') !!}
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

    {!! Form::label('display_name', 'Display Name:') !!}
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

    {!! Form::label('description', 'Description:') !!}
    <div class="form-group">
        <div class="form-line">
            {!! Form::textarea('description', null, ['class' => 'form-control no-resize auto-growth', 'placeholder' => 'Enter your description','rows'=>1]) !!}
        </div>
        @if ($errors->has('description'))
            <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif
    </div>
</div>
@if(!isset($permission))
    <div id="crud_form" v-if="permissionType == 'crud'">
        {!! Form::label('resource', 'Resource:') !!}
        <div class="form-group{{ $errors->has('resource') ? ' has-error' : '' }}">
            <div class="form-line">
                {!! Form::text('resource', null, ['class' => 'form-control', 'placeholder' => 'Enter your resource','v-model'=>'resource']) !!}
            </div>
            @if ($errors->has('resource'))
                <span class="help-block">
                <strong>{{ $errors->first('resource') }}</strong>
            </span>
            @endif
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <input name="create" type="checkbox" id="create" value="create" class="filled-in chk-col-red"
                           v-model="crudSelected"/>
                    <label for="create">Create</label><br>
                    <input name="read" type="checkbox" id="read" value="read" class="filled-in chk-col-pink"
                           v-model="crudSelected"/>
                    <label for="read">Read</label><br>
                    <input name="update" type="checkbox" id="update" value="update" class="filled-in chk-col-purple"
                           v-model="crudSelected"/>
                    <label for="update">Update</label><br>
                    <input name="delete" type="checkbox" id="delete" value="delete" class="filled-in chk-col-indigo"
                           v-model="crudSelected"/>
                    <label for="delete">Delete</label>
                </div>
                <input type="hidden" name="crud_selected" :value="crudSelected">
            </div>
            <div class="col-md-6">
                <table class="table" v-if="resource.length >= 3">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in crudSelected">
                        <td v-text="crudName(item)"></td>
                        <td v-text="crudSlug(item)"></td>
                        <td v-text="crudDescription(item)"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif
<br>
<button class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
<a href="{!! route('admin.manage.permission.index') !!}" class="btn btn-primary m-t-15 waves-effect">CANCEL</a>