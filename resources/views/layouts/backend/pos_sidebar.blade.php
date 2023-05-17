<aside class="main-sidebar sidebar-dark-primary elevation-4" style="z-index: 99999;">
    <!-- Brand Logo -->
    <div class="justify-content-between align-items-center">
        <div class="row mt-2">
            <img src="https://test.shweshops.com/test/img/logo-m.png" alt="" width="100" height="100" class="offset-3">
        </div>

        <a href="{{url('/')}}" class="brand-link logo-switch">
            <span class=" logo-xl brand-text font-weight-bold text-color text-center">ShweShops POS</span>
            {{-- <span class=" logo-xs brand-image-xs font-weight-bold">ရွှေ</span> --}}
        </a>
        <div class="hide-on-wide">
            <i id="sop-toggle" class="fas fa-times"></i>
        </div>
    </div>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        @php
        use App\Shopowner;
        use App\Manager;

           if(isset(Auth::guard('shop_owner')->user()->id)){
              $current_shop=Shopowner::where('id',Auth::guard('shop_owner')->user()->id)->first();
           }else{
               $manager= Manager::where('id', Auth::guard('shop_role')->user()->id)->pluck('shop_id');
               $current_shop=Shopowner::where('id',$manager)->first();

           }

        @endphp




            <a href="{{url('backside/shop_owner/shop')}}"  class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
                <div class="image">
                    <img src="{{url('/images/logo/'.$current_shop->shop_logo)}}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info text-capitalize text-color">
                    {{\Illuminate\Support\Str::limit($current_shop->shop_name, 20, '...')}}
                </div>
            </a>






        <!-- SidebarSearch Form -->
        {{-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                       aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> --}}
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar  flex-column nav-flat sop-sidebar" data-widget="treeview" role="menu" data-accordion="false" style="margin-bottom: 40px">

                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                @if(isset(Auth::guard('shop_owner')->user()->id) || Auth::guard('shop_role')->user()->role_id == 1 || Auth::guard('shop_role')->user()->role_id == 2)
                    <li class="nav-item py-1">
                        <a href="{{url('backside/shop_owner/detail')}}" class="nav-link">
                            <i class="fi fi-rr-home nav-icon"></i>
                            <p class="font-weight-bold">
                                Dashboard
                            {{-- {{\Illuminate\Support\Str::limit($current_shop->shop_name, 20, '...')}} --}}

                            </p>
                        </a>
                    </li>
                @endif


                 @isset(Auth::guard('shop_owner')->user()->id)

                    <li class="nav-item py-1">
                        <a href="#" class="nav-link">
                            <i class="fa fa-shopping-cart nav-icon"></i>
                            <p class="font-weight-bold">
                                အဝယ်စာရင်း
                                <i class="right fas fa-angle-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item py-1">
                                <a href="{{route('backside.shop_owner.pos.purchase_list')}}" class="nav-link border-0">
                                    <i class="fa fa-circle pl-5"></i>
                                    <p class="font-weight-bold" class="ml-3">​ရွှေစာရင်း</p>
                                </a>
                            </li>
                            <li class="nav-item py-1">
                                <a href="{{route('backside.shop_owner.pos.create_purchase')}}" class="nav-link border-0">
                                    <i class="fa fa-circle pl-5"></i>
                                    <p class="font-weight-bold" class="ml-3">​ရွှေအသွင်း</p>
                                </a>
                            </li>
                            <li class="nav-item py-1">
                                <a href="{{route('backside.shop_owner.pos.kyout_purchase_list')}}" class="nav-link border-0">
                                    <i class="fa fa-circle pl-5"></i>
                                    <p class="font-weight-bold" class="ml-3">​ကျောက်ထည်စာရင်း</p>
                                </a>
                            </li>
                            <li class="nav-item py-1">
                                <a href="{{route('backside.shop_owner.pos.create_kyout_purchase')}}" class="nav-link border-0">
                                    <i class="fa fa-circle pl-5"></i>
                                    <p class="font-weight-bold" class="ml-3">​ကျောက်ထည်အသွင်း</p>
                                </a>
                            </li>
                            <li class="nav-item py-1">
                                <a href="{{route('backside.shop_owner.pos.ptm_purchase_list')}}" class="nav-link border-0">
                                    <i class="fa fa-circle pl-5"></i>
                                    <p class="font-weight-bold" class="ml-3">​ပလက်တီနမ်စာရင်း</p>
                                </a>
                            </li>
                            <li class="nav-item py-1">
                                <a href="{{route('backside.shop_owner.pos.create_ptm_purchase')}}" class="nav-link border-0">
                                    <i class="fa fa-circle pl-5"></i>
                                    <p class="font-weight-bold" class="ml-3">​​ပလက်တီနမ်အသွင်း</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item py-1">
                        <a href="{{route('backside.shop_owner.pos.supplier_list')}}" class="nav-link">
                            <i class="fa fa-diamond nav-icon" aria-hidden="true"></i>
                            <p class="font-weight-bold">
                                စိန်ကျောက်ထည်စာရင်း
                            </p>
                        </a>
                    </li>
                    <li class="nav-item py-1">
                        <a href="{{route('backside.shop_owner.pos.supplier_list')}}" class="nav-link">
                            <i class="fa fa-users nav-icon"></i>
                            <p class="font-weight-bold">
                                Staffစာရင်း
                            </p>
                        </a>
                    </li>
                    <li class="nav-item py-1">
                        <a href="{{route('backside.shop_owner.pos.supplier_list')}}" class="nav-link">
                            <i class="fa fa-user-plus nav-icon"></i>
                            <p class="font-weight-bold">
                                ကုန်သည်စာရင်း
                            </p>
                        </a>
                    </li>
                    <li class="nav-item py-1">
                        <a href="{{route('backside.shop_owner.pos.assign_gold_list')}}" class="nav-link">
                            <i class="fa fa-pencil-square-o nav-icon"></i>
                            <p class="font-weight-bold">
                                ​ရွှေ​စျေးသတ်မှတ်ရန်
                            </p>
                        </a>
                    </li>
                    <li class="nav-item py-1">
                        <a href="{{route('backside.shop_owner.pos.assign_platinum_list')}}" class="nav-link">
                            <i class="fa fa-pencil-square-o nav-icon"></i>
                            <p class="font-weight-bold" style="font-size:15px;">
                                ပလက်တီနမ်​စျေးသတ်မှတ်ရန်
                            </p>
                        </a>
                    </li>

                 @endisset



            <div class="sop-btm-right">
                <ul class="nav nav-pills nav-sidebar  flex-column nav-flat">
                    <li class="nav-item">
                        <a class="nav-link"  href="{{route('backside.shop_owner.logout')}}"  role="button" onclick="event.preventDefault();deleteLocalData(); document.getElementById('logout-form').submit(); ">
                            <i class="nav-icon fas fa-sign-out-alt"></i> <p class="font-weight-bold">Log Out</p>
                        </a>

                        <form id="logout-form" action="{{route('backside.shop_owner.logout')}}" method="POST" style="display: none;">

                                                        @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
