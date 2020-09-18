@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Challan In</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Challan In Form</li>
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
                                <h3 class="card-title">Edit Challan In</h3>
                            </div>
                            {{ Form::open(['url' => route('admin.challans.update',$model->id), 'method' => 'POST','enctype'=> 'multipart/form-data']) }}
                            <div class="card-body">
                                <div class="form-group">
                                    {{Form::label('Party')}}
                                    {{Form::text('party' , $model->party , ['class' => 'form-control form-control-user' ,'placeholder'=>'Party Name' ,'required' => 'required'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('Entry Date')}}
                                    {{Form::date('in_date' , $model->in_date , ['class' => 'form-control form-control-user' ,'placeholder'=>'Entry Date' ,'required' => 'required'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('Vehicle Number')}}
                                    {{Form::text('vehicle_no' , $model->vehicle_no , ['class' => 'form-control form-control-user' ,'placeholder'=>'Vehicle No' ,'required' => 'required'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('Company')}}
                                    <select name="company_id" id="company_id" class="form-control company"
                                            required="required"
                                            style="background-color:#fff;">
                                        <option value="0">Select</option>
                                        @foreach($companies as $company)
                                            <option value="{{$company->id}}"{{(isset($model) && $model->company_id == $company->id)? 'selected' : '' }}>{{$company->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    {{Form::label('Godown')}}
                                    {{ Form::select('godown_id',['Select Godown']+$godown->toArray(),$model->godown_id,['class'=>'form-control']) }}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Category</th>
                                                <th>Sub Category</th>
                                                <th>Product Batches</th>
                                                <th>Quantity</th>
                                                <th>Alt Quantity</th>
                                                <th class="text-center"><a href="#" class="btn btn-primary addRow"><i
                                                                class="fa fa-plus" aria-hidden="true"></i></a></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>{{Form::select('product_id[]',['Select']+$products->toArray() , null , ['class' => 'form-control form-control-user product_id'])}}</td>
                                                <td>{{Form::select('category_id[]',['Select']+$categories->toArray() , null , ['class' => 'form-control form-control-user category_id'])}}</td>
                                                <td>{{ Form::select('subcategory_id[]',['Select']+$subcategories->toArray(),null,['class' =>'form-control subcategory_id']) }}</td>
                                                <td>{{Form::select('product_batch_id[]',['select']+$productBatches->toArray() , null , ['class' => 'form-control form-control-user product_batch_id'])}}</td>
                                                <td><input type="text" name="quantity[]" placeholder="200sqft"
                                                           class="quantity"></td>
                                                <td>
                                                    <input type="text" name="alt_quantity[]" placeholder="200sqft"
                                                           class="alt_quantity">
                                                </td>
                                                <td class="text-center"><a href="#" class="btn btn-danger">x</a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card-text">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th>Product Batches</th>
                                        <th>Quantity</th>
                                        <th>Alt Quantity</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($challaniProducts as $challaniProduct)
                                        <tr>
                                            <td>{{$challaniProduct->products?$challaniProduct->products->name:''}}</td>
                                            <td>{{$challaniProduct->category?$challaniProduct->category->title:''}}</td>
                                            <td>{{$challaniProduct->subCategory?$challaniProduct->subCategory->title:''}}</td>
                                            <td>{{$challaniProduct->productBatch?$challaniProduct->productBatch->name:''}}</td>
                                            <td>{{$challaniProduct->quantity}}</td>
                                            <td>{{$challaniProduct->alt_quantity}}</td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
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
@section('js')
    {{--<script type="text/javascript">--}}
        {{--$(document).ready(function () {--}}
            {{--$('.company').on('change', function () {--}}
                {{--var companyID = $(this).val();--}}
                {{--if (companyID) {--}}
                    {{--$.ajax({--}}
                        {{--url: '/admin/company-godown/' + companyID,--}}
                        {{--type: "GET",--}}
                        {{--dataType: "json",--}}
                        {{--success: function (data) {--}}
                            {{--$('.godown').empty();--}}
                            {{--$.each(data, function (key, value) {--}}
                                {{--$('.godown').append('<option value="' + key + '">' + value['title'] + '</option>');--}}
                            {{--});--}}
                        {{--}--}}
                    {{--});--}}
                {{--} else {--}}
                    {{--$('.godown').empty();--}}
                {{--}--}}
            {{--});--}}
        {{--});--}}
    {{--</script>--}}

    <script type="text/javascript">
        $(document).ready(function () {
            var x = 1;
            $('.addRow').on('click', function () {
                addRow();
            });
            function addRow() {
                var tr ='<tr>' +
                    '<td>{{Form::select('product_id[]',['Select']+$products->toArray() , null , ['class' => 'form-control form-control-user product_id'])}}</td>' +
                    '<td>{{Form::select('category_id[]',['Select']+$categories->toArray() , null , ['class' => 'form-control form-control-user category_id'])}}</td>' +
                    '<td>{{ Form::select('subcategory_id[]',['Select']+$subcategories->toArray(),null,['class' =>'form-control subcategory_id']) }}</td>' +
                    '<td>{{Form::select('product_batch_id[]',['select']+$productBatches->toArray() , null , ['class' => 'form-control form-control-user product_batch_id'])}}</td>' +
                    '<td><input type="text" name="quantity[]" placeholder="200sqft" class="quantity"></td>' +
                    '<td><input type="text" name="alt_quantity[]" placeholder="200sqft"  class="alt_quantity"></td>' +
                    '<td class="text-center"><a href="#" class="btn btn-danger remove">x</a></td>' +
                    '</tr>';

                $('tbody').append(tr);
            }

            $('tbody').on('click', '.remove', function () {
                $(this).closest('tr').remove();
                x--;
            });
        });
    </script>

@endsection