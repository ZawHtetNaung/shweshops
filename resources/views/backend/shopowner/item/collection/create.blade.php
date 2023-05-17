@extends('layouts.backend.backend')


@section('content')

    <div class="wrapper">
        <!-- Navbar -->
    @include('layouts.backend.navbar')
    <!-- /.navbar -->

        <!-- Main Sidebar Container -->
    @include('layouts.backend.sidebar')

    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- zhheader shopname -->
            <x-header>
            @foreach($shopowner as $shopowner )
                    @endforeach
                    {{$shopowner->shop_name}}
            </x-header>
            <!-- end zh header shopname -->

            <!-- Content Header (Page header) -->
            <x-title>
                Collection Create
            </x-title>
        @csrf
        <!-- Main content -->

            <section class="content">
                <form method="post" action="{{url('backside/shop_owner/collection/create')}}">
                <div class="container-fluid">
                    <!-- SELECT2 EXAMPLE -->
                    <div class="card card-default">
                        @csrf

                        <div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label>Collection Name </label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                                   placeholder="Enter name" required/>
                                        </div>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                    <div class="col-md-6">
                                        <label class="d-none d-sm-block">&nbsp </label>

                                            <button class="btn btn-primary float-right float-sm-none" type="submit" ><span
                                                    class="fa fa-paper-plane"></span>&nbsp;&nbsp;Submit form
                                            </button>
                                    </div>
                                    <!--                            <Ykweight v-on:forparent="getdatafromykweight"></Ykweight>-->


                                </div>


                                <br/>

                            </div>
                            <!-- /.FORM END -->


                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                </form>
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


