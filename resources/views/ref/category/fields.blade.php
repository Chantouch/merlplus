@if(count($categories)>1)
    {!! Form::label('parent_id', 'Category Level:') !!}
    <div class="form-group">
        <div class="form-line">
            {!! Form::select('parent_id',$categories , null, ['class' => 'form-control show-tick', 'data-live-search' => 'true', 'placeholder' => 'Select category']) !!}
        </div>
    </div>
@endif

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


{!! Form::label('file', 'Image:') !!}
<div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
    <div class="form-line">
        {!! Form::file('file', ['class' => 'form-control']) !!}
    </div>
    @if ($errors->has('file'))
        <span class="help-block">
            <strong>{{ $errors->first('file') }}</strong>
        </span>
    @endif
</div>



{{ Form::hidden('status', '0') }}
{!! Form::checkbox('status', '1', null, ['class' => 'filled-in', 'id'=> 'active']) !!}
<label for="active">Active</label>
<br>
<button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
<a href="{!! route('admin.ref.category.index') !!}" class="btn btn-primary m-t-15 waves-effect">CANCEL</a>