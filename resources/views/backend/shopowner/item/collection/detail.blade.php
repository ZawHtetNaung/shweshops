@extends('layouts.backend.datatable')


@section('content')


    <div class="wrapper">

    @include('layouts.backend.navbar')


    <!-- Main Sidebar Container -->
    @include('layouts.backend.sidebar')


    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @if(Session::has('message'))

                <x-alert>

                </x-alert>
            @endif

             <!-- zhheader shopname -->
             <x-header>
            @foreach($shopowner as $shopowner )
                    @endforeach
                    {{$shopowner->shop_name}}
            </x-header>
            <!-- end zh header shopname -->
            
            <x-title>
                Items list in {{$col->name}} Collection
            </x-title>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">


                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><a href="{{url('/backside/shop_owner/collection/add/list/'.$col->id)}}" type="button" class="btn btn-block bg-gradient-primary"><span class="fa fa-plus-circle"></span> Add Items</a></h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    @if(count($col_items) != 0)
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Product Code</th>
                                            <th>IMAGE</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $i=1; @endphp
                                        @foreach($col_items as $item)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$item->product_code}}</td>
                                                <td><img style="width:122px;height:122px;" src="{{url($item->check_photo)}}"/></td>
                                                <td>{{$item->short_price}} Ks</td>
                                                <td> <button type="button" onclick="Delete()" class="btn btn-block bg-gradient-danger btn-sm">Remove</button>
                                                    <form id="delete_form"
                                                          action="{{ url('backside/shop_owner/collection/remove_item') }}"
                                                          method="post"
                                                          style="display: none;">
                                                        @csrf

                                                        <input type="hidden" name="item_id" value="{{$item->id}}"/>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Product Code</th>
                                            <th>IMAGE</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                    @endif
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    @include('layouts.backend.footer')

    <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
@endsection
@push('scripts')
    <script>
        function Delete() {
            $(function () {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-danger ml-2',
                        cancelButton: 'btn btn-info'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "Want to remove this item from collection",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Do it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete_form').submit();
                    }
                })
            });
        }
    </script>
@endpush
