<div class="tz-parent modal modal-bottom sop xs fade" id="orangeModalSubscription" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <button type="button" class="modal-close bg-0" data-dismiss="modal" aria-label="Close">
        <i class="fa-solid fa-xmark"></i> Close
    </button>
    <div class="modal-dialog modal-notify modal-warning tz-modal-notify " role="document" >
        <!--Content-->
        <div class="modal-content border-0" style="background-color: #F3F4F9;">
            <!-- Select Login  -->
                <div class="modal-header select-login-header border-0" style="margin-top: -12px;">
                   <div class="w-100 d-flex justify-content-center">
                        <div class="d-flex justify-content-around align-items-center w-50">
                            <div class="login-select-logo">
                                <img class="w-100" src="{{url('test/img/logo-m.png')}}" />
                            </div>
                            <div class="select-login-title">
                                <h3 class="text-white mt-2">
                                    Login As
                                </h3>
                            </div>
                        </div>
                   </div>
                </div>
                <div class="modal-body select-login-body p-0 border-0">
                    <div class="row justify-content-center p-lg-0 mobile-padding-login-btn">
                        <div class="col-12 col-md-4 custom-rounded-left select-login-btn-height d-flex justify-content-center align-items-center py-2 userLogin">
                            <div class="d-block user">
                                <div class="font-weight-bolder text-center">
                                    <i class="fas fa-user text-light" style="font-size: 30px"></i>
                                </div>
                                <a type="button"href="javascript:void(0)" aria-pressed="true" class="text-light font-weight-bolder mr-3">User</a>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 custom-rounded-right select-login-btn-height d-flex justify-content-center align-items-center py-2 shopLogin">
                            <div class="d-block shopowner">
                                <div class="font-weight-bolder text-center ">
                                    <i class="fas fa-store text-light" style="font-size: 30px"></i>
                                </div>
                                <a type="button"  href="javascript:void(0)" aria-pressed="true" class="text-light font-weight-bolder">Shop Owner</a>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- Select Login end  -->

            <!-- user login   -->
              <div class="modal-header user-login-header border">
                <div class="d-block w-100">
                    <div class="d-flex justify-content-center w-100 " id="shweShops">
                        <img class=" item pe-3 " src="{{url('test/img/logo-m.png')}}" style="height: 40px;padding-bottom:5px"/>
                        <p class="sop-lr-h">Shwe Shops</p>
                    </div>
                        <h4 class="modal-title text-center white-text w-100 font-weight-bold py-2"  style="font-weight: bold;font-size: 20px;">
                            Login To ShweShops
                        </h4>
                </div>
              </div>
               <div class="modal-body user-login-body">
                 <div class="p-3">
                    <!-- phone -->
                    <input id="loginbeforebuynow" name="frombuynow" type="hidden" value="">
                    <input id="loginbeforemessenger" name="frommessenger" type="hidden" value="">
                    <input id="loginbeforepayment" name="frompayment" type="hidden" value="">
                        <div class="md-form mb-3">
                            <label data-error="wrong" data-success="right" for="phoneNumber"  class="sop-lr-l">Phone</label>
                                <input type="text" value="09" name="phone" class="form-control sop-lr-in" id="phoneNumber" style="background-color: #F3F4F9;">

                                  <span class="error_login_phone invalid-feedback d-none" role="alert"></span>

                        </div>

                        <div class="md-form mb-3 text-center">
                           <a type="button" href="javascript:void(0);" class="userRegister"  aria-pressed="true" style="color: #0d6efd !important;">
                             {{ __('အကောင့်မရှိလျှင်') }} {{ __('အကောင့်သစ်ဖွင့်ရန်') }}
                           </a>
                        </div>

                        <div class="md-form">
                         <input type="button" value=" {{ __('Login') }}" class="btn yk-btn-success w-100" id="login" style="
                            background-color: #780116!important;
                            color: white;
                            width: 100% !important;
                            border-radius: 10px;
                            height: 44px;
                            "/>
                        </div>
                 </div>
              </div>
            <!-- user login end  -->

            <!-- request name login   -->
             <div class="modal-header request-name-header border">
                <div class="d-block w-100">
                    <div class="d-flex justify-content-center w-100 " id="shweShops">
                        <img class=" item pe-3 " src="{{url('test/img/logo-m.png')}}" style="height: 40px;padding-bottom:5px"/>
                        <p class="sop-lr-h">Shwe Shops</p>
                    </div>
                        <h4 class="modal-title text-center white-text w-100 font-weight-bold py-2"  style="font-weight: bold;font-size: 20px;">
                            Login To ShweShops
                        </h4>
                </div>
              </div>
               <div class="modal-body request-name-body">
                 <div class="p-3">
                    <!-- phone -->
                        <div class="md-form mb-5">
                            <label data-error="wrong" data-success="right" for="requestName"  class="sop-lr-l">Name</label>
                                <input type="text"  name="username" class="form-control sop-lr-in" id="requestName" style="background-color: #F3F4F9;">

                                  <span class="error_login_phone invalid-feedback d-none" role="alert"></span>

                        </div>


                        <div class="md-form">
                         <input type="button" value=" {{ __('Submit') }}" class="btn yk-btn-success w-100" id="sentName" style="
                            background-color: #780116!important;
                            color: white;
                            width: 100% !important;
                            border-radius: 10px;
                            height: 44px;
                            "/>
                        </div>
                 </div>
              </div>
            <!-- request name end  -->

            <!-- user register   -->
                <div class="modal-header register-header">
                    <div class="d-block w-100">
                        <div class="d-flex justify-content-center w-100 " id="shweShops">
                            <img class=" item pe-3 " src="{{url('test/img/logo-m.png')}}" style="height: 40px;padding-bottom:5px"/>
                            <p class="sop-lr-h">Shwe Shops</p>
                        </div>
                        <h4 class="modal-title text-center white-text w-100 font-weight-bold py-2"  style="font-weight: bold;font-size: 20px;">
                            Register
                        </h4>
                        </div>
                    </div>
                    <div class="modal-body register-body">
                        <div class="p-3">
                            <!-- phone -->
                                <div class="md-form mb-3">
                                    <label data-error="wrong" data-success="right" for="userName"  class="sop-lr-l">Name</label>
                                        <input type="text"  name="username" class="form-control sop-lr-in" id="userName" style="background-color: #F3F4F9;">

                                        <span class="error_name invalid-feedback d-none" role="alert"></span>

                                </div>
                                <div class="md-form mb-3">
                                    <label data-error="wrong" data-success="right" for="regPhoneNumber"  class="sop-lr-l">Phone</label>
                                        <input type="text" value="09" name="phone" class="form-control sop-lr-in" id="regPhoneNumber" style="background-color: #F3F4F9;">

                                        <span class="error_phone invalid-feedback d-none" role="alert"></span>

                                </div>

                                <div class="md-form mb-3 text-center">
                                <a type="button" href="javascript:void(0);" class="userLogin user-login-link-text"  aria-pressed="true" style="color: #0d6efd !important;">
                                {{ __('အကောင့်ဝင်ရန်') }}
                                </a>
                                </div>

                                <div class="md-form">
                                <input type="button" value=" {{ __('Register') }}" class="btn yk-btn-success w-100" id="register" style="
                                    background-color: #780116!important;
                                    color: white;
                                    width: 100% !important;
                                    border-radius: 10px;
                                    height: 44px;
                                    "/>
                                </div>
                        </div>
                </div>
            <!-- user register end  -->

            <!-- shop Owner Login form  -->
                <div class="modal-header header3">
                    <div class="d-block w-100">
                            <div class="d-flex justify-content-center w-100 " id="shweShops">
                                <img class=" item pe-3 " src="{{url('test/img/logo-m.png')}}" style="height: 40px;padding-bottom:5px"/>
                                <p class="sop-lr-h">Shwe Shops</p>
                            </div>

                            <h4 class="modal-title text-center white-text w-100 font-weight-bold py-2"  style="font-weight: bold;font-size: 20px;">
                            Shop Owner Login
                            </h4>
                    </div>

                </div>
                <div class="modal-body body-3">
                    <div class="p-3">
                        <form  method="POST" action="{{ route('backside.shop_owner.logined') }}">
                        {{  Form::hidden('url',URL::previous())  }}
                        @csrf
                            <input id="loginbeforebuynow" name="frombuynow" type="hidden" value="">
                            <div class="md-form mb-5">
                                <label data-error="wrong" data-success="right" for="form3" class="sop-lr-l">Phone</label>
                                <input type="text" name="value" value="09" class="form-control sop-lr-in " style="border-color: #808080;background-color: #F3F4F9;" required>
                            </div>
                            <div class="md-form position-relative">

                                    <!-- <label data-error="wrong" data-success="right" for="form2" class="sop-lr-l">Password</label>  -->
                                    <label for="password" class="sop-lr-l">Password</label>
                                    <div class="position-relative d-flex flex-column">
                                            <!-- <input id="password"  pattern="[0-9]*" inputmode="numeric"  type="password" id="form2" class="pin sop-lr-in form-control"
                                            name="password" placeholder="" required autocomplete="current-password" style="

                                            border-color: #808080;
                                            background-color: #F3F4F9;
                                            "> -->
                                            <input type="password" name="password" id="password" class="sop-lr-in form-control" style="background-color: #F3F4F9;" required>
                                            <i class="fas fa-eye-slash " id="togglePassword" onclick="toggleEye(this)"></i>
                                        @if(Session::has('error'))
                                        <span class="text-danger font-weight-bolder">
                                            {{ Session::get('error')}}
                                        </span>
                                        @endif

                                    </div>


                            </div>

                            <div class="form-check mb-4 d-flex flex-row no-gutters" style="margin-top: 31px;">
                                <div class="col-6 justify-content-start">

                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" style="cursor: pointer">
                                    <label class="form-check-label sop-lr-rf" for="exampleCheck1">Remember Me</label>
                                </div>
                                <div class="col-6 d-flex justify-content-end">

                                    <a href="javascript:void(0)" class="float-right  sop-lr-rf forgotpasswordbutton">Forgot Password?</a>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn yk-btn-success sop-submit w-100" style=" background-color: #780116!important;
                                    color: white;
                                    width: 100% !important;
                                    border-radius: 10px;
                                    height: 44px;
                                    ">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            <!-- shop Owner Login end  -->


        <!-- Verification Code  -->
         <div class="modal-header header4" style="margin-top: -12px;">
            <div class="d-block w-100">
                <div class="d-flex justify-content-center w-100" id="shweShops">
                    <img class="item pe-3 " src="{{url('test/img/logo-m.png')}}" style="height: 40px;padding-bottom:5px"/>
                    <p class="sop-lr-h">Shwe Shops</p>
                </div>

                <h4 class="modal-title text-center white-text w-100 font-weight-bold py-2"  style="font-weight: bold;font-size: 20px;">
                    Verification Code
                </h4>
            </div>

            </div>

            <div class="modal-body" id="codecheckforreg">
                <div class="p-3">
                    <div class="md-form mb-5">
                        <div class="text-center">We have to sent the code verification to <br> Your Phone Number</div>
                            <h1 id="time" class="text-center mb-3">0</h1>
                            <input id="loginbeforebuynow" name="frombuynow" type="hidden" value="">
                                <input type="text" id="regotpcode"
                                name="code"
                                class="form-control "
                                placeholder="Put Your Code Here" required autocomplete=""
                                autofocus style="
                                border-top: none;
                                text-align: center;
                                border-left: none;
                                border-right: none;
                                border-color: black;
                                background-color: #F3F4F9;
                                ">


                        <span id="regerrorcode"></span>
                    </div>
                    <div class="d-flex justify-content-center w-100 ">
                        <button type="submit" id='resendCode' class="btn btn-outline-dark btn-sm sop-resend-otp mr-5 disabled">Resend Code</button>
                        <button type="submit" id='checkcodereg' class="btn sop-submit-otp yk-btn-success tz-btn text-light">Submit</button>
                    </div>
                </div>
            </div>
        <!-- Verification Code end  -->


        <!-- forgotpassword Code  -->
            <div class="modal-header header5" style="margin-top: -12px;">
                <div class="d-block w-100">
                    <div class="d-flex justify-content-center w-100" id="shweShops">
                        <img class="item pe-3 " src="{{url('test/img/logo-m.png')}}" style="height: 40px;padding-bottom:5px"/>
                        <p class="sop-lr-h">Shwe Shops</p>
                    </div>
                    <h4 class="modal-title text-center white-text w-100 font-weight-bold py-2"  style="font-weight: bold;font-size: 20px;">
                    Reset Your Password
                    </h4>
                </div>
            </div>

            <div class="forgotpassword">
                <div class="p-3">
                    <form v-if="showchodecheckform===false && shownewpasswordform===false ">
                        <!--Body-->
                        <div class="modal-body">
                            <div class="md-form mb-5">

                                <label data-error="wrong" data-success="right" for="form3"><i
                                    class="fas fa-phone prefix grey-text" style="
                                    margin-right: 10px;
                                    color: #780116!important;
                                    "></i>Phone</label>
                                    <input type="text" id="form13"
                                    class="form-control @error('phone') is-invalid @enderror validate"
                                    name="value" placeholder="" v-model="phone" required autocomplete="phone"
                                    autofocus style="
                                    border-top: none;
                                    border-left: none;
                                    border-right: none;
                                    border-color: black;
                                    background-color: #F3F4F9;
                                    ">


                                    <span v-if="fperrors !== 0" class="" style="color:red;" role="alert">
                                        <strong>@{{ fperrors.emailorphone[0] }}</strong>
                                    </span>
                                </div>

                        </div>

                        <!--Footer-->
                        <div class="modal-footer justify-content-center">
                            <a type="button" href="javascript:void(0);" class="shopLogin"  aria-pressed="true" style="
                            color: #0d6efd !important;
                            text-decoration: underline !important;
                            "> {{ __('back') }}</a>

                            <input type="button" class="btn yk-btn-success w-100" value="Submit"
                            v-on:click="sendphonetoserver" style="
                            background-color: #780116!important;
                            color: white;
                            width: 100% !important;
                            border-radius: 10px;
                            height: 44px;
                            "/>

                            <br>
                            <br>

                        </div>
                    </form>

                    <div v-if="showchodecheckform">
                        <!--Body-->
                        <div class="modal-body">
                            <div class="md-form mb-5">

                                <label  for="form113"><i
                                    class="fas fa-phone prefix grey-text" style="margin-right: 10px;
                                    color: #780116!important;
                                    "></i>Successfully Send Reset Code</label>
                                    <input type="text"
                                    class="form-control"
                                    placeholder="Put Your Code Here" v-model="code" required autocomplete=""
                                    autofocus style="
                                    border-top: none;
                                    border-left: none;
                                    border-right: none;
                                    border-color: black;
                                    background-color: #F3F4F9;
                                    ">


                                    <span v-if="fperrorscode !== 0" class="" style="color:red;" role="alert">
                                        <strong>@{{ fperrorscode }}</strong>
                                    </span>
                                </div>

                            </div>

                            <!--Footer-->
                            <div class="modal-footer justify-content-center">
                                <input type="button" class="btn yk-btn-success w-100" value="Submit"
                                v-on:click="sendcodetoserver" style="
                                background-color: #780116!important;
                                color: white;
                                width: 100% !important;
                                border-radius: 10px;
                                height: 44px;
                                "/>

                                <br>
                                <br>
                            </div>
                        </div>
                        <div v-if="shownewpasswordform">
                            <!--Body-->
                            <div class="modal-body">
                                    <div class="md-form mb-5">

                                        <label  for="form1113"><i
                                            class="fas fa-phone prefix grey-text" style="margin-right: 10px;
                                            color: #780116!important;
                                            "></i>Add New Pin</label>
                                            <input type="number"
                                            class="form-control"
                                            placeholder="New Password" v-model="password" required autocomplete=""
                                            autofocus style="
                                            border-top: none;
                                            border-left: none;
                                            border-right: none;
                                            border-color: black;
                                            background-color: #F3F4F9;
                                            ">

                                            <input type="number"
                                            class="form-control"
                                            placeholder="Confirm Your Password" v-model="password_confirmation" required autocomplete=""
                                            autofocus style="
                                            border-top: none;
                                            border-left: none;
                                            border-right: none;
                                            border-color: black;
                                            background-color: #F3F4F9;
                                            ">


                                            <span v-if="fperrorspassword !== 0" class="" style="color:red;" role="alert">
                                                <strong>@{{ fperrorspassword.password[0] }}</strong>
                                            </span>
                                    </div>

                            </div>

                            <!--Footer-->
                            <div class="modal-footer justify-content-center">


                                <input type="button" class="btn yk-btn-success w-100" value="Submit"
                                v-on:click="sendnewpasswordtoserver" style="
                                background-color: #780116!important;
                                color: white;
                                width: 100% !important;
                                border-radius: 10px;
                                height: 44px;
                                "/>

                                <br>
                                <br>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        <!-- forgotpassword Code end  -->


        </div>  <!--- Content End ----->

    </div>

