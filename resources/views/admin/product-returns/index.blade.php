@extends('admin.layouts.app')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Product Return List</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Product Return List</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                               <span class="float-right"><a href="{{route('admin.product-returns.create')}}"
                                                            class="btn btn-primary btn-theme">Add Product Return</a></span>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Party</th>
                                        <th>Return Date</th>
                                        <th>Vehicle Number</th>
                                        <th>Company</th>
                                        <th>Product Batch</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($productReturns as $productReturn)
                                        <tr>
                                            <td>{{ $productReturn->party}}</td>
                                            <td>{{ $productReturn->in_date }}</td>
                                            <td>{{ $productReturn->vehicle_no }}</td>
                                            <td>{{ $productReturn->company?$productReturn->company->name :''}}</td>
                                            <td>{{ $productReturn->productBatch?$productReturn->productBatch->name:'' }}</td>
                                            <td>
                                                <a href="{{route('admin.product-returns.edit',$productReturn->id)}}">
                                                    <button class="btn btn-purple darken-4 btn-sm m-0"><i
                                                                class="fa fa-edit "></i>
                                                        Edit
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Party</th>
                                        <th>Return Date</th>
                                        <th>Vehicle Number</th>
                                        <th>Company</th>
                                        <th>Product Batch</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('js')
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection