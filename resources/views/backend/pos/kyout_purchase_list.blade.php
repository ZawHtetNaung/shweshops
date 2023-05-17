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
                    <h4 class="text-color">​​ကျောက်ထည် အဝယ်စာရင်းများ</h4>
                    <a class="btn btn-m btn-color ml-3" href="{{route('backside.shop_owner.pos.create_kyout_purchase')}}">
                    <i class="fa fa-plus mr-2"></i>Create</a>
                    {{-- <div class="dropdown ml-5">
                        <a class="btn btn-m btn-color dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-filter"></i></a>
                        <ul class="dropdown-menu px-1">
                        <li><label><input type="checkbox" id="female" > မိန်းမဝတ်</label></li>
                        <li><label><input type="checkbox" id="male"> ​​ယောကျားဝတ်</label></li>
                        <li><label><input type="checkbox" id="unisex"> unisex</label></li>
                        <li><label><input type="checkbox" id="child"> က​လေးဝတ်</label></li>
                        <li><hr class="dropdown-divider"/></li>
                        <li><a href="#" class="btn btn-color btn-sm" style="margin-left: 50px;" onclick="goldtypefilter(1)">Save</a></li>
                        </ul>
                    </div> --}}
                </div>
                <div class="row mt-3">
                    <label for="">From:<input type="date" id="start_date"></label>
                    <label for="" class="ml-3">To:<input type="date" id="end_date"></label>
                    <label for="" style="margin-left: 20px;margin-top:30px;">
                        <a href="#" class="btn btn-color btn-m" onclick="goldtypefilter(2)">Search</a>
                    </label>
                </div>
                <div class="card mt-2">
                    <div class="card-body">
                        <div class=" table-responsive text-black">
                        <table class="table table-striped" id="example23">
                            <thead>
                                <th>နံပါတ်</th>
                                <th>​​ကျောက်ထည်အမည်</th>
                                <th>ကုဒ်နံပါတ်</th>
                                <th>ပန်းထိမ်ဆိုင်</th>
                                <th>စိန်​ကျောက်ချိန်<br>(in MM units)</th>
                                <th>​ရွှေအရည်အ​သွေး</th>
                                <th>Date</th>
                                <th></th>
                            </thead>
                            <tbody class="text-center" id="filter">
                                <?php $i = 1;?>
                                @foreach ($purchases as $purchase)
                                <?php  $arr = explode ("/",$purchase->gold_gram_kyat_pe_yway); ?>
                                <tr>
                                 <td>{{$i++}}</td>
                                 <td>{{$purchase->gold_name}}</td>
                                 <td>{{$purchase->code_number}}</td>
                                 <td>{{$purchase->supplier->name}}</td>
                                 <td>
                                    {{$arr[1] !=0 ? $arr[1].'ကျပ်' : ''}}
                                    {{$arr[2] !=0 ? $arr[2].'ပဲ' : ''}}
                                    {{$arr[3] !=0 ? $arr[3].'ရွေး' : ''}}
                                 </td>
                                 <td>{{$purchase->quality->name}}</td>
                                 <td> ​
                                    {{$purchase->date}}
                                 </td>
                                 <td>
                                    <a href="#myModal{{$purchase->id}}" class="text-danger" data-toggle="modal"><i class="fa fa-trash"></i></a>
                                    <a href="{{route('backside.shop_owner.pos.edit_kyout_purchase',$purchase->id)}}" class="ml-2 text-warning"><i class="fa fa-pencil" ></i></a>
                                    <a href="#" class="ml-2 text-success"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                 </td>

                                 <div id="myModal{{$purchase->id}}" class="modal">
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
                                                <button type="button" class="btn btn-color" onclick="suredelete({{$purchase->id}})">DELETE</button>
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
         function goldtypefilter(val){
            var html = '';
            if($("#female").is(":checked") == true){
                html += 'option1'
            }
            if($("#male").is(":checked") == true){
                html += '/option2'
            }
            if($("#unisex").is(":checked") == true){
                html += '/option3'
            }
            if($("#child").is(":checked") == true){
                html += '/option4'
            }
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();

            $.ajax({

            type:'POST',

            url: '{{route("backside.shop_owner.pos.kyout_type_filter")}}',

            data:{
            "_token":"{{csrf_token()}}",
            "text" : html,
            "start_date" : start_date,
            "end_date" : end_date,
            "type" : val,
            },

            success:function(data){
                var html1 = '';
                $.each(data.data, function(i, v) {
                    var url1 = '{{ route('backside.shop_owner.pos.edit_kyout_purchase', ':purchase_id') }}';

                    url1 = url1.replace(':purchase_id', v.id);
                    var arr = v.gold_gram_kyat_pe_yway.split('/');
                    html1+=`
                    <tr>
                        <td>${++i}</td>
                        <td>${v.gold_name}</td>
                        <td>${v.supplier.name}</td>
                        <td>${v.code_number}</td>
                        <td>`
                        if(arr[1] != 0){
                            html1 += arr[1]+'ကျပ်';
                        }
                        if(arr[2] != 0){
                            html1 += arr[2]+'ပဲ';
                        }
                        if(arr[3] != 0){
                            html1 += arr[3]+'ရွေး';
                        }
                        html1 += `</td>
                        <td>${v.quality.name}</td>
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
         $(document).ready(function() {
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
        });

        function suredelete(id){
            // alert(id);
                $.ajax({

                    type:'POST',

                    url: '{{route("backside.shop_owner.pos.delete_kyout_purchase")}}',

                    data:{
                    "_token":"{{csrf_token()}}",
                    "pid" : id,
                    },

                    success:function(data){
                        location.reload();
                        // console.log('success');
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
        .btn-color{
        background-color: #780116;
        color: white;
    }
    .text-color{
        color: #780116;
    }

    </style>
@endpush

