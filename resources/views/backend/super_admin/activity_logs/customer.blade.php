@extends('layouts.backend.super_admin.datatable')
@section('content')
    <style>
        .title {
            cursor: pointer;
        }

        .edit-section {
            display: none;
            cursor: pointer;
        }
    </style>
    <div class="wrapper">
        <!-- Navbar -->
    @include('backend.super_admin.navbar')
    <!-- /.navbar -->
        <!-- Main Sidebar Container -->
    @include('backend.super_admin.sidebar')

    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <x-alert></x-alert>

            <!-- Content Header (Page header) -->
        {{-- <section class="content-header">
            <x-title>All Customer</x-title>
        </section> --}}

        <!-- Main content -->
            <section class="content pt-3">
                {{-- <div class="sn-tab-panel">
                    <ul>
                    <a href="{{route('activity.customer')}}" class="active-panel"><li>User Activities</li></a>
                    <a href="{{route('activity.ads')}}"><li>Ads Activities</li></a>
                    <a href="{{route('activity.shop')}}"><li>Shop Activities</li></a>
                    <a href="{{route('activity.admin')}}"><li>Admin Activities</li></a>

                  </ul>
                </div> --}}

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">


                            <div class="sn-table-list-wrapper">

                                <!-- /.card-header -->
                                <div class="card shadow-none border-0 rounded-5 pb-2 mt-5">
                                    <div class="card-header">
                                        <div class="">
                                            <h2>User Lists</h2>
                                            <p>Check your Customers</p>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end my-3 align-items-center">
                                        <div class="form-group mr-md-2">
                                            <fieldset>
                                                <legend>From Date</legend>
                                                <input type="text" id='search_fromdate_cusAct'
                                                       class="cusActdatepicker form-control" placeholder='Choose date'
                                                       autocomplete="off"/>
                                            </fieldset>
                                        </div>
                                        <div class="form-group mr-md-2">
                                            <fieldset>
                                                <legend>To Date</legend>
                                                <input type="text" id='search_todate_cusAct'
                                                       class="cusActdatepicker form-control" placeholder='Choose date'
                                                       autocomplete="off"/>
                                            </fieldset>
                                        </div>
                                        <div class="pr-md-4">
                                            <input type='button' id="cusAct_search_button" value="Search"
                                                   class="btn bg-info">
                                        </div>
                                    </div>

                                    <table id="superAdminTable" class="table table-borderless">
                                        <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Product Code</th>
                                            <th>Product Name</th>
                                            <th>User Id</th>
                                            <th>User Name</th>
                                            <th>Date</th>
                                        </tr>
                                        </thead>

                                        <tfoot>
                                        <tr>
                                            <th>id</th>
                                            <th>Product Code</th>
                                            <th>Product Name</th>
                                            <th>User Id</th>
                                            <th>User Name</th>
                                            <th>Date</th>
                                        </tr>
                                        </tfoot>
                                    </table>

                                </div>
                                <!-- /.card-body -->
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
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
@endsection
@push("scripts")
    <script>

        $(document).ready(function () {
            var customersActivityTable = $('#superAdminTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    'url': "{{ route('customers.getCustomerActivity') }}",
                    'data': function (data) {
                        // Read values
                        var from_date = $('#search_fromdate_cusAct').val() ? $('#search_fromdate_cusAct').val() + " 00:00:00" : null;
                        var to_date = $('#search_todate_cusAct').val() ? $('#search_todate_cusAct').val() + " 23:59:59" : null;

                        // Append to data
                        data.searchByFromdate = from_date;
                        data.searchByTodate = to_date;
                    }
                },

                columns: [
                    {data: 'id'},
                    {data: 'item_code'},
                    {data: 'name'},
                    {data: 'user_id'},
                    {data: 'user_name'},
                    {data: 'created_at'}

                ],

                responsive: true,
                lengthChange: true,
                autoWidth: false,
                paging: true,
                dom: 'Blfrtip',
                buttons: ["copy", "csv", "excel", "pdf", "print"],
                columnDefs: [
                    {responsivePriority: 1, targets: 1},
                    {responsivePriority: 2, targets: 2},
                    {responsivePriority: 3, targets: 3},
                    {responsivePriority: 4, targets: 4},
                ],
                language: {
                    "search": '<i class="fa fa-search"></i>',
                    "searchPlaceholder": 'Search',
                    paginate: {
                        next: '<i class="fa fa-angle-right"></i>', // or '→'
                        previous: '<i class="fa fa-angle-left"></i>' // or '←'
                    }
                },

                "order": [[5, "desc"]],
            });

            $(".customerdatepicker").datepicker({
                "dateFormat": "yy-mm-dd",
                changeYear: true
            });

            $('#customer_search_button').click(function () {
                if ($('#search_fromdate_customer').val() != null && $('#search_todate_customer').val() != null) {
                    customersActivityTable.draw();
                }
            });
            $(".cusActdatepicker").datepicker({
                "dateFormat": "yy-mm-dd",
                changeYear: true
            });

            $('#cusAct_search_button').click(function () {
                if ($('#search_fromdate_cusAct').val() != null && $('#search_todate_cusAct').val() != null) {
                    customersActivityTable.draw();
                }
            });
        });

    </script>
@endpush
@push('css')
    <style>

        .sn-tab-panel ul li {
            width: 100% !important;
            background: transparent !important;
            padding: 6px;
        }
    </style>
@endpush
