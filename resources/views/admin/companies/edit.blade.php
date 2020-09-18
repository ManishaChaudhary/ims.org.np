@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Company</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Company Edit Form</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Company</h3>
                            </div>
                            {{ Form::open(['route' => ['admin.companies.update',$model] ,'method' => 'Put','enctype'=> 'multipart/form-data']) }}
                                <div class="card-body">
                                    <div class="form-group">
                                        {{Form::label('Company Name')}}
                                        {{Form::text('name' , $model->name , ['class' => 'form-control form-control-user' ,'placeholder'=>'Title' ,'required' => 'required'])}}
                                    </div>
                                    <div class="form-group">
                                        {{Form::label('Company Code')}}
                                        {{Form::text('code' , $model->code , ['class' => 'form-control form-control-user','placeholder'=>'Code' , 'required' => 'required'])}}
                                    </div>
                                    <div class="form-group">
                                        {{Form::label('Phone')}}
                                        {{Form::number('phone' , $model->phone, ['class' => 'form-control form-control-user' ,'placeholder'=>'Phone', 'required' => 'required'])}}
                                    </div>
                                    <div class="form-group">
                                        {{Form::label('Address')}}
                                        {{Form::text('address' , $model->address , ['class' => 'form-control form-control-user' ,'placeholder'=>'Address', 'required' => 'required' ])}}
                                    </div>
                                    <div class="form-group">
                                        {{Form::label('Status')}}
                                        {{Form::select('status' ,['InActive','Active'], $model->status , ['class' => 'form-control form-control-user' ])}}
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