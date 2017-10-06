<div class="row">
    <div class="col-md-6">
        {!! Form::label('provider_name', 'Provider Name:') !!}
        <div class="form-group{{ $errors->has('provider_name') ? ' has-error' : '' }}">
            <div class="form-line">
                {!! Form::text('provider_name', null, ['class' => 'form-control', 'placeholder' => 'Enter your provider name']) !!}
            </div>
            @if ($errors->has('provider_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('provider_name') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        {!! Form::label('price', 'Price:') !!}
        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
            <div class="form-line">
                {!! Form::text('price', null, ['class' => 'form-control', 'placeholder' => 'Enter ads price']) !!}
            </div>
            @if ($errors->has('price'))
                <span class="help-block">
                    <strong>{{ $errors->first('price') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        {!! Form::label('start_date', 'Start Date:') !!}
        <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
            <div class="form-line">
                {!! Form::date('start_date', null, ['class' => 'form-control']) !!}
            </div>
            @if ($errors->has('start_date'))
                <span class="help-block">
                    <strong>{{ $errors->first('start_date') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        {!! Form::label('end_date', 'End Date:') !!}
        <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
            <div class="form-line">
                {!! Form::date('end_date', null, ['class' => 'form-control']) !!}
            </div>
            @if ($errors->has('end_date'))
                <span class="help-block">
                    <strong>{{ $errors->first('end_date') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

{!! Form::label('advertise_type_id', 'Ads Type:') !!}
<div class="form-group{{ $errors->has('advertise_type_id') ? ' has-error' : '' }}">
    <div class="form-line">
        <input type="hidden" name="advertise_type_id" :value="advertise.adv_type">
        <select id="advertise_type_id" v-model="advertise.adv_type" class="form-control">
            <option value="">---Select---</option>
            <option v-for="ads in advertise_type" :value="ads.id">@{{ ads.name }}</option>
        </select>
    </div>
    @if ($errors->has('advertise_type_id'))
        <span class="help-block">
            <strong>{{ $errors->first('advertise_type_id') }}</strong>
        </span>
    @endif
</div>
<div class="row" v-if="advertise.adv_type == '7' || advertise.adv_type == '8'">
    <div class="col-md-12">
        {!! Form::label('tracking_code_large', 'Tracking code (Large format):') !!}
        <div class="form-group">
            <div class="form-line">
                {!! Form::textarea('tracking_code_large', null, ['class' => 'form-control', 'placeholder' => 'Enter your tracking code large']) !!}
            </div>
            @if ($errors->has('tracking_code_large'))
                <span class="help-block">
                    <strong>{{ $errors->first('tracking_code_large') }}</strong>
                </span>
            @endif
        </div>

        {!! Form::label('tracking_code_tablet', 'Tracking code (Tablet format):') !!}
        <div class="form-group">
            <div class="form-line">
                {!! Form::textarea('tracking_code_tablet', null, ['class' => 'form-control', 'placeholder' => 'Enter your tracking code tablet']) !!}
            </div>
            @if ($errors->has('tracking_code_tablet'))
                <span class="help-block">
                <strong>{{ $errors->first('tracking_code_tablet') }}</strong>
            </span>
            @endif
        </div>

        {!! Form::label('tracking_code_mobile', 'Tracking code (Mobile format):') !!}
        <div class="form-group">
            <div class="form-line">
                {!! Form::textarea('tracking_code_mobile', null, ['class' => 'form-control', 'placeholder' => 'Enter your tracking code mobile']) !!}
            </div>
            @if ($errors->has('tracking_code_mobile'))
                <span class="help-block">
                    <strong>{{ $errors->first('tracking_code_mobile') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="row" v-else="">
    <div class="col-md-12">
        <label for="is_video">Is Video?</label>
        <div class="form-group">
            <input type="hidden" name="is_video" :value="advertise.is_video">
            <input type="checkbox" id="is_video" v-model="advertise.is_video" @change.prevent="isVideo" value="1">
        </div>
    </div>

    <div class="col-md-12" v-if="advertise.is_video">
        <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}" v-if="advertise.is_video">
            {!! Form::label('url', 'Provider URL:') !!}
            {!! Form::textarea('url', null, ['class' => 'form-control summernote', 'placeholder' => 'Enter your url']) !!}
            @if ($errors->has('url'))
                <span class="help-block">
                    <small>{{ $errors->first('url') }}</small>
                </span>
            @endif
        </div>
    </div>

    <div class="col-md-12" v-else="">
        <div class="row">
            <div class="col-md-12">
                {!! Form::label('url', 'Provider URL:') !!}
                <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                    <div class="form-line">
                        {!! Form::text('url', null, ['class' => 'form-control', 'placeholder' => 'Enter your provider url']) !!}
                    </div>
                    @if ($errors->has('url'))
                        <span class="help-block">
                            <strong>{{ $errors->first('url') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <!--Image of ads-->
            <div class="form-group{{ $errors->has('banner') ? ' has-error' : '' }}">
                <label class="col-sm-12">Banner Image <span>(Please follow the ads size of image)</span></label>
                <div class="col-sm-12">
                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                        <div class="form-control" data-trigger="fileinput">
                            <i class="glyphicon glyphicon-file fileinput-exists"></i>
                            <span class="fileinput-filename"></span>
                        </div>
                        <span class="input-group-addon btn btn-default btn-file">
                            <span class="fileinput-new">Select file</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file" name="banner" accept="image/*">
                        </span>
                        <a href="javascript:void (0)" class="input-group-addon btn btn-default fileinput-exists"
                           data-dismiss="fileinput">Remove</a>
                    </div>
                    @if ($errors->has('banner'))
                        <span class="help-block">
                            <small>{{ $errors->first('banner') }}</small>
                        </span>
                    @endif
                    @if(isset($advertise))
                        @if($advertise->hasBanner())
                            <img src="" alt="{!! $advertise->provider_name !!}" class="img-responsive">
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


<div class="checkbox checkbox-success">
    {{ Form::hidden('active', '0') }}
    {!! Form::checkbox('active', '1', null, ['id'=> 'status']) !!}
    <label for="status"> <span>Active</span> </label>
</div>

<button class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
<a href="{!! route('admin.advertise.index') !!}" class="btn btn-primary m-t-15 waves-effect">CANCEL</a>