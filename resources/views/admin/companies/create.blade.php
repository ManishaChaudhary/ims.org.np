@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Company</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Company Form</li>
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
                                <h3 class="card-title">Add Company</h3>
                            </div>
                            {{ Form::open(['route' => 'admin.companies.store' ,'method' => 'POST','enctype'=> 'multipart/form-data']) }}
                                <div class="card-body">
                                    <div class="form-group">
                                        {{Form::label('Company Name')}}
                                        {{Form::text('name' , null , ['class' => 'form-control form-control-user' ,'placeholder'=>'ABC Pvt.Ltd' ,'required' => 'required'])}}
                                    </div>
                                    <div class="form-group">
                                        {{Form::label('Company Code')}}
                                        {{Form::text('code' , null , ['class' => 'form-control form-control-user','placeholder'=>'Code' , 'required' => 'required'])}}
                                    </div>
                                    <div class="form-group">
                                        {{Form::label('Phone')}}
                                        {{Form::number('phone' , null, ['class' => 'form-control form-control-user' ,'placeholder'=>'Phone', 'required' => 'required'])}}
                                    </div>
                                    <div class="form-group">
                                        {{Form::label('Address')}}
                                        {{Form::text('address' , null , ['class' => 'form-control form-control-user' ,'placeholder'=>'Address', 'required' => 'required' ])}}
                                    </div>
                                    <div class="form-group">
                                        {{Form::label('Status')}}
                                        {{Form::select('status' ,['InActive','Active'], null , ['class' => 'form-control form-control-user', 'required' => 'required' ])}}
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