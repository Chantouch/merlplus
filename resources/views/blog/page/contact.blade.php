<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 10/3/2017
 * Time: 8:27 AM
 */
?>
@extends('layouts.blog.app')
@section('contact-map')
    <div class="contact-maps float-width">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12679.021280862107!2d-121.89079389021241!3d37.39561832456384!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fcea7e190e829%3A0xf812f1635c1b7ec5!2sSilicon+Valley+University!5e0!3m2!1sen!2s!4v1393959144037"
                width="100%" height="350" frameborder="0" style="border:0"></iframe>
    </div>
@stop
@section('content')
    <div class="news-sec-1 float-width">
        <!-- Website Contact us page Info -->
        <div class="float-width sec-cont">
            <div class="sec-1-big float-width">
                @if(Session::has('message'))
                    <div class="alert alert-info">
                        {{Session::get('message')}}
                    </div>
                @endif

                <div class="contact-form float-width">
                    <h3 class="sec-title">LEAVE A message</h3>
                    {!! Form::open(array('route' => 'blog.contact.store', 'class' => 'form')) !!}
                    <div class="alert" id="formmsg" style="display:none;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            <i class="fa fa-times"></i>
                        </button>
                        <span class="error"></span>
                    </div>
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        {!! Form::text('name', null, array('class'=>'form-control','placeholder'=>'Your name')) !!}
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        {!! Form::text('email', null, array('class'=>'form-control', 'placeholder'=>'Your e-mail address')) !!}
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                        {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Your phone number']) !!}
                        @if ($errors->has('phone'))
                            <span class="help-block">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group magalla-slctr{{ $errors->has('subject') ? ' has-error' : '' }}">
                        {!! Form::select('subject', ['Some other subject 1' => 'Some other subject 1', 'Some other subject 2' => 'Some other subject 2'], null, ['class' => 'form-control']) !!}
                        @if ($errors->has('subject'))
                            <span class="help-block">
                                <strong>{{ $errors->first('subject') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                        {!! Form::textarea('message', null, array('class'=>'form-control', 'placeholder'=>'Your message')) !!}
                        @if ($errors->has('message'))
                            <span class="help-block">
                                <strong>{{ $errors->first('message') }}</strong>
                            </span>
                        @endif
                    </div>
                    <button class="cmnt-btn trans2">SUBMIT YOUR MESSAGE</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop
