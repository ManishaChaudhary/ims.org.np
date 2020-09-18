@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Change Password</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Profile Update Form</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Change Password</h3>
                            </div>
                            {{ Form::open(['url' =>route('admin.update_profile'), 'method' => 'POST','enctype'=> 'multipart/form-data']) }}
                            <div class="card-body">
                                <div class="form-group">
                                    {{Form::label('name')}}
                                    <input type="text" name="name" class="form-control" value="{{$user->name}}" required/>
                                </div>
                                <div class="form-group">
                                    {{Form::label('Email')}}
                                    <input type="email" name="email" class="form-control" value="{{$user->email}}"/>
                                </div>
                                <div class="form-group">
                                    <label for="curr_password">Current Password <i class="reqr">*</i> <i class="fa fa-info-circle" title="Need to Save Profile"></i></label>
                                    <input type="password" name="curr_password" class="form-control" required/>
                                </div>
                                <div class="form-group">
                                    <label for="password">New Password <i id="n_pw" class="reqr">*</i></label>
                                    <input type="password" name="password" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password">Confirm Password <i id="c_pw" class="reqr">*</i></label>
                                    <input type="password" name="confirm_password" class="form-control"/>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" name="submit" id="submit"
                                        class="btn btn-primary btn-sm pull-right">
                                    <i class="fa fa-save"></i> Save
                                </button>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
