<div class="row">
    <div class="col-md-6">
        @if(count($categories)>1)
            {!! Form::label('parent_id', 'Category Level:') !!}
            <div class="form-group">
                <div class="form-line">
                    {!! Form::select('parent_id',$categories , null, ['class' => 'form-control show-tick', 'data-live-search' => 'true', 'placeholder' => 'Select category']) !!}
                </div>
            </div>
        @endif

        {!! Form::label('slug', 'Category slug:') !!}
        <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
            <div class="form-line">
                {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Enter your category slug']) !!}
            </div>
            @if ($errors->has('slug'))
                <span class="help-block">
                        <strong>{{ $errors->first('slug') }}</strong>
                    </span>
            @endif
        </div>

    </div>
    <div class="col-md-6">
        {!! Form::label('name', 'Category Name:') !!}
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <div class="form-line">
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter your category name']) !!}
            </div>
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        {!! Form::label('color_id', 'Category Color:') !!}
        <div class="form-group{{ $errors->has('color_id') ? ' has-error' : '' }}">
            <div class="input-group">
                <span class="input-group-addon" id="color-id-category">@</span>
                {!! Form::text('color_id', null, ['class' => 'form-control', 'placeholder' => 'Enter your category color', 'aria-describedby' => 'color-id-category']) !!}
            </div>
            @if ($errors->has('color_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('color_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

{!! Form::label('description', 'Category Description:') !!}
<div class="form-group">
    <div class="form-line">
        {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Enter your category description']) !!}
    </div>
    @if ($errors->has('description'))
        <span class="help-block">
            <strong>{{ $errors->first('description') }}</strong>
        </span>
    @endif
</div>


<div class="form-group tagsinput-area">
    <label for="tag">Tag:</label>
    <input type="hidden" name="tags" :value="tags">
    <div class="form-line">
        <select class="form-control" multiple data-placeholder="Choose" id="tag" v-model="tags">
            <option v-for="tag in tag_lists.tags" :value="tag.id">@{{ tag.name }}</option>
        </select>
    </div>
    @if ($errors->has('tags'))
        <span class="help-block">
            <strong>{{ $errors->first('tags') }}</strong>
        </span>
    @endif
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
            <div class="row">
                <label class="col-sm-12">Image <span>(Please follow the size of image)</span></label>
                <div class="col-sm-12">
                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                        <div class="form-control" data-trigger="fileinput">
                            <i class="glyphicon glyphicon-file fileinput-exists"></i>
                            <span class="fileinput-filename"></span>
                        </div>
                        <span class="input-group-addon btn btn-default btn-file">
                            <span class="fileinput-new">Select file</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file" name="file" accept="image/*">
                        </span>
                        <a href="javascript:void (0)" class="input-group-addon btn btn-default fileinput-exists"
                           data-dismiss="fileinput">Remove</a>
                    </div>
                    @if ($errors->has('file'))
                        <span class="help-block">
                            <small>{{ $errors->first('file') }}</small>
                        </span>
                    @endif
                    @if(isset($category))
                        @if($category->hasThumbnail())
                            <img src="{!! $$category->thumbnail()->filename !!}" alt="{!! $advertise->provider_name !!}"
                                 class="img-responsive">
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        {!! Form::label('position_order', 'Category Order:') !!}
        <div class="form-group{{ $errors->has('position_order') ? ' has-error' : '' }}">
            <div class="input-group">
                <span class="input-group-addon" id="color-id-category">@</span>
                {!! Form::text('position_order', null, ['class' => 'form-control', 'placeholder' => 'Enter your category order', 'aria-describedby' => 'color-id-category']) !!}
            </div>
            @if ($errors->has('position_order'))
                <span class="help-block">
                    <strong>{{ $errors->first('position_order') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="checkbox checkbox-success">
    {{ Form::hidden('status', '0') }}
    {!! Form::checkbox('status', '1', null, ['id'=> 'status']) !!}
    <label for="status"> <span>Active</span> </label>
</div>

<button class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
<a href="{!! route('admin.ref.category.index') !!}" class="btn btn-primary m-t-15 waves-effect">CANCEL</a>