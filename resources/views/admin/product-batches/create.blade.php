@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Product Batches</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Product Batches Form</li>
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
                                <h3 class="card-title">Add Product Batches</h3>
                            </div>
                            {{ Form::open(['url' =>route('admin.product-batches.store'), 'method' => 'POST','enctype'=> 'multipart/form-data']) }}
                                <div class="card-body">
                                    <div class="form-group">
                                        {{Form::label('sub category')}}
                                        {{Form::select('category_id',$categories , null , ['class' => 'form-control form-control-user' ])}}
                                    </div>
                                    <div class="form-group">
                                        {{Form::label('name')}}
                                        {{Form::text('name' , null , ['class' => 'form-control form-control-user' ,'placeholder'=>'name' ,'required' => 'required'])}}
                                    </div>
                                    <div class="form-group">
                                        {{Form::label('quantity')}}
                                        {{Form::text('quantity' , null , ['class' => 'form-control form-control-user','placeholder'=>'2572.00 sqft','required' => 'required' ])}}
                                    </div>
                                    <div class="form-group">
                                        {{Form::label('alt. quantity')}}
                                        {{Form::text('alt_qty' , null , ['class' => 'form-control form-control-user','placeholder'=>'214 Pcs','required' => 'required' ])}}
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