</div>

@push('css')
    <style>
        /* .phone_start_number{
            position: absolute;
            top:0;
            left:0;
        } */
        form #togglePassword {
                position: absolute;
                top :20px;
                right: 10px;
                cursor: pointer;
        }

        .user-login-link-text{
            font-size: 15px !important;
        }
        .tz-parent{
            background-image: url("{{ asset('images/login_cover.jpg')}}");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            object-fit: cover;
            background-size: 100%;
            opacity: 1 !important;
            background-size: cover;
        }
        .tz-parent .modal button:hover{
          background: transparent !important;

        }
        .sop-resend-otp{
            border-radius: 10px!important;
            min-width: 100px;
        }
        .sop-resend-otp:hover, .sop-resend-otp:focus{
            background: transparent !important;
            color: #780116!important;
            border: solid 1px #780116;
        }
        .sop-submit-otp{
            color: #780116!important;
            border: solid 1px #780116;
            min-width: 100px;
        }
        .login-select-logo{
            width: 100px;

        }
        .tz-parent .modal-close{
            position: absolute !important;
            right: 0;
            top:0;
            background-color: transparent !important;
            color: #ffffff !important;
            letter-spacing: 3px;
        }

        .fa-xmark{
            transition: transform 0.3s ease-out;
        }

        .modal-close:hover .fa-xmark{
        transform: rotate(90deg);
        }

        .tz-modal-notify{
            bottom: 0px !important;
        }

        .tz-parent .modal-content{
            margin-top: 10em;
            background: transparent !important;

        }

        .tz-parent .modal-header.select-login-header{
            background-color: transparent !important;
            color: #ffffff;
        }
        .tz-parent .modal-header.select-login-header h3{
            font-weight: 900;
        }

        .tz-parent .select-login-btn-height{
            height: 170px;
            cursor: pointer;
        }

        .tz-parent .custom-rounded-left{
            background-color: rgb(120, 1, 22);
            border-radius: 6px 0px 0px 6px;
        }
        .tz-parent .custom-rounded-right{
            background-color: rgb(106, 192, 254);
            border-radius: 0px 6px 6px 0px;
        }

        .tz-parent .userLogin{
            font-size: 20px;
            font-weight: 1000;

        }

        .tz-parent .user{
            transition: transform 0.3s ease-in;
        }

        .tz-parent .userLogin:hover .user{
            transform: scale(1.09);
        }

        .tz-parent .shopLogin{
            font-size: 20px;
            font-weight: 1000;
            transition: transform 0.2s ease-in;

        }

        .tz-parent .shopowner{
            transition: transform 0.2s ease-in;
        }

        .tz-parent .shopLogin:hover .shopowner{
            transform: scale(1.09);
        }


        .tz-parent .modal-header.user-login-header{
            background-color:#fff;

        }

        .tz-parent .modal-body.user-login-body{
            background-color: #fff;
        }

        .tz-parent .modal-header.request-name-header{
            background-color:#fff;

        }

        .tz-parent .modal-body.request-name-body{
            background-color: #fff;
        }

        .tz-parent .modal-header.register-header{
            background-color:#fff;

        }

        .tz-parent .modal-body.register-body{
            background-color: #fff;
        }

        .tz-parent .modal-header.header3{
            background-color:#fff;

        }
        .tz-parent .modal-body.body-3{
            background-color: #fff;
        }



        .tz-parent .modal-header.header4{
            background-color:#fff;

        }
        #codecheckforreg{
            background-color: #fff;
        }

        .tz-parent .modal-header.header5{
            background-color:#fff;

        }

        .forgotpassword{
            background-color: #fff;
        }

        .confirm{
            background-color: #fff;
        }



        /* tz section end */

        .sop-lr-h{
            margin: 0;
            display: flex;
            align-items: center;
            font-size: 26px;
            font-family: sans-serif;
            font-weight: 800;
            color: rgb(120, 1, 22) !important;
        }
        .sop-lr-in{
            border:2px solid #8080807b!important;
            background-color: #F3F4F9;
            border-radius: 10px!important;
        }
        .sop-lr-l{
            color: #808080!important;
            font-weight: 600!important;
        }
        .sop-lr-rf{
            font-family: sans-serif!important;
            font-weight: 600!important;
            color: #808080!important;
            font-size: 0.9em;
            cursor: pointer;
        }
        .tz-parent .modal-footer{
            border:none!important;
        }
        .zh-eye-picon:hover button i{
            color: black;

        }
        .zh-eye-picon:focus button i{
            color: black;

        }
        .zh-eye-picon:hover button i{
            transform: scale(1)
        }
        .zh-eye-picon button i{
            display:flex;
            color:#808080;
            transform: scale(0.9);


        }
        .zh-eye-picon{
            bottom: 0;
        }
        .sop .is-invalid{
            border-color: #dc3545!important;
            padding-right: none!important;
            background-image: none!important;
            background: none!important;
            background-repeat: no-repeat;
            background-position: none;
            background-size: none;
        }
        .tz-parent .tz-btn{
                background-color: #780116!important;
                color: #ffffff;
                /* width: 100% !important; */
                border-radius: 10px;
                height: 44px;
                margin-left: 10px;
        }
        .zh-eye-picon{
                height: 50px;
                top: 0;
            }
        @media only screen and (max-width: 1396px){
            .zh-eye-picon{
                height: 38px;
            }

            .login-select-logo{
                width: 60px;
            }

            .select-login-title h3{
                font-weight: 500;
            }

            .user i{
                font-size: 20px !important;
            }

            .shopowner i{
                font-size: 20px !important;
            }

            .select-login-btn-height{
                height: 100px;
                margin-bottom: 0.5em;
            }

            .mobile-padding-login-btn{
                padding: 0px 30px 0px 30px;
            }

             .modal-backdrop {
                /* background-image: url("{{ asset('images/login-cover-mobile.jpg')}}") !important; */
                background-image: url("{{ asset('images/login_cover.jpg')}}")!important;;
                background-repeat: no-repeat;
                /* background-attachment: fixed; */
                background-position: 100%;
                background-size: 100% 100%;
                object-fit: cover;
                object-position: center;
                background-size: cover;
            }
        }




    </style>
