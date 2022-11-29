@extends('admin.layouts.app')
@section('title')
Admin Profile
@endsection
@section('mainContent')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2><i class="fa fa-user"></i> Admin Profile</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <span class="label label-success float-right all_backgroud"><strong> Profile Update</strong></span>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-md-6">
            {!! Form::open(['route' => 'admin.updateProfileDetail','files' => true]) !!}
            <div class="ibox">
                <div class="ibox-content profile-content">
                    <div class="ibox">
                        <div class="form-group row {{ $errors->has('user_name') ? 'has-error' : '' }}">
                            <label class="col-lg-4 col-form-label">
                                <strong> User Name </strong>
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-8">
                                <input type="text" value="{{$user->user_name}}" id="user_name" name="user_name" class="form-control" autocomplete='off' placeholder="Enter User Name">
                                <span class="help-block">
                                    <font color="red"> {{ $errors->has('user_name') ? "".$errors->first('user_name')."" : '' }} </font>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('first_name') ? 'has-error' : '' }}">
                            <label class="col-lg-4 col-form-label">
                                <strong> First Name </strong>
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-8">
                                <input type="text" value="{{$user->first_name}}" id="first_name" name="first_name" class="form-control" autocomplete='off' placeholder="Enter First Name">
                                <span class="help-block">
                                    <font color="red"> {{ $errors->has('first_name') ? "".$errors->first('first_name')."" : '' }} </font>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('last_name') ? 'has-error' : '' }}">
                            <label class="col-lg-4 col-form-label">
                                <strong> Last Name </strong>
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-8">
                                <input type="text" value="{{$user->last_name}}" id="last_name" name="last_name" class="form-control" autocomplete='off' placeholder="Enter Last Name">
                                <span class="help-block">
                                    <font color="red"> {{ $errors->has('last_name') ? "".$errors->first('last_name')."" : '' }} </font>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label class="col-lg-4 col-form-label">
                                <strong> Email address </strong>
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-8">
                                <input type="text" placeholder="Enter Email"  value="{{$user->email}}" name="email" class="form-control" autocomplete='off'>
                                <span class="help-block">
                                    <font color="red"> {{ $errors->has('email') ? "".$errors->first('email')."" : '' }} </font>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-w-m btn btn-primary mr-10 mb-30">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="col-md-6">
            {!! Form::open(['route' => 'admin.updatePassword','files' => true]) !!}
            <div class="ibox">
                <div class="ibox-content">
                    <div class="form-group row {{ $errors->has('old_password') ? 'has-error' : '' }}">
                        <label class="col-lg-4 col-form-label">
                            <strong> Current Password </strong>
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-8">
                            <input type="password" name="old_password" id="old_password" placeholder="Current Password" class="form-control" value="{{ old('old_password') }}" autocomplete='off'>
                            <span class="help-blockk">
                                <font color="red"> {{ $errors->has('old_password') ? "".$errors->first('old_password')."" : '' }} </font>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label class="col-lg-4 col-form-label">
                            <strong> New Password </strong>
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-8">
                            <input type="password" name="password" id="password" placeholder="New Password"  class="form-control" autocomplete='off'>
                            <span class="help-blockk">
                                <font color="red"> {{ $errors->has('password') ? "".$errors->first('password')."" : '' }} </font>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                        <label class="col-lg-4 col-form-label">
                            <strong> Confirm Password </strong>
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-8">
                            <input type="password"  name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" class="form-control" autocomplete='off'>
                            <span class="help-blockk">
                                <font color="red"> {{ $errors->has('password_confirmation') ? "".$errors->first('password_confirmation')."" : '' }} </font>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button type="submit" class="btn btn-w-m btn btn-primary mr-10 mb-30">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
@section('styles')
@endsection
@section('scripts')
@endsection