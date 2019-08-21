@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('register') }}">
                            {{ csrf_field() }}
                            @if(session()->has('socialite'))
                                <input id="provider" type="hidden" class="form-control" name="provider" value="{{session()->get('socialite')->user['provider'] }}">
                                <input id="provider_id" type="hidden" class="form-control" name="provider_id" value="{{session()->get('socialite')->id }}">
                            @endif
                            <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                                <label for="avatar" class="col-md-4 control-label"></label>
                                <div class="col-md-3">
                                    @if(session()->has('socialite'))
                                        <input id="userAvatar" type="hidden" name="avatar" value="{{ session()->get('socialite')->avatar}}">
                                        <input type="hidden" name="uploadedNewImage" :value="uploadedNewImage">
                                        <div class="card vue-avatar-cropper-demo text-center">
                                            <div class="card-body">
                                                <img :src="user.avatar" class="card-img avatar" alt="avatar"/>
                                                <div class="card-img-overlay">
                                                    <button class="btn btn-primary btn-sm" id="pick-avatar">Upload</button>
                                                </div>
                                            </div>
                                            <div class="card-footer text-muted" v-html="message"></div>
                                            <avatar-cropper v-on:uploading="handleUploading" v-on:uploaded="handleUploaded"
                                                            v-on:completed="handleCompleted" v-on:error="handlerError"
                                                            :upload-headers="{'X-Requested-With': 'XMLHttpRequest'}"
                                                            trigger="#pick-avatar"
                                                            :upload-form-data="{'_token':token,'userID':userID}"
                                                            upload-url="image-upload"
                                                            :labels="{ submit:'upload', cancel: 'cancel'}"/>
                                        </div>
                                    @else
                                        <div class="card vue-avatar-cropper-demo text-center">
                                            <div rounded="circle" class="card-body">
                                                <img alt="avatar" :src="user.avatar" class="card-img avatar"/>
                                                <div class="card-img-overlay">
                                                    <button class="btn btn-primary btn-sm" id="pick-avatar">Upload
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-footer text-muted" v-html="message"></div>
                                            <avatar-cropper
                                                    v-on:uploading="handleUploading"
                                                    v-on:uploaded="handleUploaded"
                                                    v-on:completed="handleCompleted"
                                                    v-on:error="handlerError"
                                                    trigger="#pick-avatar" :upload-form-data="{'_token':token}"
                                                    upload-url="image-upload"
                                                    :labels="{ submit:'upload', cancel: 'cancel'}"/>
                                        </div>

                                    @endif
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>
                                <div class="col-md-6">
                                    @if(session()->has('socialite'))
                                        <input id="name" type="text" class="form-control" name="name"
                                               value="{{ session()->get('socialite')->name}}" required
                                               autofocus>
                                    @else
                                        <input id="name" type="text" class="form-control" name="name"
                                               value="{{ old('name') }}" required
                                               autofocus>
                                    @endif
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <label for="username" class="col-md-4 control-label">Username</label>
                                <div class="col-md-6">
                                    @if(session()->has('socialite'))
                                        <input id="username" type="text" class="form-control" name="username" value="{{ session()->get('socialite')->name}}" required autofocus>
                                    @else
                                        <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>
                                    @endif
                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                                <div class="col-md-6">
                                    @if(session()->has('socialite'))
                                        <input id="email" type="email" class="form-control" name="email" value="{{ session()->get('socialite')->email }}" required>
                                    @else
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                    @endif
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation"
                                           required>
                                </div>
                            </div>


                            <div class="form-group {{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    @if ($errors->has('g-recaptcha-response'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                    @endif
                                    <vue-recaptcha sitekey="6Lfzr6kUAAAAAAOzhaUmgraAWWutOjAb4gx95XL3"></vue-recaptcha>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection