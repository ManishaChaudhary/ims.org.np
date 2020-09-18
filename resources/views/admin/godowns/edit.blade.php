@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Godown</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Godown Edit Form</li>
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
                                <h3 class="card-title">Add Edit</h3>
                            </div>
                            {{ Form::open(['url' => route('admin.godowns.update',$godown->id) , 'method' => 'PUT','enctype'=> 'multipart/form-data']) }}
                                <div class="card-body">
                                    <div class="form-group">
                                        {{Form::label('Name')}}
                                        {{Form::text('title' , $godown->title ?? old('title') , ['class' => 'form-control form-control-user' ,'placeholder'=>'ABC Godown' ,'required' => 'required'])}}
                                    </div>
                                    <div class="form-group">
                                        {{Form::label('Godown Code')}}
                                        {{Form::text('code' , $godown->code ?? old('code') , ['class' => 'form-control form-control-user','placeholder'=>'ABC234' , 'required' => 'required'])}}
                                    </div>
                                    <div class="form-group">
                                        {{Form::label('Company')}}
                                        <select name="company_id" id="group_id" class="form-control"
                                                required="required"
                                                style="background-color:#fff;">
                                            <option value="0">Select</option>
                                            @foreach($companies as $company)
                                                <option value="{{$company->id}}"{{(isset($godown) && $godown->company_id == $company->id)? 'selected' : '' }}>{{$company->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        {{Form::label('Address')}}
                                        {{Form::text('address' , $godown->address ?? old('address') , ['class' => 'form-control form-control-user' ,'placeholder'=>'Address', 'required' => 'required' ])}}
                                    </div>
                                    <div class="form-group">
                                        {{Form::label('Status')}}
                                        {{Form::select('status' ,['InActive','Active'], $godown->status , ['class' => 'form-control form-control-user', 'required' => 'required' ])}}
                                    </div>
                                    <div class="form-group">
                                        {{Form::label('description')}}
                                        {{Form::textarea('description' , $godown->description ?? old('description'),['class' => 'form-control form-control-user'])}}
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