@endpush
@push('scripts')
    <script>
        $(".sop-resend-otp").hide();
        function toggleEye(e){
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
                } else {
                    x.type = "password";
                }
                $(e).toggleClass('fas fa-eye-slash fas fa-eye');
        }

        $(document).ready(function () {
            $(".select-login-header").hide();
            $(".register-header").hide();
            $(".user-login-header").show();
            $(".request-name-header").hide();
            $(".header3").hide();
            $(".header4").hide();
            $(".header5").hide();

            $(".select-login-body").hide();
            $(".user-login-body").show();
            $(".body-3").hide();
            $(".register-body").hide();
            $("#codecheckforreg").hide();
            $(".forgotpassword").hide();
            $(".request-name-body").hide();


            $(".forgotpasswordbutton").click(function () {
                $(".select-login-header").hide();
                $(".user-login-header").hide();
                $(".header3").hide();
                $(".header4").hide();
                $(".header5").show();
                $(".forgotpassword").show();


                $(".select-login-body").hide();
                $(".user-login-body").hide();
                $(".body-3").hide();
                $(".modal-dialog").css({"bottom": "-10%"});
                $("#codecheckforreg").hide();

            });

            $(".checkForm").click(function () {
                //header
                $(".select-login-header").show();
                $(".user-login-header").hide();
                $(".register-header").hide();
                $(".header3").hide();
                $(".header4").hide();
                $(".header5").hide();
                $(".request-name-header").hide();
                //body
                $(".select-login-body").show();
                $(".user-login-body").hide();
                $(".body-3").hide();
                $(".register-body").hide();
                $("#codecheckforreg").hide();
                $(".forgotpassword").hide();
                $(".request-name-body").hide();
                $(".modal-dialog").css({"bottom": "0%"});
            });

            $(".shopLogin").click(()=>{
                $(".header3").fadeIn();
                $(".user-login-header").hide();
                $(".select-login-header").hide();
                $(".header5").hide();

                //body
                $(".user-login-body").hide();
                $(".select-login-body").hide();
                $(".body-3").fadeIn();
                $("#codecheckforreg").hide();
                $(".forgotpassword").hide();
                $(".modal-dialog").css({"bottom": "0%"});

            });

            $(".userLogin").click(function () {
                $(".user-login-header").fadeIn();
                $(".select-login-header").hide();
                $(".register-header").hide();
                $(".header3").hide();
                $(".request-name-header").hide();
                //body
                $(".user-login-body").fadeIn();
                $(".select-login-body").hide();
                $(".body-3").hide();
                $(".register-body").hide();
                $(".forgotpassword").hide();
                $(".modal-dialog").css({"bottom": "-10%"});
                $("#codecheckforreg").hide();
                $(".request-name-body").hide();

            });

            $(".userRegister").click(function () {
                $(".user-login-header").hide();
                $(".select-login-header").hide();
                $(".header3").hide();
                $(".register-header").fadeIn();

                //body
                $(".register-body").fadeIn();
                $(".user-login-body").hide();
                $(".select-login-body").hide();
                $(".body-3").hide();
                $(".forgotpassword").hide();
                $(".modal-dialog").css({"bottom": "-10%"});
                $("#codecheckforreg").hide();

            });

            $("#checkcodereg").click(function () {
                    var regdata = JSON.parse(localStorage.getItem('forreg'));
                    regdata.code = $("#regotpcode").val();
                    regdata.frombuynow = $('#loginbeforebuynow').val();
                    regdata.frommessenger = $('#loginbeforemessenger').val();
                    regdata.frompayment = $('#loginbeforepayment').val();
                    //if user not enter code in input box
                    if (regdata.code == '') {
                        $("#regerrorcode").html("<strong style='color:red'>Code Require<strong>");

                    } else {
                        axios.post(`{!! url('checkcodereg') !!}`, regdata).then(response => {
                            if (response.data == 'Invalid Code') {
                                $("#regerrorcode").html("<strong style='color:red'>" + response.data + "<strong>");

                            } else {
                                if(response.data.data == true){
                                    $(".header4").hide();
                                    $("#codecheckforreg").hide();
                                    $(".request-name-header").fadeIn();
                                    $(".request-name-body").fadeIn();
                                }else{
                                    location.assign(window.location.href);
                                }

                            }

                        });

                    }


                    // console.log(regdata);

                }
            );


            $("#sentName").click(()=>{
                var regdata = JSON.parse(localStorage.getItem('forreg'));
                regdata.name = $("#requestName").val();

                axios.post(`{!! url('updatename') !!}`,
                    regdata
                ).then(response => {

                            if (response.data == 'Invalid Code') {
                                $("#regerrorcode").html("<strong style='color:red'>" + response.data + "<strong>");

                            } else {
                               location.assign(window.location.href);
                            }

                        })
            });

            $(".zh_select").click(function () {
                $(".chose_one").attr('selected', true);

            });

            //error section

            `@if(Session::has('error'))`
                $('#orangeModalSubscription').modal('show');
                $(".user-login-header").hide();
                $(".user-login-body").hide();
                $(".header3").fadeIn();
                $(".body-3").fadeIn();
            `@endif`
        });

        //Login
        $("#login").click(function () {
            axios.post(`{!! url('checkvalidate') !!}`, {
              'phone': $("#phoneNumber").val(),
            }).then(response => {
                if(response.data.code != 'empty'){
                    $('#regotpcode').val(response.data.code);
                }
                console.log(response.data)
                if (response.data.phone != undefined ) {
                        $(".user-login-header").show();
                        $(".user-login-body").show();
                        $(".header4").hide();
                        $("#phoneNumber").addClass('is-invalid');
                        $(".error_login_phone").removeClass('d-none');
                        if($(".error_login_phone").children().is('strong') == true ){
                            $(".error_login_phone").children().remove('strong');
                            $(".error_login_phone").wrapInner('<strong>' + response.data.phone[0] + '<strong>');
                        }else{
                            $(".error_login_phone").wrapInner('<strong>' + response.data.phone[0] + '<strong>');
                       }
                }
                if (response.data.success === false ) {
                        $(".user-login-header").show();
                        $(".user-login-body").show();
                        $(".header4").hide();
                        $("#phoneNumber").addClass('is-invalid');
                        $(".error_login_phone").removeClass('d-none');
                        if($(".error_login_phone").children().is('strong') == true ){
                            $(".error_login_phone").children().remove('strong');
                            $(".error_login_phone").wrapInner('<strong>ဖုန်းနံပါတ်သည် အကောင့်ဖွင့်ထားခြင်းမရှိပါ<strong>');
                        }else{
                            $(".error_login_phone").wrapInner('<strong>ဖုန်းနံပါတ်သည် အကောင့်ဖွင့်ထားခြင်းမရှိပါ<strong>');
                      }
                }
                if (response.data['status'] == 'success') {
                    // $('#regbutton').addClass('disabled');
                    $(".user-login-header").hide();
                    $(".user-login-body").hide();
                    $(".header4").fadeIn();
                    $("#codecheckforreg").fadeIn();
                    localStorage.setItem('forreg', JSON.stringify(response.data['data']));

                    waitingSecond();
                } else {
                    console.log(response.data['status']);
                }
            });

        });

        //Register
        $("#register").click(function () {
            axios.post(`{!! url('checkvalidateregister') !!}`, {
                'name': $("#userName").val(),
                'phone': $("#regPhoneNumber").val(),
                }).then(response => {
                    // console.log(response.data)
                    if (response.data.name != undefined ) {
                            $("register-header").show();
                            $("register-body").show();
                            $(".header4").hide();
                            $("#userName").addClass('is-invalid');
                            $(".error_name").removeClass('d-none');

                            if($(".error_name").children().is('strong') == true ){
                                $(".error_name").children().remove('strong');
                                $(".error_name").wrapInner('<strong>' + response.data.name[0] + '<strong>');
                            }else{
                                $(".error_name").wrapInner('<strong>' + response.data.name[0] + '<strong>');
                        }

                    }
                    if (response.data.phone != undefined ) {
                            $("register-header").show();
                            $("register-body").show();
                            $(".header4").hide();
                            $("#regPhoneNumber").addClass('is-invalid');
                            $(".error_phone").removeClass('d-none');

                            if($(".error_phone").children().is('strong') == true ){
                                $(".error_phone").children().remove('strong');
                                $(".error_phone").wrapInner('<strong>' + response.data.phone[0] + '<strong>');
                            }else{
                                $(".error_phone").wrapInner('<strong>' + response.data.phone[0] + '<strong>');
                        }

                    }
                    if (response.data['status'] == 'success') {
                        // $('#login').addClass('disabled');
                        $(".register-header").hide();
                        $(".register-body").hide();
                        $(".header4").fadeIn();
                        $("#codecheckforreg").fadeIn();

                        localStorage.setItem('forreg', JSON.stringify(response.data['data']));

                        waitingSecond();

                    } else {
                        console.log(response.data['status']);
                    }

                });
        });

        $("#resendCode").click(()=>{
            $(".sop-resend-otp").addClass('disabled')
            setTimeout(()=>{$(".sop-resend-otp").removeClass('disabled')},8000);
            userLogin();
        });

        function waitingSecond(){
            const timeS = document.querySelector("#time");
                let timeSecond = 60;
                timeS.innerHTML = timeSecond;

                const countDown = setInterval(()=>{
                    timeSecond--;
                    timeS.innerHTML = timeSecond;
                    if(timeSecond <= 0 || timeSecond < 1){
                        clearInterval(countDown);
                    }

                },1000);
                $(".sop-resend-otp").removeClass('disabled')
                setTimeout(()=>{ $(".sop-resend-otp").fadeIn();},10 * 1000);
        }
        
        // for Help & Support shop Owner Login 
        
        $(".onlyShopownerForm").click(function(){
                            //header
              $(".select-login-header").hide();
                $(".user-login-header").hide();
                $(".register-header").hide();
                $(".header3").show();
                $(".header4").hide();
                $(".header5").hide();
                $(".request-name-header").hide();
                //body
                $(".select-login-body").hide();
                $(".user-login-body").hide();
                $(".body-3").show();
                $(".register-body").hide();
                $("#codecheckforreg").hide();
                $(".forgotpassword").hide();
                $(".request-name-body").hide();
                $(".modal-dialog").css({"bottom": "0%"});
        });
    </script>
@endpush
