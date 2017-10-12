<div class="form-group">
    <label class="col-md-12">Full Name</label>
    <div class="col-md-12">
        {!! Form::text('name', null, ['class' => 'form-control form-control-line', 'placeholder' => 'Administrator']) !!}
    </div>
</div>
<div class="form-group">
    <label for="example-email" class="col-md-12">Email</label>
    <div class="col-md-12">
        {!! Form::email('email', null, ['class' => 'form-control form-control-line', 'placeholder' => 'administrator@merlplus.com']) !!}</div>
</div>
<div class="form-group">
    <label class="col-md-12">Password</label>
    <div class="col-md-12">
        {!! Form::password('password', ['class' => 'form-control form-control-line', 'placeholder' => '*************']) !!}
    </div>
</div>
<div class="form-group">
    <label class="col-md-12">Phone No</label>
    <div class="col-md-12">
        {!! Form::text('mobile', null, ['class' => 'form-control form-control-line', 'placeholder' => '070375783']) !!}
    </div>
</div>
<div class="form-group">
    <label class="col-md-12">Message</label>
    <div class="col-md-12">
        {!! Form::textarea('name', null, ['class' => 'form-control form-control-line', 'placeholder' => 'Message']) !!}
    </div>
</div>
<div class="form-group">
    <label class="col-sm-12">Select Country</label>
    <div class="col-sm-12">
        <select class="form-control form-control-line">
            <option>London</option>
            <option>India</option>
            <option>Usa</option>
            <option>Canada</option>
            <option>Thailand</option>
        </select>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-12">
        <button class="btn btn-success">Update Profile</button>
    </div>
</div>