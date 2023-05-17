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

            <x-title>
Add Items to {{$col->name}} Collection
            </x-title>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">


                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"><a href="{{url('/backside/shop_owner/collection/detail/'.$col->id)}}" type="button" class="btn btn-block bg-gradient-primary"><span class="fa fa-arrow-circle-left"></span> Back To {{$col->name}}</a></h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
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
                                                <td>{{$item->id}}</td>
                                                <td>{{$item->product_code}}</td>
                                                <td><img style="width:122px;height:122px;" src="{{url($item->check_photo)}}"/></td>
                                                <td>{{$item->short_price}} Ks</td>
                                                <td>
                                                    <form method="post" action="{{url('backside/shop_owner/collection/add/list/'.$col->id)}}">
                                                        @csrf
                                                        <input type="hidden" name="item_id" value="{{$item->id}}"/>
                                                        <input type="hidden" name="col_id" value="{{$col->id}}"/>

                                                        <button type="submit" class="btn btn-md btn-primary"><span class="fa fa-plus-circle"></span> Add</button>
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
