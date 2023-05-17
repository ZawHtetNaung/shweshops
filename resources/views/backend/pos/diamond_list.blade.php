@extends('layouts.backend.datatable')
@section('content')
    <div class="wrapper">
        <!-- Navbar -->
    @include('layouts.backend.pos_nav')
    <!-- /.navbar -->

        <!-- Main Sidebar Container -->
    @include('layouts.backend.pos_sidebar')

    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper sn-background-light-blue">
            @if(Session::has('message'))

                <x-alert>

                </x-alert>
        @endif
        <!-- Content Header (Page header) -->
        <section class="content-header sn-content-header">
            <div class="container-fluid">
                @foreach($shopowner as $shopowner )
                @endforeach


            </div><!-- /.container-fluid -->
        </section>

        <section class="content-header">
            <div class="container-fluid">
                <div class="row d-flex">
                    <h5 class="col-md-10">Supplier List</h5>
                    <a class="btn btn-m btn-primary" href="#" data-toggle="modal" data-target="#createSupplier">
                        <i class="fa fa-plus mr-2"></i>Create Supplier</a>
                </div>
                <div class="card mt-2">
                    <div class="card-body">
                        <table class="table table-striped" id="example23">
                            <thead>
                                <th>No</th>
                                <th>Name</th>
                                <th>Shop</th>
                                <th>Code Number</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Remark</th>
                                <th>Action</th>
                            </thead>
                            <tbody class="text-center">
                                <?php $i=1;?>
                                @foreach ($diamonds as $diamond)
                                <tr>
                                 <td>{{$i++}}</td>
                                 <td>{{$diamond->name}}</td>
                                 <td>{{$diamond->shop_name}}</td>
                                 <td>{{$diamond->code_number}}</td>
                                 <td>{{$diamond->phone}}</td>
                                 <td>{{$diamond->address}}</td>
                                 <td>{{$diamond->remark}}</td   >

                                 <td>
                                    <a href="{{route('backside.shop_owner.pos.edit_supplier',$diamond->id)}}" class="btn btn-sm btn-warning"><i class="fa fa-pencil" ></i></a>
                                    <a href="#" class="btn btn-sm btn-danger" onclick="suredelete({{$diamond->id}})"><i class="fa fa-trash"></i></a>
                                 </td>

                                 {{-- edit modal --}}

                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- create modal --}}
                <!-- Modal -->
                <div class="modal fade" id="createSupplier" tabindex="-1" role="dialog" aria-labelledby="createSupplierLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="createSupplierLabel">Supplier Create Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <form method="POST" action="{{route('backside.shop_owner.pos.store_supplier')}}">
                            @csrf
                        <div class="modal-body">
                                <div class="form-group">
                                  <label for="code_number" class="col-form-label">Code Number:</label>
                                  <input type="text" name="code_number" class="form-control @error('code_number') is-invalid @enderror" id="code_number" required>

                                    @error('code_number')
                                        <span class="invalid-feedback alert alert-danger" role="alert"  height="100">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-form-label">Name:</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="shop_name" class="col-form-label">Shop Name:</label>
                                    <input type="text" class="form-control" name="shop_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="col-form-label">Phone:</label>
                                    <input type="number" class="form-control" name="phone" required>
                                </div>
                                <div class="form-group">
                                  <label for="address" class="col-form-label">Address:</label>
                                  <textarea class="form-control" name="address" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="remark" class="col-form-label">Remark:</label>
                                    <textarea class="form-control" name="remark"></textarea>
                                  </div>

                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                      </form>
                    </div>
                    </div>
                </div>

            </div>
        </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    {{-- @include('layouts.backend.footer') --}}


    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>

@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $('#example23').DataTable({

            "paging": true,
            "ordering": true,
            "info": true,

            });
        })
        function suredelete(id){
            // alert(id);
            swal({
                    title: "Are you sure?",
                    text: "This will be removed from supplier list",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'Yes',
                    cancelButtonText: "No",
                    closeOnConfirm: false,
                    closeOnCancel: false
            }).then(
            function(isConfirm) {
                // alert('ok');
                if(isConfirm){
                $.ajax({

                    type:'POST',

                    url: '{{route("backside.shop_owner.pos.delete_supplier")}}',

                    data:{
                    "_token":"{{csrf_token()}}",
                    "sid" : id,
                    },

                    success:function(data){
                        location.reload();
                    }
                })
            }
            });
        }
    </script>
@endpush
@push('css')
    <style>
        body {
            background: #F0F7FA;
            font-family: 'Myanmar3', Sans-Serif !important;
        }


    </style>
@endpush

