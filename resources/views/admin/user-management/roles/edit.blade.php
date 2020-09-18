@extends('admin.layouts.app')
@inject('permission_helper','App\Helpers\PermissionHelper')
@section('content')
    @php $permissions = $permission_helper->getPermissions() @endphp
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Roles</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit Roles</li>
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
                                <h3 class="card-title">Edit Roles</h3>
                            </div>
                            {{ Form::open(['url' => route('admin.roles.update',$model->id), 'method' => 'Put','enctype'=> 'multipart/form-data']) }}
                            <div class="card-body">
                                <div class="form-group">
                                    {{Form::label('Name')}}
                                    {{Form::text('name' , $model->name ?? old('name') , ['class' => 'form-control form-control-user' ,'placeholder'=>'Name' ,'required' => 'required'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('Guard Name')}}
                                    {{Form::text('guard_name' , $model->guard_name ?? old('guard_name') , ['class' => 'form-control form-control-user','placeholder'=>'Email' , 'required' => 'required'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('Permissions')}}<br>
                                    @forelse($permissions as $permission)
                                        {{Form::checkbox('permission_id')}} {{$permission->name}}
                                    @empty
                                        No Data
                                    @endforelse
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" name="submit" id="submit"
                                        class="btn btn-primary btn-sm pull-right">
                                    <i class="fa fa-save"></i> Update
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