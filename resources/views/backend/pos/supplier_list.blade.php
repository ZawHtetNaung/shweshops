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
                <div class="row d-flex mb-3">
                    <h4 class="text-color">ပန်းထိမ်ကုန်သည်စာရင်းများ</h4>
                    <a class="btn btn-m btn-color ml-3" href="{{route('backside.shop_owner.pos.create_supplier')}}">
                    <i class="fa fa-plus mr-2"></i>Create</a>
                    <div class="dropdown ml-5">
                        <a class="btn btn-m btn-color dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-filter"></i></a>
                        <ul class="dropdown-menu px-1">
                        <li><label><input type="checkbox" id="gold" > ​ရွှေထည်</label></li>
                        <li><label><input type="checkbox" id="kyout"> ​ကျောက်မျက်ရတနာ</label></li>
                        <li><label><input type="checkbox" id="diamond"> စိန်ထည်</label></li>
                        <li><label><input type="checkbox" id="platinum"> ပလက်တီနမ်</label></li>
                        <li><hr class="dropdown-divider"/></li>
                        <li><a href="#" class="btn btn-color btn-sm" style="margin-left: 50px;" onclick="typefilter(1)">Save</a></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <label for="">From:<input type="date" id="start_date"></label>
                    <label for="" class="ml-3">To:<input type="date" id="end_date"></label>
                    <label for="" style="margin-left: 20px;margin-top:30px;"><a href="#" class="btn btn-color btn-m" onclick="typefilter(2)">Search</a></label>
                </div>
                <div class="card mt-2">
                    <div class="card-body">
                        <table class="table table-striped" id="example23">
                            <thead>
                                <th>နံပါတ်</th>
                                <th>ဆိုင်အမည်</th>
                                <th>ဆိုင်အမျိုးအစား</th>
                                <th>ကုဒ်နံပါတ်</th>
                                <th>ပန်းထိမ်ဆရာအမည်</th>
                                <th>ဖုန်းနံပါတ်</th>
                                <th>တခြားဖုန်းနံပါတ်</th>
                                <th>နေ့စွဲ</th>
                                <th></th>
                            </thead>
                            <tbody class="text-center" id="filter">
                                <?php $i=1;?>
                                @foreach ($suppliers as $supplier)
                                <tr>
                                 <td>{{$i++}}</td>
                                 <td>{{$supplier->shop_name}}</td>
                                 <td>{{$supplier->shop_type}}</td>
                                 <td>{{$supplier->code_number}}</td>
                                 <td>{{$supplier->name}}</td>
                                 <td>{{$supplier->phone}}</td>
                                 <td>{{$supplier->other_phone}}</td >
                                <td>{{$supplier->date}}</td>
                                 <td>
                                    <div class="d-flex">
                                        <a href="#myModal{{$supplier->id}}" class="text-danger" data-toggle="modal"><i class="fa fa-trash"></i></a>
                                        <a href="{{route('backside.shop_owner.pos.edit_supplier',$supplier->id)}}" class="ml-4 text-warning"><i class="fa fa-pencil" ></i></a>
                                        <a href="#" class="ml-4 text-success"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </div>
                                 </td>

                                 <div id="myModal{{$supplier->id}}" class="modal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete List</h5>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="text-center">Are you Sure to Delete this List?</p>
                                            </div>
                                            <div class="modal-footer text-center">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCLE</button>
                                                <button type="button" class="btn btn-color" onclick="suredelete({{$supplier->id}})">DELETE</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                </tr>
                                @endforeach

                            </tbody>
                        </table>
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
@push('css')
<style>
    .btn-color{
        background-color: #780116;
        color: white;
    }
    .text-color{
        color: #780116;
    }
</style>
@endpush
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            function alignModal(){
        var modalDialog = $(this).find(".modal-dialog");

        // Applying the top margin on modal to align it vertically center
        modalDialog.css("margin-top", Math.max(0, ($(window).height() - modalDialog.height()) / 2));
        }
        // Align modal when it is displayed
        $(".modal").on("shown.bs.modal", alignModal);

        // Align modal when user resize the window
        $(window).on("resize", function(){
            $(".modal:visible").each(alignModal);
        });
            $('#example23').DataTable({

            "paging": true,
            "ordering": true,
            "info": true,

            });
            $('#example-getting-started').multiselect();
        });
        function suredelete(id){
                // alert('ok');
                $.ajax({

                    type:'POST',

                    url: '{{route("backside.shop_owner.pos.delete_supplier")}}',

                    data:{
                    "_token":"{{csrf_token()}}",
                    "sid" : id,
                    },

                    success:function(data){
                        location.reload();
                        // console.log('success');
                    }
                })
        }

        function typefilter(val){
            var html = '';
            if($("#gold").is(":checked") == true){
                html += 'option1'
            }
            if($("#kyout").is(":checked") == true){
                html += '/option2'
            }
            if($("#diamond").is(":checked") == true){
                html += '/option3'
            }
            if($("#platinum").is(":checked") == true){
                html += '/option4'
            }
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();

            $.ajax({

            type:'POST',

            url: '{{route("backside.shop_owner.pos.type_filter")}}',

            data:{
            "_token":"{{csrf_token()}}",
            "text" : html,
            "start_date" : start_date,
            "end_date" : end_date,
            "type" : val,
            },

            success:function(data){
                var html1 = '';
                $.each(data, function(i, v) {
                    var url1 = '{{ route('backside.shop_owner.pos.edit_supplier', ':supplier_id') }}';

                    url1 = url1.replace(':supplier_id', v.id);
                    html1+=`
                    <tr>
                        <td>${++i}</td>
                        <td>${v.shop_name}</td>
                        <td>${v.shop_type}</td>
                        <td>${v.code_number}</td>
                        <td>${v.name}</td>
                        <td>${v.phone}</td>
                        <td>${v.other_phone}</td   >
                        <td>${v.date}</td>
                        <td>
                        <div class="d-flex">
                            <a href="#myModal${v.id}" class="text-danger" data-toggle="modal"><i class="fa fa-trash"></i></a>
                            <a href="${url1}" class="ml-4 text-warning"><i class="fa fa-pencil" ></i></a>
                            <a href="#" class="ml-4 text-success"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        </div>
                        </td>

                        <div id="myModal${v.id}" class="modal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete List</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <p class="text-center">Are you Sure to Delete this List?</p>
                                </div>
                                <div class="modal-footer text-center">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCLE</button>
                                    <button type="button" class="btn btn-color" onclick="suredelete(${v.id})">DELETE</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    </tr>
                    `;
                })
                $('#filter').html(html1);
                }
            })
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

