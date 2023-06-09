@extends('layouts.backend.posbackend')
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

                <div class="card">
                    <div class="card-body">
                        {{-- <span class="offset-5  mt-2 font-weight-bold" style="font-size:19px;">Create Purchase Form (ရွှေ)</span> --}}
                         <form action="{{route('backside.shop_owner.pos.store_kyout_purchase')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-7">
                                    <h4 class="text-color mt-2">​<i class="fa fa-chevron-left" aria-hidden="true" onclick="back()"></i> &nbsp;&nbsp;​​ကျောက်ထည်စာရင်းသွင်းခြင်း</h4>
                                    <div class="col-4 mt-2">
                                        <label for="date" class="col-form-label">Choose Date</label>
                                        <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>"><br><br>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="row mt-3">
                                        <div class="card col-5 py-2 card-color">
                                            <span class="text-white" style="font-size:19px;">​ယ​​နေ့ဆိုင်​ပေါက်​စျေး</span><br>
                                            <span class="text-white" style="font-size:19px;">{{$shop_price}} mmk</span>
                                        </div>
                                        <div class="card offset-1 col-5 py-2 card-color1">
                                            <span class="text-white" style="font-size:19px;">​ယ​နေ့အပြင်​ပေါက်​စျေး</span><br>
                                            <span class="text-white" style="font-size:19px;">{{$out_price}} mmk</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                           <div class="row">
                            <div class="col-7">
                                <span class="text-color" style="font-size:19px;">​ရွှေထည်အ​ကြောင်းများ</span>
                            </div>
                            <div class="col-5">
                                <span class="text-color" style="font-size:19px;">ကျောက်ထည်​စျေးနှုန်းတွက်ချက်ခြင်း</span>
                            </div>
                          </div>
                         <div class="row mt-5">
                            <div class="col-3 form-group">
                                <label for="gold_name">​ရွှေထည်အမည်</label>
                                <input type="text" name="gold_name" class="form-control" required>
                            </div>
                            <div class="col-3 form-group">
                                <label for="supplier_id">ပန်းထိမ်ဆိုင်</label>
                                <select name="supplier_id" class="form-control" required>
                                    <option value="">Choose Supplier</option>
                                    @foreach ($suppliers as $supplier)
                                    <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="offset-1 col-5">
                                <div>
                                    <label for="gold_weight">ရွှေထည် အလေးချိန်</label>
                                </div>
                                <div class="row">
                                    <div class="col-3 form-group">
                                        <input type="number" step="0.01" name="gold_gram" placeholder="Gram" id="gold_gram" class="form-control" required>

                                    </div>
                                    <div class="col-3 form-group">
                                        <input type="number" step="0.01" name="gold_kyat"  id="gold_kyat" class="form-control"  placeholder="ကျပ်">

                                    </div>
                                    <div class="col-3 form-group">
                                        <input type="number" step="0.01" name="gold_pe" id="gold_pe" class="form-control"  placeholder="ပဲ">
                                    </div>
                                    <div class="col-3 form-group">
                                        <input type="number" step="0.01" name="gold_yway" id="gold_yway" class="form-control"  placeholder="ရွေး">
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 form-group">
                                <label for="quality">ရွှေအရည်အသွေး</label>
                                <select name="quality" class="form-control" onchange="calculate_quality_price(this.value)" required>
                                    <option value="">Choose Quality</option>
                                    @foreach ($quality as $q)
                                    <option value="{{$q->id}}">{{$q->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3" hidden>
                                <input type="text" name='gold_price' id='gold_price'>
                            </div>
                            <div class="col-3 form-group">
                                <label for="gold_type">ရွှေအမျိုးအစား</label>
                                <input type="text" name="gold_type" class="form-control">
                            </div>
                            <div class="offset-1 col-5">
                                <div>
                                    <label for="diamond_weight">စိန်​ကျောက်ချိန်</label>
                                </div>
                                <div class="row">
                                    <div class="col-3 form-group">
                                        <input type="number" step="0.01" name="diamond_gram" placeholder="Gram" id="diamond_gram" class="form-control" required>

                                    </div>
                                    <div class="col-3 form-group">
                                        <input type="number" step="0.01" name="diamond_kyat"  id="diamond_kyat" class="form-control"  placeholder="ကျပ်">

                                    </div>
                                    <div class="col-3 form-group">
                                        <input type="number" step="0.01" name="diamond_pe" id="diamond_pe" class="form-control"  placeholder="ပဲ">
                                    </div>
                                    <div class="col-3 form-group">
                                        <input type="number" step="0.01" name="diamond_yway" id="diamond_yway" class="form-control"  placeholder="ရွေး">
                                    </div>
                                </div>
                            </div>

                            <div class="col-3 form-group">
                                <label for="category_id">Product အမျိုးအစား</label>
                                <select name="category_id" class="form-control" id="category_id" required>
                                    <option value="">Choose Type</option>
                                    @foreach ($categories as $cat)
                                    <option value="{{$cat->id}}">{{$cat->mm_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-2 form-group">
                                <label for="code_number">ကုဒ်နံပါတ်</label>
                                <input type="text" name="code_number" class="form-control @error('code_number') is-invalid @enderror" id="code_number" required>

                                @error('code_number')
                                    <span class="invalid-feedback alert alert-danger" role="alert"  height="100">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-1" style="margin-top: 37px;">
                                <button type="button" class="btn btn-sm card-color py-1 text-white" onclick="autofillcode()">Generate</button>
                            </div>
                            <div class="offset-1 col-5">
                                <div>
                                    <label for="decrease_weight">အလျော့တွက်</label>
                                </div>
                                <div class="row">
                                    <div class="col-3 form-group">
                                        <input type="number" step="0.01" name="decrease_price"  id="decrease_amount" class="form-control"  placeholder="">
                                    </div>
                                    <div class="col-3 form-group">
                                        <select name="currency" id="currency">
                                            <option value="MMK">MMK</option>
                                            <option value="%">%</option>
                                        </select>
                                    </div>
                                    <div class="col-3 form-group">
                                        <input type="number" step="0.01" name="decrease_pe" id="decrease_pe" class="form-control"  placeholder="ပဲ">

                                    </div>
                                    <div class="col-3 form-group">
                                        <input type="number" step="0.01" name="decrease_yway" id="decrease_yway" class="form-control"  placeholder="ရွေး">
                                    </div>
                                </div>
                            </div>

                            <div class="col-3 form-group">
                                <label for="purchase_price">ဝယ်ယူသည့်​စျေးနှုန်း</label>
                                <input type="text" name="purchase_price" class="form-control" onchange="fill_capital(this.value)" required>
                            </div>
                            <div class="col-3 form-group">
                                <label for="staff_id">စစ်​ဆေးမည့် ဝန်ထမ်း</label>
                                <select name="staff_id" id="staff_id" class="form-control">
                                    <option>ဝန်ထမ်းများ</option>
                                    <option value="1">staff one</option>
                                    <option value="2">staff two</option>
                                </select>
                            </div>
                            <div class="offset-1 col-5">
                                <div>
                                    <label for="profit_weight">အမြတ်</label>
                                </div>
                                <div class="row">
                                    <div class="col-3 form-group">
                                        <input type="number" step="0.01" name="profit"  id="profit_amount" class="form-control"  placeholder="">
                                    </div>
                                    <div class="col-3 form-group">
                                        <select name="currency1" id="currency">
                                            <option value="MMK">MMK</option>
                                            <option value="%">%</option>
                                        </select>
                                    </div>
                                    <div class="col-3 form-group">
                                        <input type="number" step="0.01" name="profit_pe" id="profit_pe" class="form-control"  placeholder="ပဲ">

                                    </div>
                                    <div class="col-3 form-group">
                                        <input type="number" step="0.01" name="profit_yway" id="profit_yway" class="form-control"  placeholder="ရွေး">
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 form-group">
                                <span class="text-color" style="font-size:19px;">စိန်​ကျောက်ထည်အ​ကြောင်းများ</span><br><br>
                                <label for="diamond_id">စိန်​ကျောက်အမည်</label>
                                <select name="diamond_id" id="diamond_id" class="form-control">
                                    <option>စိန်​ကျောက်များ</option>
                                    <option value="1">diamond one</option>
                                    <option value="2">diamond two</option>
                                </select>
                            </div>
                            <div class="offset-4 col-5">
                                <div>
                                    <label for="product_weight">လက်ခ</label>
                                </div>
                                <div class="row">
                                    <div class="col-3 form-group">
                                        <input type="number" step="0.01" name="service_fee"  id="service_amount" class="form-control"  placeholder="">
                                    </div>
                                    <div class="col-3 form-group">
                                        <select name="currency2" id="currency2">
                                            <option value="MMK">MMK</option>
                                            <option value="%">%</option>
                                        </select>
                                    </div>
                                    <div class="col-3 form-group">
                                        <input type="number" step="0.01" name="service_pe" id="service_pe" class="form-control"  placeholder="ပဲ">

                                    </div>
                                    <div class="col-3 form-group">
                                        <input type="number" step="0.01" name="service_yway" id="service_yway" class="form-control"  placeholder="ရွေး">
                                    </div>
                                </div>
                            </div>
                            <div class="image-upload-wrap col-6 py-3">
                                <input class="file-upload-input" type='file' id="image"  accept="image/*" name="photo"/>
                                <div class="drag-text">
                                  <h6 class="mt-3"><img src=""  style="max-height: 100px;" id="preview-image-before-upload">ပုံ​ရွေးရန်</h6>
                                </div>
                            </div>
                            <div class="offset-1 col-5">
                                <div class="row" style="margin-top:35px;">
                                    <a href="#" class="btn btn-m btn-color text-center col-12"  onclick="calculate_price()">​ရွှေ​ဘိုးတွက်ရန်</a>
                                </div>
                            </div>

                            <div class="col-6 mt-5">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name='inlineCheckbox1' value="option1"/>
                                    <label class="form-check-label" for="inlineCheckbox1">​မိန်းမဝတ်</label>
                                </div>

                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name='inlineCheckbox2' value="option2"/>
                                    <label class="form-check-label" for="inlineCheckbox2">​​ယောကျားဝတ်</label>
                                  </div>

                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name='inlineCheckbox3' value="option3"/>
                                    <label class="form-check-label" for="inlineCheckbox3">unisex</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox4" name='inlineCheckbox4' value="option4"/>
                                    <label class="form-check-label" for="inlineCheckbox4">က​လေးဝတ်</label>
                                  </div>
                            </div>
                            <div class="offset-1 col-5">
                                <div class="row mt-1">
                                    <div class="col-6 form-group">
                                        <label for="capital">အရင်း​​</label>
                                        <input type="number" name="capital" class="form-control" id="capital">
                                    </div>
                                    <div class="col-6 form-group">
                                        <label for="gold_fee">​​ရွှေဘိုး</label>
                                        <input type="number" name="gold_fee" class="form-control" id="gold_fee">
                                    </div>
                                    <div class="col-6 form-group">
                                        <label for="diamond_selling_price">စိန်​ကျောက်ဖိုးအ​ရောင်း</label>
                                        <input type="number" name="diamond_selling_price" class="form-control" id="diamond_selling_price">
                                    </div>
                                    <div class="col-6 form-group">
                                        <label for="selling_price">ရောင်းဈေး</label>
                                        <input type="number" name="selling_price" class="form-control" id="selling_price" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <hr/>
                            </div>
                            <div class="col-6 mt-2">
                                <span class="text-color" style="font-size:19px;">​Code ဖတ်ရန်</span><br>
                                <div class="col-12 mt-3" >
                                    <label for="print_barcode">Print Barcode</label>
                                    <input type="checkbox" name="print_barcode" id='print_barcode' class="ml-4" value="0" onclick="check_barcode()">
                                </div>
                                <div class="col-12 form-group" id="text_barcode">
                                    <label for="barcode_text">Barcode Text</label>
                                    <input type="text" name="barcode_text" id="barcode_text" class="form-control" onchange="addBarcodeText(this.value)">
                                </div>


                                <div class="col-12" id="barcode_convert">
                                    <input type="text" id="text" />
                                    <input type="hidden" id="scan_text"/>
                                    <input type="button" id="button" name="click" value="Convert Barcode" />
                                    <div id="print">
                                        <div id="showVal"></div>
                                        <div id="bcTarget"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 form-group mt-2">
                                <label for="remark" class="text-color">မှတ်ချက်ထည့်သွင်းရန်</label>
                                <textarea name="remark" id="" cols="30" rows="7"></textarea>
                            </div>

                            <div class="row mt-4 offset-5">
                                <button type="submit" class="btn btn-m btn-color text-center"><i class="fa fa-floppy-o mr-2" aria-hidden="true"></i>Save</button>
                            </div>
                         </div>
                        </form>
                        <div id="mobileprint" class="d-none">

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
        $(document).ready(function(){
            $('#barcode_convert').hide();
            $('#text_barcode').hide();
            $("#button").click(function(){
            var barcode_text = $('#scan_text').val();
            var text = $('#text').val();
            $("#showVal").text(barcode_text);
            $("#bcTarget").barcode(text, "code39");
            });
            $("#button").click();

            $("#print").click(function() {
            let html = document.getElementById('print').innerHTML;
            $('#mobileprint').html(html);

            var printContent = $('#mobileprint')[0];
            var WinPrint = window.open('', '', 'width=900,height=650');
            WinPrint.document.write('<html><head><title>Print Voucher</title>');
            WinPrint.document.write('<link rel="stylesheet" type="text/css" href="css/style.css">');
            WinPrint.document.write('<link rel="stylesheet" type="text/css" media="print" href="css/print.css">');
            WinPrint.document.write('</head><body >');
            WinPrint.document.write(printContent.innerHTML);
            WinPrint.document.write('</body></html>');

            WinPrint.focus();
            WinPrint.print();
            WinPrint.document.close();
            WinPrint.close();
            });
            $('#image').change(function(){

            let reader = new FileReader();

            reader.onload = (e) => {

              $('#preview-image-before-upload').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);

           });

        });

        function  addBarcodeText(val){
            $('#scan_text').val(val);
        }

        // function fill_capital(val){
        //     $('#capital').val(val);
        // }

        function check_barcode(){
            if($('#print_barcode').is(':checked')){
                var code = $('#code_number').val();
                var gram = $('#gold_gram').val();
                // var barcode_text = $('#barcode_text').val();
                if(code == '' || gram == ''){
                    swal({
                            title: "Warning!",
                            text : "You need to fill code number or gold's gram!",
                            icon : "warning",
                        });
                }else{
                    $('#text').val(code+'-'+gram);
                    // $('#scan_text').val(barcode_text);
                    $('#print_barcode').val(1);
                    $('#barcode_convert').show();
                    $('#text_barcode').show();

                }
            }else{
                $('#barcode_convert').hide();
                $('#text_barcode').hide();
            }

        }
        function autofillcode(){
            var category_id = $('#category_id').val();
            $.ajax({

                type:'POST',

                url:'{{route("backside.shop_owner.pos.codegenerate")}}',

                data:{
                "_token":"{{csrf_token()}}",
                "category_id":category_id,
                "type": 'gold',
                },

                success:function(data){
                    if(data.code == 0){
                        swal({
                            title: "Warning!",
                            text : "You need to choose product type!",
                            icon : "warning",
                        });
                    }else{
                        $('#code_number').val(data.code);
                    }

                }
                })
        }
        function calculate_quality_price(val){
            $.ajax({

                type:'POST',

                url:'{{route("backside.shop_owner.pos.quality_gold_price")}}',

                data:{
                "_token":"{{csrf_token()}}",
                "quality_id":val,
                },

                success:function(data){
                    $('#gold_price').val(data);
                }
            })
        }

        function calculate_price(){
            var yway = parseFloat($('#gold_yway').val());
            var pe = parseFloat($('#gold_pe').val());
            var kyat = parseFloat($('#gold_kyat').val());
            var gold_price = parseInt($('#gold_price').val());
            var dyway = parseFloat($('#diamond_yway').val());
            var dpe = parseFloat($('#diamond_pe').val());
            var dkyat = parseFloat($('#diamond_kyat').val());
            var decrease_pe = parseFloat($('#decrease_pe').val());
            var decrease_yway = parseFloat($('#decrease_yway').val());
            if(decrease_pe){ decrease_pe = decrease_pe;}else{ decrease_pe = 0;}
            if(decrease_yway){ decrease_yway = decrease_yway;}else{ decrease_yway = 0;}
            if(yway){ yway = yway;}else{ yway = 0;}
            if(pe){ pe = pe;}else{ pe = 0;}
            if(kyat){ kyat = kyat;}else{ kyat = 0;}
            if(dyway){ dyway = dyway;}else{ dyway = 0;}
            if(dpe){ dpe = dpe;}else{ dpe = 0;}
            if(dkyat){ dkyat = dkyat;}else{ dkyat = 0;}
            var decrease = (((decrease_yway/8)+decrease_pe)/16)* gold_price;
            var gold = ((((yway/8)+pe)/16)+kyat)*gold_price + decrease;
            var diamond = ((((dyway/8)+dpe)/16)+dkyat)*gold_price;
            var gold_fee =  parseInt(gold-diamond);
            var capital = parseInt(gold);
            $('#capital').val(capital);
            $('#gold_fee').val(gold_fee);
            $('#selling_price').val(gold_fee);
        }

        function back(){
        history.go(-1);
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
        background: #780116;
        color:white;
        padding: 5px 25px;
        }
        .text-color{
        color: #780116;
        }
        .file-upload-input {
        position: absolute;
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        outline: none;
        opacity: 0;
        cursor: pointer;
        }

        .image-upload-wrap {
        margin-top: 20px;
        border: 4px dashed #780116;
        position: relative;
        }

        .drag-text {
        text-align: center;
        }

        .form-check-label{
            font-size: 20px;
        }

        .card-color{
            background-color: #D4AF37;
        }
        .card-color1{
            background-color: #780116;
        }

    </style>
@endpush

