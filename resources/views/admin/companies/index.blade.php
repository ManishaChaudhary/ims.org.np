@extends('admin.layouts.app')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Company List</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Company List</li>
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
                               <span class="float-right"><a href="{{route('admin.companies.create')}}"
                                                            class="btn btn-primary btn-theme">Add Company</a></span>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Company Name</th>
                                        <th>Code</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($companies as $index => $company)
                                        <tr>
                                            <td>{{$company->name}}</td>
                                            <td>{{$company->code}}
                                            </td>
                                            <td>{{$company->phone}}</td>
                                            <td>{{$company->address}}</td>
                                            <td>{{$company->status== 1 ?'Active':'InActive'}}</td>
                                            <td>{{$company->created_at}}</td>
                                            <td>
                                                <a href="{{route('admin.companies.edit',$company)}}">
                                                    <button class="btn btn-purple darken-4 btn-sm m-0"><i
                                                                class="fa fa-edit "></i>
                                                        Edit
                                                    </button>
                                                </a>
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                   data-target="#deleteModal-{{$company->id}}">
                                                    <button type="submit" class="btn btn-delete"><i
                                                                class="fa fa-trash"></i>
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="deleteModal-{{$company->id}}" tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel"
                                             aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Ready to
                                                            Leave?</h5>
                                                        <button class="close" type="button" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">Are you sure you want to delete!!!</div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button"
                                                                data-dismiss="modal">Cancel
                                                        </button>
                                                        {{ Form::open(['url' => route('admin.companies.destroy',$company->id), 'method' => 'delete','class'=>'form-delete  pull-left']) }}
                                                        <button type="submit" class="btn btn-delete">
                                                            Delete
                                                        </button>
                                                        {{Form::close() }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Company Name</th>
                                        <th>Code</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Created At</th>
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