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
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3909.4696385396746!2d104.9309791323575!3d11.518130327955129!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTHCsDMxJzA1LjUiTiAxMDTCsDU1JzU0LjciRQ!5e0!3m2!1sen!2s!4v1509290239822" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
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
                        {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Your phone number here']) !!}
                        @if ($errors->has('phone'))
                            <span class="help-block">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group magalla-slctr{{ $errors->has('subject') ? ' has-error' : '' }}">
                        {!! Form::text('subject', null, ['class' => 'form-control', 'placeholder' => 'Your subject here']) !!}
                        @if ($errors->has('subject'))
                            <span class="help-block">
                                <strong>{{ $errors->first('subject') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                        {!! Form::textarea('message', null, array('class'=>'form-control', 'placeholder'=>'Your message here')) !!}
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
