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

    
            @foreach($shopowner as $shopowner )
               <div class="sn-shop-header d-sm-none">{{$shopowner->shop_name}}</div>
            @endforeach

            <!-- Main content -->
            <div class="row justify-content-center">
            <div class="card col-9 col-lg-6 card-outline card-primary mt-5">
                <div class="card-header">Create Template</div>
                <div class="card-body">
                 
                      <div class="row g-3 align-items-center mb-3">
                          <div class="col-auto">
                            <label for="a-1" class="col-form-label">Template Name</label>
                          </div>
                          <div class="col-12">
                            <input type="text" min=0 class="form-control" name="name" id="a-1"  placeholder="Template 1">
                          </div>                           
                      </div>
                     
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-12">
                               <label for="a-2" class="col-form-label">အထည်မပျက်ပြန်သွင်း </label>
                            </div>
                            <div class="col-12">
                               <input type="text"class="form-control" name="အထည်မပျက်ပြန်သွင်း" id="a-2" placeholder="eg. 12000 or 10%">
                            </div>                           
                        </div>
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-12">
                               <label for="a-3" class="col-form-label">အထည်ပျက်စီးချို့ယွင်း </label>
                            </div>
                            <div class="col-12">
                               <input type="text"class="form-control" name="အထည်ပျက်စီးချို့ယွင်း" id="a-3" placeholder="eg. 12000 or 10%" >
                            </div>                           
                        </div>
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-12">
                               <label for="a-4" class="col-form-label">တန်ဖိုးမြင့် အထည်နှင့်အထည်မပျက်ပြန်လဲ </label>
                            </div>
                            <div class="col-12">
                               <input type="text"class="form-control" name="တန်ဖိုးမြင့်" id="a-4" placeholder="eg. 12000 or 10%" >
                            </div>                           
                        </div>
                  
                    <button  class="btn btn-primary recapCreate">Create</button>

                </div>
            </div>
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
@push('scripts')
    <script>
        $('.recapCreate').click(function(e){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    Accept: "application/json"
                }
            });
            e.preventDefault();
            $.ajax({
                url: "{{ route('backside.shop_owner.items.template.store') }}",
                method: "POST",                	
                data: {
                    name : jQuery("input[name=name]").val(),
                    အထည်မပျက်ပြန်သွင်း : jQuery("input[name=အထည်မပျက်ပြန်သွင်း]").val(),
                    အထည်ပျက်စီးချို့ယွင်း : jQuery("input[name=အထည်ပျက်စီးချို့ယွင်း]").val(),
                    တန်ဖိုးမြင့်  : jQuery("input[name=တန်ဖိုးမြင့်]").val(),
                },
                error:function(err){
                    $.each(err.responseJSON.errors, function (i, error) {
                        var el = $(document).find('[name="'+i+'"]');
                        el.after($('<span class="invalid-feedback">'+error[0]+'</span>'));
                        el.addClass('is-invalid');
                    });
                    
                },
                success:function(response){
                $('.recapCreate').attr('disabled', 'disabled'); 

                    if(response.success){
                       alert(response.message);
                       window.location.href = "{{ route('backside.shop_owner.items.template.list')}}";

                    }else{
                        alert("Error");
                    }
                },

            });
        })
    </script>
@endpush

