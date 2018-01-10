<!-- Added Amit on 21/07/2017 -->
<!-- Change Profile Page for Admin -->
@extends('layouts.admin_template')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Admin Profile</h1>
</section>
<!-- Main content -->
<section class="content">
	<!-- Small boxes (Stat box) -->
    <div class="box box-primary" data-ng-controller="ProfileController">
    	<div class="box-header with-border">
        	<h3 class="box-title">Edit Profile of Admin</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="" role="form" method="POST" action="{{ url('/admin/profile') }}" enctype="multipart/form-data">
			{{ csrf_field() }}
        	<div class="box-body">
            	<!-- Start .flash-message -->
                <div class="flash-message">
                	@foreach(['danger','warning','success','info'] as $msg)
                    	@if(Session::has('alert-'.$msg))
                			<p class="alert alert-{{ $msg }}">{{ Session::get('alert-'.$msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                      	@endif
                    @endforeach
                </div> 
                <!-- end .flash-message -->
              	<div class="row">
                	<div class="col-sm-3"></div>
					<div class="col-sm-6">
                		<div class="form-group {{ $errors->has('admin_avatar') ? ' has-error' : '' }}">
                  			<label for="profile_email" class="col-sm-1">Avatar:</label>
                            <div class="col-sm-6" data-ng-init="avatarimagesrc = '{{ asset('images/admin/'.$userData->admin_avatar) }}'">
                            	<img data-ng-src="@{{ avatarimagesrc }}" class="img-circle avatar_image" alt="avatar_image" height="150" width="150"/>
                                <div class="input-group" data-ng-show="!avatar_readonly">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                    <input type="file" class="form-control filecontrol" id="avatar" name="avatar" data-ng-model="avatar" accept="image/*" valid-file onchange="angular.element(this).scope().uploadedFile(this)">
                                </div>
                                <div id="avatar_error_block"></div>
                            </div>
                            <div class="col-sm-5">
                            	<button class="btn btn-default" id="avatar_update" type="button" data-ng-show="avatar_readonly" data-ng-click="makeEnableAvatar();"><i class="glyphicon glyphicon-pencil"></i> Update</button>
                                <button class="btn btn-success ng-cloak" id="avatar_save" type="button" data-ng-show="!avatar_readonly" data-ng-disabled="!avatar" data-ng-click="updateAvatar();"><i class="glyphicon glyphicon-floppy-disk"></i> Save</button>
                                <button class="btn btn-danger ng-cloak" id="avatar_cancel" type="button" data-ng-show="!avatar_readonly" data-ng-click="makeReadonlyAvatar();"><i class="glyphicon glyphicon-remove-circle"></i> Cancel</button>
                            </div>
                		</div>
                        
                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                  			<label for="profile_email" class="col-sm-1">Email:</label>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                    <input type="email" class="form-control" id="email" name="email" data-ng-readonly="email_readonly" data-ng-init="email = '{{ $userData->email }}'" data-ng-model="email">
                                </div>
                                @if($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                <div id="email_error_block"></div>
                            </div>
                            <div class="col-sm-5">
                            	<button class="btn btn-default" id="email_update" type="button" data-ng-show="email_readonly" data-ng-click="makeEnableEmail();"><i class="glyphicon glyphicon-pencil"></i> Update</button>
                                <button class="btn btn-success ng-cloak" id="email_save" type="button" data-ng-show="!email_readonly" data-ng-disabled="!email" data-ng-click="updateEmail();"><i class="glyphicon glyphicon-floppy-disk"></i> Save</button>
                                <button class="btn btn-danger ng-cloak" id="email_cancel" type="button" data-ng-show="!email_readonly" data-ng-click="makeReadonlyEmail();"><i class="glyphicon glyphicon-remove-circle"></i> Cancel</button>
                            </div>
                		</div>

                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                  			<label for="profile_name" class="col-sm-1">Name:</label>
                  			<div class="col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input type="text" class="form-control" id="name" name="name" data-ng-readonly="name_readonly" data-ng-init="name = '{{ $userData->name }}'" data-ng-model="name">
                                </div>
                                @if($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                                <div id="name_error_block"></div>
                            </div>
                            <div class="col-sm-5">
                            	<button class="btn btn-default" id="name_update" type="button" data-ng-show="name_readonly" data-ng-click="makeEnableName();"><i class="glyphicon glyphicon-pencil"></i> Update</button>
                                <button class="btn btn-success ng-cloak" id="name_save" type="button" data-ng-show="!name_readonly" data-ng-disabled="!name" data-ng-click="updateName();"><i class="glyphicon glyphicon-floppy-disk"></i> Save</button>
                                <button class="btn btn-danger ng-cloak" id="name_cancel" type="button" data-ng-show="!name_readonly" data-ng-click="makeReadonlyName();"><i class="glyphicon glyphicon-remove-circle"></i> Cancel</button>
                            </div>
                		</div>
                        
						<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                  			<label for="profile_name" class="col-sm-1">Password:</label>
                  			<div class="col-sm-6">
                                <div class="input-group" data-ng-show="password_readonly">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input type="password" class="form-control" id="defaultpassword" name="password" data-ng-readonly="password_readonly" value="********">
                                </div>
                                <div class="passwordfields ng-cloak" data-ng-show="!password_readonly">
                                	<div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input type="password" class="form-control" id="currentpass" name="currentpass" data-ng-model="currentpass" placeholder="Enter Current Password">
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input type="password" class="form-control" id="newpass" name="newpass" data-ng-model="newpass" placeholder="Enter New Password"> 
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input type="password" class="form-control" id="confirmpass" name="confirmpass" data-ng-model="confirmpass" placeholder="Confirm New Password">
                                    </div>
                                </div>	
                                @if($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                                <div id="password_error_block"></div>
                            </div>
                            <div class="col-sm-5">
                            	<button class="btn btn-default" id="password_update" type="button" data-ng-show="password_readonly" data-ng-click="makeEnablePassword();"><i class="glyphicon glyphicon-pencil"></i> Update</button>
                                <button class="btn btn-success ng-cloak" id="password_save" type="button" data-ng-show="!password_readonly" data-ng-disabled="!currentpass || !newpass || !confirmpass" data-ng-click="updatePassword();"><i class="glyphicon glyphicon-floppy-disk"></i> Save</button>
                                <button class="btn btn-danger ng-cloak" id="password_cancel" type="button" data-ng-show="!password_readonly" data-ng-click="makeReadonlyPassword();"><i class="glyphicon glyphicon-remove-circle"></i> Cancel</button>
                            </div>
                		</div>
                                                
                	</div>
                    <div class="col-sm-3"></div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer"></div>
        </form>
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
@endsection