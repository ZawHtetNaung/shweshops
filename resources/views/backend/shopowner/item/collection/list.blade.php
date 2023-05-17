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
                Collection list
            </x-title>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">


                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">DataTable with default features</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Include Items</th>
                                            <th>Action</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $i=1; @endphp
                                        @foreach($collection as $col)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$col->name}}</td>
                                                <th>
                                                    <?php
                                                    $items=\Illuminate\Support\Facades\DB::table('items')->where('collection_id',$col->id)->get();
                                                    ?>
                                                    {{count($items)}} Items Include
                                                </th>

                                                <td><a class="btn btn-sm btn-success" href="{{url('/backside/shop_owner/collection/detail/'.$col->id)}}"><span class="fa fa-info-circle"></span></a>  </td>

                                            </tr>
                                        @endforeach

                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Include Items</th>

                                            <th>Action</th>


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
        <!-- /.content-wrapper -->
    @include('layouts.backend.footer')

    <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
@endsection
