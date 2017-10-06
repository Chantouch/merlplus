@if(count($pages)>1)
    {!! Form::label('parent_id', 'Page Level:') !!}
    <div class="form-group">
        <div class="form-line">
            {!! Form::select('parent_id',$pages , null, ['class' => 'form-control show-tick', 'data-live-search' => 'true', 'placeholder' => 'Select page']) !!}
        </div>
    </div>
@endif

{!! Form::label('name', 'Page Name:') !!}
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

{!! Form::label('slug', 'Page slug:') !!}
<div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
    <div class="form-line">
        {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Enter your page slug']) !!}
    </div>
    @if ($errors->has('slug'))
        <span class="help-block">
            <strong>{{ $errors->first('slug') }}</strong>
        </span>
    @endif
</div>

{!! Form::label('description', 'Page Description:') !!}
<div class="form-group">
    <div class="form-line">
        {!! Form::textarea('description', null, ['class' => 'form-control summernote', 'placeholder' => 'Enter your page description']) !!}
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
        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
            <div class="form-control" data-trigger="fileinput">
                <i class="glyphicon glyphicon-file fileinput-exists"></i>
                <span class="fileinput-filename"></span>
            </div>
            <span class="input-group-addon btn btn-default btn-file">
                <span class="fileinput-new">Select file</span>
                <span class="fileinput-exists">Change</span>
                <input type="file" name="file" @change.prevent="previewImage" accept="image/*">
            </span>
            <a href="javascript:void (0)" class="input-group-addon btn btn-default fileinput-exists"
               data-dismiss="fileinput" @click.prevent="removeImage">Remove</a>
        </div>
    </div>
    @if ($errors->has('file'))
        <span class="help-block">
            <strong>{{ $errors->first('file') }}</strong>
        </span>
    @endif
</div>
<div class="img-preview" v-if="images.length > 0">
    <img class="img-thumbnail" :src="images" alt="Image thumbnail">
</div>

<div class="checkbox checkbox-success">
    {{ Form::hidden('status', '0') }}
    {!! Form::checkbox('status', '1', null, ['id'=> 'status']) !!}
    <label for="status"> <span>Active</span> </label>
</div>

<button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
<a href="{!! route('admin.ref.page.index') !!}" class="btn btn-primary m-t-15 waves-effect">CANCEL</a>