@push('css')
<style>
    @import url({{url('fonts/css/flaticon-straight.css')}});
    @import url({{url('fonts/css/flaticon-rounded.css')}});
    body {
        word-wrap: break-word;
    }
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #780116;
    }

    ::-webkit-scrollbar-thumb {
        background: #780116;
        border-radius: 3px;
        border: 4px solid transparent;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #780117cc;
    }
    .main-sidebar ::-webkit-scrollbar {
        display:none;
    }
    .sidebar-collapse .user-panel img {
        width: 2.3rem;
        height: 2.3rem;
    }
    .user-panel img {
        object-fit: cover;
    }
    .brand-link {
        border:none!important;
    }
    .brand-link span{
        font-size: 1.5rem;
    }


    .user-panel  {
        border:none!important;
    }
    .sidebar-dark-primary{
        /* font-family: sans-serif; */
        font-family: 'Myanmar3', Sans-Serif !important;
    }

    .sop-btm-right{
        position: fixed;
        bottom: 10px;
        text-align: right;

    }

    .sidebar-collapse .sop-btm-right{

        text-align:left;
    }
    .sop-sidebar .disabled{
        opacity: 0.5;

    }
    .sop-btm-right li{
        opacity: 0.6;
    }
    .sop-btm-right li:hover{
        opacity: 1;
    }
    .main-sidebar{
        position: fixed!important;
        top: 0;
        bottom: 0;
        left: 0;
    }
    .hide-on-wide {
        text-align: right;
        cursor: pointer;
    }
    .hide-on-wide:hover {
        color:#780116;
    }
    .nav-sub-header{
        padding: 0.5rem 1rem;
    }
    .longtext-margin{
        margin-left: 0.3rem!important;
    }

    .nav-treeview {
        margin-left: 0;
    }

    .fa-circle {
        font-size: 8px !important;
    }

    .nav-sidebar .menu-is-opening > .nav-link p >i {
        -webkit-transform: rotate(90deg) !important;
        transform: rotate(90deg) !important;
    }
    @media only screen and (max-width: 992px) {
        .sidebar-dark-primary{
            background-color: #780116;
        }
        @supports ((-webkit-backdrop-filter: none) or (backdrop-filter: none)) {
            .sidebar-dark-primary{
                background-color: #f0f7fab0;
                color: #4E73F8;
                -webkit-backdrop-filter: blur(20px);
                backdrop-filter: blur(20px);
            }
        }
        .sidebar-dark-primary a{
            color: #2755fd!important;
        }
        .sidebar-dark-primary a:hover{
            color: #780116!important;
        }

        .info img{
            width: 70px;
        }

    }
    @media only screen and (min-width: 992px) {
        .sidebar-dark-primary{
            background-color: white;
            color: black;
        }
        .sidebar-dark-primary a{
            color: black!important;
        }
        .sidebar-dark-primary a{
            color: black!important;
        }
        .sop-btm-right{
            background-color: white;
        }
    }
    @media only screen and (max-width: 576px) {
        .sidebar-open .main-sidebar, .main-sidebar::before {
            width: 100%;
            font-size: 1.3rem!important;
            padding: 1rem;
        }
        .sidebar-mini .main-sidebar .nav-flat .nav-link, .sidebar-mini-md .main-sidebar .nav-flat .nav-link, .sidebar-mini-xs .main-sidebar .nav-flat .nav-link {
            width: 100%;
            background-color: #780116;
        }
        .nav-link{

        }
        .sop-btm-right{
            text-align:right;
        }
        .hide-on-wide{
            display:block;
        }
        .sidebar-open .sop-btm-right{
            width: 90%;
        }
        .user-panel img {
            width: 80px!important;
            height: 80px!important;;
            width: 100%;
            height: auto;
        }
        .info p {
            color: #000;
            font-weight: 600;

        }
        .info span {
            font-weight: 500!important;
        }
    }
    @media only screen and (min-width: 576px) {
        .hide-on-wide{
            display:none;
        }
        .user-panel img {
            width: 58px!important;
            height: 58px!important;;
            width: 100%;
            height: auto;
        }

    }
    .text-color{
        color: #780116;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function(){
        $("#sop-toggle").click(function(){
            $("body").removeClass("sidebar-open").addClass("sidebar-closed sidebar-collapse");
        });
    });
    function deleteLocalData(){
        // window.localStorage.removeItem('fav');
        // window.localStorage.removeItem('selection');
        // window.localStorage.removeItem('favID');
        // window.localStorage.removeItem('selectionID');
        // window.localStorage.removeItem('discountedID');
    }
</script>
@endpush
