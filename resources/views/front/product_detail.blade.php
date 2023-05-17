@extends('layouts.frontend.frontend')
@section('content')
    @include('layouts.frontend.allpart.for_mobile')
    @include('layouts.frontend.allpart.upper_menu')
    @include('layouts.frontend.allpart.menu')

    <div id="page" class="site container-fluid my-0 py-0">


    {{--MENU--}}

    {{-- end Menu--}}
    <!-- .site-content-contain -->


        <div class="site-content-contain sn-site-content">

        </div>

        <!-- .site-content-contain -->
        <div class="site-content-contain">

            <div class="mx-4 px-md-5 show_breadcrumb_">



                <div class="row">
                    <div id="main-content" class="show_dev col-sm-9 col-xs-12 d-none">

                        {{-- for photo slide and tilte--}}
                        <div id=""
                             class="row product type-product post-553 status-publish first instock product_cat-accessories product_cat-bracelet product_cat-brand product_cat-earrings product_cat-fragrances product_cat-gift-for-men has-post-thumbnail shipping-taxable purchasable product-type-simple ">
                            @if($item->check_discount != 'no')
                                <?php
                                $get_dis = \App\discount::where('id', $item->check_discount)->first();
                                ?>
                                {{-- <h3 class="product_title entry-title yk-jello-horizontal sn-discount-badge">
                                    {{$get_dis->percent}}% <span class="sn-off-text">OFF</span></h3> --}}
                            @endif

                                <div class="details-img col-12 col-md-6 col-xl-4">
                                    @if($item->check_discount != '0')
                                        <div id="mainCarousel" class="carousel w-10/12 max-w-5xl mx-auto">
                                            @if($item->default_photo != '')

                                                <div class="carousel__slide "
                                                     data-src="{{url('images/items/'.$item->default_photo)}}"
                                                     data-fancybox="group"
                                                >

                                                    <div class="sop-ribbon-pd ">
                                                        <span>-{{$get_dis->percent}}%</span>
                                                    </div>
                                                    @if(file_exists(public_path('/images/items/mid/'.$item->default_photo)))

                                                        <img
                                                            class="yk-product-image" id="zoom_07"
                                                            src="{{url('images/items/mid/'.$item->default_photo)}}"/>
                                                    @else
                                                        <img
                                                            class="yk-product-image" id="zoom_07"
                                                            src="{{url('images/items/'.$item->default_photo)}}"/>
                                                    @endif
                                                    <div class="yk-photozoom-text">Click Photo to zoom</div>

                                                </div>
                                            @endif
                                            @if($item->photo_one != '' && $item->photo_one != $item->default_photo)
                                                <div
                                                    class="carousel__slide "
                                                    data-src="{{url('images/items/'.$item->photo_one)}}"
                                                    data-fancybox="group"
                                                >
                                                    <div class="sop-ribbon-pd ">
                                                        <span>-{{$get_dis->percent}}%</span>
                                                    </div>
                                                    @if(file_exists(public_path('/images/items/mid/'.$item->photo_one)))

                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/mid/'.$item->photo_one)}}"/>
                                                    @else
                                                        <img
                                                            class="yk-product-image" id="zoom_07"
                                                            src="{{url('images/items/'.$item->photo_one)}}"/>
                                                    @endif
                                                    <div class="yk-photozoom-text">Click Photo to zoom</div>

                                                </div>

                                            @endif

                                            @if($item->photo_two != '' && $item->photo_two != $item->default_photo)
                                                <div
                                                    class="carousel__slide "
                                                    data-src="{{url('images/items/'.$item->photo_two)}}"
                                                    data-fancybox="group"
                                                >
                                                    <div class="sop-ribbon-pd ">
                                                        <span>-{{$get_dis->percent}}%</span>
                                                    </div>
                                                    @if(file_exists(public_path('/images/items/mid/'.$item->photo_two)))

                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/mid/'.$item->photo_two)}}"/>
                                                    @else
                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/'.$item->photo_two)}}"/>
                                                    @endif

                                                    <div class="yk-photozoom-text">Click Photo to zoom</div>

                                                </div>
                                            @endif
                                            @if($item->photo_three != '' && $item->photo_three != $item->default_photo)
                                                <div
                                                    class="carousel__slide "
                                                    data-src="{{url('images/items/'.$item->photo_three)}}"
                                                    data-fancybox="group"
                                                >
                                                    <div class="sop-ribbon-pd ">
                                                        <span>-{{$get_dis->percent}}%</span>
                                                    </div>
                                                    @if(file_exists(public_path('/images/items/mid/'.$item->photo_three)))

                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/mid/'.$item->photo_three)}}"/>
                                                    @else

                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/'.$item->photo_three)}}"/>
                                                    @endif
                                                    <div class="yk-photozoom-text">Click Photo to zoom</div>

                                                </div>
                                            @endif
                                            @if($item->photo_four != '' && $item->photo_four != $item->default_photo)
                                                <div
                                                    class="carousel__slide "
                                                    data-src="{{url('images/items/'.$item->photo_four)}}"
                                                    data-fancybox="group"
                                                >
                                                    <div class="sop-ribbon-pd ">
                                                        <span>-{{$get_dis->percent}}%</span>
                                                    </div>
                                                    @if(file_exists(public_path('/images/items/mid/'.$item->photo_four)))

                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/mid/'.$item->photo_four)}}"/>
                                                    @else
                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/'.$item->photo_four)}}"/>

                                                    @endif
                                                    <div class="yk-photozoom-text">Click Photo to zoom</div>

                                                </div>
                                            @endif
                                            @if($item->photo_five != '' && $item->photo_five != $item->default_photo)
                                                <div
                                                    class="carousel__slide "
                                                    data-src="{{url('images/items/'.$item->photo_five)}}"
                                                    data-fancybox="group"
                                                >
                                                    <div class="sop-ribbon-pd ">
                                                        <span>-{{$get_dis->percent}}%</span>
                                                    </div>
                                                    @if(file_exists(public_path('/images/items/mid/'.$item->photo_five)))

                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/mid/'.$item->photo_five)}}"/>
                                                    @else
                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/'.$item->photo_five)}}"/>
                                                    @endif
                                                    <div class="yk-photozoom-text">Click Photo to zoom</div>

                                                </div>
                                            @endif
                                            @if($item->photo_six != '' && $item->photo_six != $item->default_photo)
                                                <div
                                                    class="carousel__slide "
                                                    data-src="{{url('images/items/'.$item->photo_six)}}"
                                                    data-fancybox="group"
                                                >
                                                    <div class="sop-ribbon-pd ">
                                                        <span>-{{'images/items/mid/'.$get_dis->percent}}%</span>
                                                    </div>
                                                    @if(file_exists(public_path('/images/items/mid/'.$item->photo_six)))

                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/mid/'.$item->photo_six)}}"/>
                                                    @else
                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/'.$item->photo_six)}}"/>
                                                    @endif
                                                    <div class="yk-photozoom-text">Click Photo to zoom</div>

                                                </div>
                                            @endif
                                            @if($item->photo_seven != '' && $item->photo_seven != $item->default_photo)
                                                <div
                                                    class="carousel__slide "
                                                    data-src="{{url('images/items/'.$item->photo_seven)}}"
                                                    data-fancybox="group"
                                                >
                                                    <div class="sop-ribbon-pd ">
                                                        <span>-{{$get_dis->percent}}%</span>
                                                    </div>
                                                    @if(file_exists(public_path('/images/items/mid/'.$item->photo_seven)))

                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/mid/'.$item->photo_seven)}}"/>
                                                    @else
                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/'.$item->photo_seven)}}"/>
                                                    @endif
                                                    <div class="yk-photozoom-text">Click Photo to zoom</div>

                                                </div>
                                            @endif
                                            @if($item->photo_eight != '' && $item->photo_eight != $item->default_photo)
                                                <div
                                                    class="carousel__slide "
                                                    data-src="{{url('images/items/'.$item->photo_eight)}}"
                                                    data-fancybox="group"
                                                >
                                                    <div class="sop-ribbon-pd ">
                                                        <span>-{{$get_dis->percent}}%</span>
                                                    </div>
                                                    @if(file_exists(public_path('/images/items/mid/'.$item->photo_eight)))

                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/mid/'.$item->photo_eight)}}"/>
                                                    @else
                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/'.$item->photo_eight)}}"/>
                                                    @endif
                                                    <div class="yk-photozoom-text">Click Photo to zoom</div>

                                                </div>
                                            @endif
                                            @if($item->photo_nine != '' && $item->photo_nine != $item->default_photo)
                                                <div
                                                    class="carousel__slide "
                                                    data-src="{{url('images/items/'.$item->photo_nine)}}"
                                                    data-fancybox="group"
                                                >
                                                    <div class="sop-ribbon-pd ">
                                                        <span>-{{$get_dis->percent}}%</span>
                                                    </div>
                                                    @if(file_exists(public_path('/images/items/mid/'.$item->photo_nine)))

                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/mid/'.$item->photo_nine)}}"/>
                                                    @else
                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/'.$item->photo_nine)}}"/>
                                                    @endif

                                                    <div class="yk-photozoom-text">Click Photo to zoom</div>

                                                </div>
                                            @endif
                                            @if($item->photo_ten != '' && $item->photo_ten != $item->default_photo)
                                                <div
                                                    class="carousel__slide "
                                                    data-src="{{url('images/items/'.$item->photo_ten)}}"
                                                    data-fancybox="group"
                                                >
                                                    <div class="sop-ribbon-pd ">
                                                        <span>-{{$get_dis->percent}}%</span>
                                                    </div>
                                                    @if(file_exists(public_path('/images/items/mid/'.$item->photo_ten)))

                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/mid/'.$item->photo_ten)}}"/>
                                                    @else
                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/'.$item->photo_ten)}}"/>
                                                    @endif
                                                    <div class="yk-photozoom-text">Click Photo to zoom</div>

                                                </div>

                                            @endif


                                        </div>
                                    @else
                                        <div id="mainCarousel" class="carousel w-10/12 max-w-5xl mx-auto">
                                            @if($item->default_photo != '')

                                                <div class="carousel__slide "
                                                     data-src="{{url('images/items/'.$item->default_photo)}}"
                                                     data-fancybox="group"
                                                >


                                                    @if(file_exists(public_path('/images/items/mid/'.$item->default_photo)))

                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/mid/'.$item->default_photo)}}"/>
                                                    @else
                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/'.$item->default_photo)}}"/>
                                                    @endif
                                                    <div class="yk-photozoom-text">Click Photo to zoom</div>

                                                </div>
                                            @endif

                                            @if($item->photo_one != '' && $item->photo_one != $item->default_photo)
                                                <div
                                                    class="carousel__slide "
                                                    data-src="{{url('images/items/'.$item->photo_one)}}"
                                                    data-fancybox="group"
                                                >

                                                    @if(file_exists(public_path('/images/items/mid/'.$item->photo_one)))

                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/mid/'.$item->photo_one)}}"/>
                                                    @else
                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/'.$item->photo_one)}}"/>
                                                    @endif
                                                    <div class="yk-photozoom-text">Click Photo to zoom</div>

                                                </div>

                                            @endif

                                            @if($item->photo_two != '' && $item->photo_two != $item->default_photo)

                                                <div
                                                    class="carousel__slide "
                                                    data-src="{{url('images/items/'.$item->photo_two)}}"
                                                    data-fancybox="group"
                                                >


                                                    @if(file_exists(public_path('/images/items/mid/'.$item->photo_two)))

                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/mid/'.$item->photo_two)}}"/>
                                                    @else
                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/'.$item->photo_two)}}"/>
                                                    @endif
                                                    <div class="yk-photozoom-text">Click Photo to zoom</div>

                                                </div>
                                            @endif
                                            @if($item->photo_three != '' && $item->photo_three != $item->default_photo)
                                                <div
                                                    class="carousel__slide "
                                                    data-src="{{url('images/items/'.$item->photo_three)}}"
                                                    data-fancybox="group"
                                                >

                                                    @if(file_exists(public_path('/images/items/mid/'.$item->photo_three)))

                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/mid/'.$item->photo_three)}}"/>
                                                    @else
                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/'.$item->photo_three)}}"/>
                                                    @endif
                                                    <div class="yk-photozoom-text">Click Photo to zoom</div>

                                                </div>
                                            @endif
                                            @if($item->photo_four != '' && $item->photo_four != $item->default_photo)
                                                <div
                                                    class="carousel__slide "
                                                    data-src="{{url('images/items/'.$item->photo_four)}}"
                                                    data-fancybox="group"
                                                >

                                                    @if(file_exists(public_path('/images/items/mid/'.$item->photo_four)))

                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/mid/'.$item->photo_four)}}"/>
                                                    @else
                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/'.$item->photo_four)}}"/>
                                                    @endif
                                                    <div class="yk-photozoom-text">Click Photo to zoom</div>

                                                </div>
                                            @endif
                                            @if($item->photo_five != '' && $item->photo_five != $item->default_photo)
                                                <div
                                                    class="carousel__slide "
                                                    data-src="{{url('images/items/'.$item->photo_five)}}"
                                                    data-fancybox="group"
                                                >

                                                    @if(file_exists(public_path('/images/items/mid/'.$item->photo_five)))

                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/mid/'.$item->photo_five)}}"/>
                                                    @else
                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/'.$item->photo_five)}}"/>
                                                    @endif
                                                    <div class="yk-photozoom-text">Click Photo to zoom</div>

                                                </div>
                                            @endif
                                            @if($item->photo_six != '' && $item->photo_six != $item->default_photo)
                                                <div
                                                    class="carousel__slide "
                                                    data-src="{{url('images/items/'.$item->photo_six)}}"
                                                    data-fancybox="group"
                                                >

                                                    @if(file_exists(public_path('/images/items/mid/'.$item->photo_six)))

                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/mid/'.$item->photo_six)}}"/>
                                                    @else
                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/'.$item->photo_six)}}"/>
                                                    @endif
                                                    <div class="yk-photozoom-text">Click Photo to zoom</div>

                                                </div>
                                            @endif
                                            @if($item->photo_seven != '' && $item->photo_seven != $item->default_photo)
                                                <div
                                                    class="carousel__slide "
                                                    data-src="{{url('images/items/'.$item->photo_seven)}}"
                                                    data-fancybox="group"
                                                >

                                                    @if(file_exists(public_path('/images/items/mid/'.$item->photo_seven)))

                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/mid/'.$item->photo_seven)}}"/>
                                                    @else
                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/'.$item->photo_seven)}}"/>
                                                    @endif
                                                    <div class="yk-photozoom-text">Click Photo to zoom</div>

                                                </div>
                                            @endif
                                            @if($item->photo_eight != '' && $item->photo_eight != $item->default_photo)
                                                <div
                                                    class="carousel__slide "
                                                    data-src="{{url('images/items/'.$item->photo_eight)}}"
                                                    data-fancybox="group"
                                                >

                                                    @if(file_exists(public_path('/images/items/mid/'.$item->photo_eight)))

                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/mid/'.$item->photo_eight)}}"/>
                                                    @else
                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/'.$item->photo_eight)}}"/>
                                                    @endif
                                                    <div class="yk-photozoom-text">Click Photo to zoom</div>

                                                </div>
                                            @endif
                                            @if($item->photo_nine != '' && $item->photo_nine != $item->default_photo)
                                                <div
                                                    class="carousel__slide "
                                                    data-src="{{url('images/items/'.$item->photo_nine)}}"
                                                    data-fancybox="group"
                                                >

                                                    @if(file_exists(public_path('/images/items/mid/'.$item->photo_nine)))

                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/mid/'.$item->photo_nine)}}"/>
                                                    @else
                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/'.$item->photo_nine)}}"/>
                                                    @endif
                                                    <div class="yk-photozoom-text">Click Photo to zoom</div>

                                                </div>
                                            @endif
                                            @if($item->photo_ten != '' && $item->photo_ten != $item->default_photo)
                                                <div
                                                    class="carousel__slide "
                                                    data-src="{{url('images/items/'.$item->photo_ten)}}"
                                                    data-fancybox="group"
                                                >

                                                    @if(file_exists(public_path('/images/items/mid/'.$item->photo_ten)))

                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/mid/'.$item->photo_ten)}}"/>
                                                    @else
                                                        <img class="yk-product-image" id="zoom_07"
                                                             src="{{url('images/items/'.$item->photo_ten)}}"/>
                                                    @endif
                                                    <div class="yk-photozoom-text">Click Photo to zoom</div>

                                                </div>

                                            @endif


                                        </div>
                                    @endif

                                    <div id="thumbCarousel" class="carousel max-w-xl mx-auto">
                                        @if($item->default_photo != '')
                                            @if(file_exists(public_path('/images/items/thumbs/'.$item->default_photo)))
                                                <div class="carousel__slide">
                                                    <img class="" src="{{url('images/items/thumbs/'.$item->default_photo)}}"/>
                                                </div>
                                            @else
                                                <div class="carousel__slide">
                                                    <img class="" src="{{url('images/items/'.$item->default_photo)}}"/>

                                                </div>
                                            @endif

                                        @endif
                                        @if($item->photo_one != '' && $item->photo_one != $item->default_photo)
                                            @if(file_exists(public_path('/images/items/thumbs/'.$item->photo_one)))
                                                <div class="carousel__slide">
                                                    <img class="" src="{{url('images/items/thumbs/'.$item->photo_one)}}"/>
                                                </div>
                                            @else
                                                <div class="carousel__slide">
                                                    <img class="" src="{{url('images/items/'.$item->photo_one)}}"/>

                                                </div>
                                            @endif
                                        @endif
                                        @if($item->photo_two != '' && $item->photo_two != $item->default_photo)
                                            @if(file_exists(public_path('/images/items/thumbs/'.$item->photo_two)))
                                                <div class="carousel__slide">
                                                    <img class="" src="{{url('images/items/thumbs/'.$item->photo_two)}}"/>
                                                </div>
                                            @else
                                                <div class="carousel__slide">
                                                    <img class="" src="{{url('images/items/'.$item->photo_two)}}"/>

                                                </div>
                                            @endif
                                        @endif
                                        @if($item->photo_three != '' && $item->photo_three != $item->default_photo)
                                            @if(file_exists(public_path('/images/items/thumbs/'.$item->photo_three)))
                                                <div class="carousel__slide">
                                                    <img class="" src="{{url('images/items/thumbs/'.$item->photo_three)}}"/>
                                                </div>
                                            @else
                                                <div class="carousel__slide">
                                                    <img class="" src="{{url('images/items/'.$item->photo_three)}}"/>

                                                </div>
                                            @endif
                                        @endif
                                        @if($item->photo_four != '' && $item->photo_four != $item->default_photo)
                                            @if(file_exists(public_path('/images/items/thumbs/'.$item->photo_four)))
                                                <div class="carousel__slide">
                                                    <img class="" src="{{url('images/items/thumbs/'.$item->photo_four)}}"/>
                                                </div>
                                            @else
                                                <div class="carousel__slide">
                                                    <img class="" src="{{url('images/items/'.$item->photo_four)}}"/>

                                                </div>
                                            @endif
                                        @endif
                                        @if($item->photo_five != '' && $item->photo_five != $item->default_photo)
                                            @if(file_exists(public_path('/images/items/thumbs/'.$item->photo_five)))
                                                <div class="carousel__slide">
                                                    <img class="" src="{{url('images/items/thumbs/'.$item->photo_five)}}"/>
                                                </div>
                                            @else
                                                <div class="carousel__slide">
                                                    <img class="" src="{{url('images/items/'.$item->photo_five)}}"/>

                                                </div>
                                            @endif
                                        @endif
                                        @if($item->photo_six != '' && $item->photo_six != $item->default_photo)
                                            @if(file_exists(public_path('/images/items/thumbs/'.$item->photo_six)))
                                                <div class="carousel__slide">
                                                    <img class="" src="{{url('images/items/thumbs/'.$item->photo_six)}}"/>
                                                </div>
                                            @else
                                                <div class="carousel__slide">
                                                    <img class="" src="{{url('images/items/'.$item->photo_six)}}"/>

                                                </div>
                                            @endif
                                        @endif
                                        @if($item->photo_seven != '' && $item->photo_seven != $item->default_photo)
                                            @if(file_exists(public_path('/images/items/thumbs/'.$item->photo_seven)))
                                                <div class="carousel__slide">
                                                    <img class="" src="{{url('images/items/thumbs/'.$item->photo_seven)}}"/>
                                                </div>
                                            @else
                                                <div class="carousel__slide">
                                                    <img class="" src="{{url('images/items/'.$item->photo_seven)}}"/>

                                                </div>
                                            @endif
                                        @endif
                                        @if($item->photo_eight != '' && $item->photo_eight != $item->default_photo)
                                            @if(file_exists(public_path('/images/items/thumbs/'.$item->photo_eight)))
                                                <div class="carousel__slide">
                                                    <img class="" src="{{url('images/items/thumbs/'.$item->photo_eight)}}"/>
                                                </div>
                                            @else
                                                <div class="carousel__slide">
                                                    <img class="" src="{{url('images/items/'.$item->photo_eight)}}"/>

                                                </div>
                                            @endif
                                        @endif
                                        @if($item->photo_nine != '' && $item->photo_nine != $item->default_photo)
                                            @if(file_exists(public_path('/images/items/thumbs/'.$item->photo_nine)))
                                                <div class="carousel__slide">
                                                    <img class="" src="{{url('images/items/thumbs/'.$item->photo_nine)}}"/>
                                                </div>
                                            @else
                                                <div class="carousel__slide">
                                                    <img class="" src="{{url('images/items/'.$item->photo_nine)}}"/>

                                                </div>
                                            @endif
                                        @endif
                                        @if($item->photo_ten != '' && $item->photo_ten != $item->default_photo)
                                            @if(file_exists(public_path('/images/items/thumbs/'.$item->photo_ten)))
                                                <div class="carousel__slide">
                                                    <img class="" src="{{url('images/items/thumbs/'.$item->photo_ten)}}"/>
                                                </div>
                                            @else
                                                <div class="carousel__slide">
                                                    <img class="" src="{{url('images/items/'.$item->photo_ten)}}"/>

                                                </div>
                                            @endif
                                        @endif

                                    </div>

                                </div>


                            <div class="summary entry-summary col-12 col-md-6">
                                <div class="row">
                                    <div class="col-12">
                                        <!-- zh view count -->
                                        <div class="d-flex">
                                            <div class="marginleft">
                                                <span  class="sop-font">Uploaded on</span>
                                                <span class="grey">{{ Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</span>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-8">


                                        <p class="price">

                                            @if($item->check_discount != '0')
                                                @if($item->price != 0)
                                                    <span class="woocommerce-Price-amount amount sn-origin-amount"><bdi
                                                        class="mprice"
                                                        >Ks {{number_format($item->price)}}</bdi>
                                                </span>
                                                @else
                                                    <span class="woocommerce-Price-amount amount sn-origin-amount"><bdi
                                                        class="mprice"
                                                        >Ks {{number_format($item->min_price)}}-{{number_format($item->max_price)}}</bdi>
                                                </span>
                                                @endif
                                                @if($get_dis->discount_price != 0)
                                                    <span
                                                        class="woocommerce-Price-amount amount yk-amount sn-discount-amount"><bdi
                                                            class=""><span
                                                                class="woocommerce-Price-currencySymbol"></span>Ks {{number_format($get_dis->discount_price)}}</bdi>
                                                </span>
                                                @else
                                                    <span class="woocommerce-Price-amount amount yk-amount"><bdi
                                                            class=""><span
                                                                class="woocommerce-Price-currencySymbol"></span>Ks
                                                    {{number_format($get_dis->discount_min)}}-{{number_format($get_dis->discount_max)}} </bdi>
                                                </span>

                                                @endif
                                            @else
                                                @if($item->price != 0)
                                                    <span class="woocommerce-Price-amount amount yk-amount"><bdi
                                                            class=""><span
                                                                class="woocommerce-Price-currencySymbol"></span>Ks  {{number_format($item->price)}} </bdi>
                                                </span>
                                                @else
                                                    <span class="woocommerce-Price-amount amount yk-amount"><bdi
                                                            ><span
                                                                class="woocommerce-Price-currencySymbol"></span>Ks {{number_format($item->min_price)}}-{{number_format($item->max_price)}}</bdi>
                                                </span>
                                                @endif
                                            @endif
                                        </p>
                                        <h1 class="product_title entry-title sn-product-title sop-font">{{$item->name}}
                                            <span
                                                class="zh-pc"> ({{$item->product_code}})</span></h1>

                                    </div>
                                    @if($item->check_discount != 0)
                                        <div class="col-4 d-flex justify-content-end ">
                                            @if (isset(Auth::guard('web')->user()->id) || isset(Auth::guard('shop_owner')->user()->id) || isset(Auth::guard('shop_role')->user()->id))
                                                <div onclick="asywhisclick('{{$item->id}}')" id="fav"
                                                     class="sop-product-d-p c-pointer d-flex flex-column justify-content-start align-items-center h-100"
                                                     >

                                                    <div>
                                                        <i id="icon" class="zh-icon fa-regular fa-heart fa-2xl"
                                                           ></i>
                                                    </div>
                                                    <div class="pt-2">
                                                        <p class="sop-font">ကြိုက်တယ်</p>
                                                    </div>
                                                </div>
                                            @else
                                                <div onclick="asywhisclick('{{$item->id}}')" id="fav-disc">

                                                    <div id="fav"
                                                         class="sop-product-d-p c-pointer d-flex flex-column justify-content-start align-items-center h-100"
                                                         >

                                                        <div>
                                                            <i id="icon" class="zh-icon fa-regular fa-heart fa-2xl"
                                                               ></i>
                                                        </div>
                                                        <div class="pt-2">
                                                            <p  class="sop-font">ကြိုက်တယ်</p>
                                                        </div>
                                                    </div>

                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <div onclick="asywhisclick('{{$item->id}}')"
                                             class="col-4 d-flex justify-content-end ">
                                            @if (isset(Auth::guard('web')->user()->id) || isset(Auth::guard('shop_owner')->user()->id) || isset(Auth::guard('shop_role')->user()->id))
                                                <div id="fav"
                                                     class=" d-flex flex-column c-pointer justify-content-start align-items-center h-100">
                                                    <div>
                                                        <i id="icon" class="zh-icon fa-regular fa-heart fa-2xl"
                                                           ></i>
                                                    </div>
                                                    <div class="pt-2">
                                                        <p  class="sop-font">ကြိုက်တယ်</p>
                                                    </div>
                                                </div>
                                            @else
                                                <div onclick="asywhisclick('{{$item->id}}')" id="fav-no-disc">

                                                    <div id="fav"
                                                         class=" d-flex flex-column c-pointer justify-content-start align-items-center h-100">
                                                        <div>
                                                            <i id="icon" class="zh-icon fa-regular fa-heart fa-2xl"
                                                               ></i>
                                                        </div>
                                                        <div class="pt-2">
                                                            <p  class="sop-font">ကြိုက်တယ်</p>
                                                        </div>
                                                    </div>

                                                </div>
                                            @endif
                                        </div>
                                    @endif

                                    <div class="col-12">
                                        <!-- zh view count -->
                                        <div class="d-flex">
                                            <div>
                                                <i class="fa fa-user userstyle" ></i><span class="leftgrey">{{$item->yk_view}}</span>
                                                <span  class="sop-font">ကြည့်ရူသူ</span>
                                            </div>
                                            <div id="vf-count">

                                            </div>


                                        </div>

                                        @if($item->stock == 'In Stock')

                                            <p class="availability stock in-stock sn-product-instock">
                                                <span>In Stock {{$item->stock_count}}</span></p>
                                        @else
                                            <p class="availability stock in-stock sn-product-outstock"
                                               >
                                                <span>Out Of Stock</span>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                @if(strlen($item->description) < 220)
                                    <readmore-detail longdesc="{{$item->description}}" noti="0" class="sop-font"
                                                     shortdesc="{{\Illuminate\Support\Str::limit($item->description, 220, '...')}}"></readmore-detail>
                                @else
                                    <readmore-detail class="sop-font" class="sn-product-des"
                                                     longdesc="{{$item->description}}" noti="1"
                                                     shortdesc="{{\Illuminate\Support\Str::limit($item->description, 220, '...')}}"></readmore-detail>
                                @endif
                                <div class="sn-product-detail">

                                    <div class="row">

                                        <div class="col-10 sn-accordion">
                                            <div class="sn-accordion-item">
                                                <input type="checkbox" class="sn-accordion-checkbox" checked>
                                                <i class="sn-accordion-arrow"></i>

                                                <h1 class="product_title entry-title sn-accordion-title sop-font"
                                                    >Product အချက်အလက်များ</h1>
                                                <div class="sku-wrapper product_meta sn-accordion-content">
                                                    <div class="zh-row row">
                                                        <div class="col-4">
                                                            <span
                                                                class="sn-detail-title font-red sop-font">ရတနာ အမျိုးအစား</span>
                                                        </div>
                                                        <div class="col-8">
                                                            <span class="sku sop-font"
                                                                  itemprop="sku">{{$item->MainCategoryName}}</span>
                                                        </div>
                                                    </div>

                                                    <div class="zh-row row">
                                                        <div class="col-4">
                                                                <span class="font-red sn-detail-title sop-font"

                                                                      >အလေးချိန်</span>


                                                        </div>
                                                        <div class="col-8">
                                                            <?php
                                                            $weight = json_decode($item->weight, true);
                                                            ?>
                                                            @foreach($weight as $w)
                                                                <span class="sku"
                                                                      itemprop="sku">{{$w['value']}} {{$w['name']}}</span>
                                                                ,
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                    <div class="zh-row row">
                                                        <div class="col-4">
                                                            <span
                                                                class="sn-detail-title font-red sop-font">အရည်အသွေး</span>
                                                        </div>
                                                        <div class="col-8">
                                                            <span class="sku sop-font"
                                                                  itemprop="sku">{{$item->gold_quality}}</span>
                                                        </div>
                                                    </div>
                                                    @if (!empty($item->size))
                                                        <div class="zh-row row">
                                                            <div class="col-4">
                                                            <span
                                                                class="sn-detail-title font-red sop-font">Size</span>
                                                            </div>
                                                            <div class="col-8">
                                                            <span class="sku sop-font"
                                                                  itemprop="sku">{{$item->size}}</span>
                                                            </div>
                                                        </div>

                                                    @endif
                                                    <div class="zh-row row">
                                                        <div class="col-4">
                                                            <span
                                                                class="sn-detail-title font-red sop-font">Category</span>
                                                        </div>
                                                        <div class="col-8">
                                                            <span class="sku sop-font"
                                                                  itemprop="sku">{{$item->YkbeautyCat}}</span>
                                                        </div>
                                                    </div>
                                                    @if ( $item->weight != "empty")
                                                        <div class="zh-row row">
                                                            <div class="col-4">
                                                            <span
                                                                class="sn-detail-title font-red sop-font">အလေးချိန်</span>
                                                            </div>
                                                            <div class="col-8">

                                                                @foreach (json_decode($item->weight) as $weight)
                                                                    <span class="sku sop-font"
                                                                          itemprop="sku">{{ $weight->value }}</span>
                                                                    <span class="sku sop-font"
                                                                          itemprop="sku">{{ $weight->name }}</span> ၊
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if($item->gems_data != 'empty')
                                                        <?php
                                                        $gems = json_decode($item->gems_data, true);
                                                        ?>
                                                        @if(!empty($gems))

                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <span
                                                                        class="sn-detail-title font-red sop-font">ပါဝင်ကျောက်</span>
                                                                </div>
                                                            </div>
                                                            <div class=" zh-row row ">
                                                                @foreach($gems as $g)

                                                                    <div class="col-4  pt-3">
                                                                        <span class="sku font-yellow sop-font"
                                                                              itemprop="sku">{{$g['name']}}
                                                                        </span>
                                                                    </div>
                                                                    <div class="col-8  pt-3">
                                                                        <span class="sku sop-font"
                                                                              itemprop="sku">
                                                                            {{'အရေအတွက်- '.$g['count']."လုံး"}}
                                                                            @if($g['carat'] != 0 ||  $g['yati'] != 0 || $g['pwint'] != 0 )
                                                                                <br/>@endif
                                                                            @if($g['carat'] != 0) {{'ကာရက်- '.$g['carat']}} @endif
                                                                            @if($g['yati'] != 0 || $g['pwint'] != 0 )
                                                                                <br/>@endif
                                                                            @if($g['yati'] != 0) {{'ရတီ- '.$g['yati']}} @endif
                                                                            @if($g['pwint'] != 0 )<br/>@endif
                                                                            {{-- @if($g['pwint'] != 0) {{'ပွင့်- '.$g['pwint']}} @endif
                                                                            @if($g['pwint'] != 0 )<br/>@endif --}}
                                                                            @if($g['pwint'] != 0) {{'ဘီ- '.$g['pwint']}} @endif</span><br>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @endif

                                                    @endif
                                                    <div class="zh-row row">
                                                        <div class="col-4">
                                                            <span
                                                                class="sn-detail-title font-red sop-font">အရောင်</span>
                                                        </div>
                                                        <div class="col-8">
                                                            <span class="sku sop-font"
                                                                  itemprop="sku">{{$item->gold_colour}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="zh-row row">
                                                        <div class="col-4">
                                                            <span class="sn-detail-title font-red sop-font">
                                                                အမျိုးအစား</span>
                                                        </div>
                                                        <div class="col-8 d-flex align-items-center">
                                                            @switch( $item->gender)
                                                                @case("Kid")
                                                                <i class="fa fa-child px-1 kid"></i>
                                                                <span class="sku sop-font"
                                                                      itemprop="sku">ကလေးဝတ်</span>
                                                                @break
                                                                @case("Couple")
                                                                <img src="{{ asset('images/icons/couple.png') }}"
                                                                     class="px-1 couple" alt=""
                                                                     >
                                                                <span class="sku sop-font"
                                                                      itemprop="sku">စုံတွဲဝတ်</span>
                                                                @break
                                                                @case("Women")
                                                                <i class="fa fa-venus px-1 women" aria-hidden="true"
                                                                   ></i>
                                                                <span class="sku sop-font"
                                                                      itemprop="sku">အမျိုးသမီးဝတ်</span>
                                                                @break
                                                                @case("Men")
                                                                <i class="fa fa-mars px-1 men" aria-hidden="true"
                                                                   ></i>
                                                                <span class="sku sop-font"
                                                                      itemprop="sku">အမျိုးသားဝတ်</span>
                                                                @break
                                                                @case("UniSex")
                                                                <i class="fa-solid fa-genderless px-1 unisex"
                                                                   aria-hidden="true"
                                                                   ></i>
                                                                <span class="sku sop-font"
                                                                      itemprop="sku">အားလုံးဝတ်</span>
                                                                @break
                                                                @default
                                                                <span></span>
                                                            @endswitch


                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-10 sn-accordion">
                                            <div class="sn-accordion-item">
                                                <input type="checkbox" class="sn-accordion-checkbox" checked>
                                                <i class="sn-accordion-arrow"></i>
                                                <h1 class="product_title entry-title sn-accordion-title sop-font">ဆိုင်
                                                    အချက်အလက်များ</h1>
                                                <div class="sku-wrapper product_meta sn-accordion-content" >
                                                    <div class="zh-row row ">
                                                        <div class="col-4 ">
                                                            <span
                                                                class="sn-detail-title font-red sop-font">ဆိုင်အမည်</span>
                                                        </div>
                                                        <div class="col-8 ">
                                                            <a class="sn-shop-link sop-font"
                                                               href="{{url('/'.$item->withoutspace_shopname)}}">
                                                                {{$item->shop_name->shop_name}}
                                                            </a>
                                                        </div>
                                                    </div>
                                                    @if(!empty($item->handmade))
                                                        <div class="zh-row row">

                                                            <div class="col-4 ">
                                                                <span class="sn-detail-title font-red sop-font">အလျော့တွက်</span>
                                                            </div>
                                                            <div class="col-8 ">
                                                            <span class="sku"
                                                                  itemprop="sku">{{$item->handmade}} </span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if(!empty($item->charge))
                                                        <div class="zh-row row">
                                                            <div class="col-4 ">
                                                                <span
                                                                    class="sn-detail-title font-red sop-font">လက်ခ</span>
                                                            </div>
                                                            <div class="col-8 ">
                                                          <span class="sku"
                                                                itemprop="sku">{{$item->charge}} </span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="zh-row row">
                                                        <div class="col-4 ">
                                                            <span
                                                                class="sn-detail-title font-red sop-font">အထည်မပျက်ပြန်သွင်း</span>
                                                        </div>
                                                        <div class="col-8 ">
                                                            <span class="sku sop-font"
                                                                  itemprop="sku">{{$item->အထည်မပျက်_ပြန်သွင်း}} </span>
                                                        </div>
                                                    </div>

                                                    <div class="zh-row row">
                                                        <div class="col-4 ">
                                                            <span
                                                                class="sn-detail-title font-red sop-font">အထည်ပျက်စီးချို့ယွင်း</span>
                                                        </div>
                                                        <div class="col-8 ">
                                                            <span class="sku sop-font"
                                                                  itemprop="sku">{{$item->အထည်ပျက်စီးချို့ယွင်း}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="zh-row row">
                                                        <div class="col-4 ">
                                                            <span class="sn-detail-title font-red sop-font">တန်ဖိုးမြင့်အထည်နှင့် အထည်မပျက်ပြန်လဲ</span>
                                                        </div>
                                                        <div class="col-8 ">
                                                            <span class="sku sop-font"
                                                                  itemprop="sku">{{  $item->တန်ဖိုးမြင့်အထည်_နှင့်_အထည်မပျက်ပြန်လဲ}} </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item_type" >


                                    @if(count($item->tags)!=0)
                                        <i class="fa-solid fa-tag fa-flip-horizontal"></i> ပစ္စည်းအမျိုးအစား :

                                        @foreach($item->tags as $itg)
                                            <a href="{{url('tags/'.$itg->name)}}"
                                               class="item_tag_name">{{$itg->name}}</a>
                                            @if ($loop->remaining !=0)
                                                ,
                                            @endif
                                        @endforeach
                                    @endif
                                </div>

                                <div class="row g-3 position-relative mt-3">
                                    {{--                                    <?php--}}
                                    {{--                                    $check_facebook_function = \App\sitesettings::where('name', 'facebook')->first();--}}
                                    {{--                                    $check_connect=\App\facebooktable::where('shop_id',$item->shop_id);--}}
                                    {{--                                    ?>--}}
                                    {{--                                    @if($check_facebook_function->action=='on' and ($check_connect->count() != 0) )--}}
                                    {{--                                        <div class="col-6">--}}
                                    {{--                                            <a onclick="buyNow('{{$item->id}}')" href= "{{'http://m.me/'.$check_connect->first()->page_id.'?ref='.$item->id}}"--}}
                                    {{--                                               class="btn btn-primary sn-buynow-button sop-font" target="_blank"--}}
                                    {{--                                               >ဝယ်မယ်</a>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        @else--}}
                                    {{--                                            <div class="col-6">--}}
                                    {{--                                                <a onclick="buyNow('{{$item->id}}')" href="{{$item->shop_name->messenger_link}}"--}}
                                    {{--                                                   class="btn btn-primary sn-buynow-button sop-font" target="_blank"--}}
                                    {{--                                                   >ဝယ်မယ်</a>--}}
                                    {{--                                            </div>--}}
                                    {{--                                    @endif--}}
                                    {{-- @if(\Illuminate\Support\Facades\Auth::guard('web')->check()) --}}
                                    @if($is_chat_on == 'on')

                                        <div id="chatWithUs" class="col-2 col-md-1 mt-3 mt-md-4 chat-with-us">
                                            <img src="{{ asset('images/icons/discuss-fill.png') }}" alt="Chat with Us">
                                        </div>

                                        <div id="chatWithUsContainer" class="position-absolute chat-with-us-container d-none">
                                          <div>
                                            <h2 class="px-3 mb-2 fbold" >Chat With</h2>
                                            <ul class="list-group">
                                              <li class="list-group-item list-group-item-action border-0 px-4 mb-2">
                                                <a
                                                  onclick="buyNow('{{$item->id}}')" id="buynowbutton"
                                                  class="d-flex align-items-center"
                                                  @click="buynowbuttonclick('{{\Illuminate\Support\Facades\Auth::guard('web')->check()}}','{{$item->shop_name->id}}',{{ $item }},'post','{{\Illuminate\Support\Facades\Auth::guard('web')->check() == 1 ? \Illuminate\Support\Facades\Auth::guard('web')->user()->username : '' }}',{{$item->shop_name}},'{{\Carbon\Carbon::now()}}')"
                                                >
                                                  <div style="width: 55px;">
                                                    <div class="ss-chat-wrapper">
                                                      <img src="{{ asset('test/img/logo-m.png') }}" alt="Chat with Us" style="width: 40px;">
                                                    </div>
                                                  </div>
                                                  <p class="mb-0 mt-1 fbold" >Shweshops Chat</p>
                                                </a>
                                              </li>
                                              <li class="list-group-item list-group-item-action border-0 px-4">
                                                <a href="#" class="d-flex align-items-center">
                                                  <div style="width: 55px;">
                                                    <img src="{{ asset('images/icons/messenger.png') }}" alt="Chat with Us" style="width: 32px; margin-left:2px;">
                                                  </div>
                                                  <p class="mb-0 mt-1" style="font-weight: 600;">Page Messenger</p>
                                                </a>
                                              </li>
                                            </ul>
                                          </div>
                                        </div>
                                        <div class="col-4 col-md-5">

                                            <a onclick="buyNow('{{$item->id}}')" id="buynowbutton"
                                               class="btn btn-primary sn-buynow-button sop-font reg"
                                               @click="buynowbuttonclick('{{\Illuminate\Support\Facades\Auth::guard('web')->check()}}','{{$item->shop_name->id}}',{{ $item }},'post','{{\Illuminate\Support\Facades\Auth::guard('web')->check() == 1 ? \Illuminate\Support\Facades\Auth::guard('web')->user()->username : '' }}',{{$item->shop_name}},'{{\Carbon\Carbon::now()}}')"

                                               target="_blank"
                                               >ဝယ်မယ်</a>
                                        </div>
                                    @endif


                                    @if(Session::get('clickbuynow'))
                                        <input id="buynowsession" type="hidden"
                                               value="{{ Session::get('clickbuynow') }}">
                                        @php
                                            Session::forget('clickbuynow');
                                        @endphp
                                    @endif
                                    {{\Illuminate\Support\Facades\Session::get('clickmessenger')}}

                                    @if(Session::get('clickmessenger'))
                                        <input id="clickmessenger" type="hidden"
                                               value="{{ Session::get('clickmessenger') }}">
                                        @php
                                            Session::forget('clickmessenger');
                                        @endphp
                                    @endif

                                    @if(Session::get('clickpayment'))

                                        <input id="clickpayment" type="text"
                                               value="{{ Session::get('clickpayment') }}">
                                        @php
                                            Session::forget('clickpayment');
                                        @endphp
                                    @endif

                                    <div class="col-6">
                                        @if (isset(Auth::guard('web')->user()->id) || isset(Auth::guard('shop_owner')->user()->id) || isset(Auth::guard('shop_role')->user()->id))

                                            <div onclick="addToCart('{{$item->id}}')" id="selection-div"
                                                 class="btn btn-primary zh-addtocart-button"
                                                 >
                                                <i id="selection-icon" class="fa-solid d-none fa-check"></i>
                                                <span id="selection" class="sop-font"> ဝယ်ဖို့ရွေးထားမယ်</span>
                                            </div>
                                        @else
                                            <div id="selectionNoAuth">
                                                <div onclick="addToCart('{{$item->id}}')" id="selection-div"
                                                     class="btn btn-primary zh-addtocart-button"
                                                     >
                                                    <i id="selection-icon" class="fa-solid d-none fa-check"></i>
                                                    <span id="selection" class="sop-font"> ဝယ်ဖို့ရွေးထားမယ်</span>
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                </div>

                                <div class="row g-3 mt-3">
                                    @if($is_fb_on == 'on')
                                        <div class="col-6">
                                            <?php
                                            $check_connect = \Illuminate\Support\Facades\DB::table('facebook')->where('shop_id', $item->shop_name->id)->first();
                                            ?>
                                            @if(!empty($check_connect))
                                                <a class="btn btn-info" id="fbbutton"
                                                   @click="messengerbuttonclick('{{\Illuminate\Support\Facades\Auth::guard('web')->check()}}','{{'http://m.me/'.$check_connect->page_id.'?ref='.$item->id}}')"
                                                   target="_blank"
                                                   >Facebook Messenger</a>
                                            @endif
                                        </div>
                                    @endif
                                    <div class="col-6">

                                        <a class="btn btn-info" id="paymentbtn"
                                           @click="paymentbuttonclick('{{\Illuminate\Support\Facades\Auth::guard('web')->check()}}','{{url('payment/order/'.$item->id)}}')"
                                           target="_blank"
                                           style="">
                                          Check Out
                                        </a>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pe-0 ps-2 px-md-4 mx-md-5">
        <div class="pe-0 ps-2 px-md-1">
            {{-- @if(!empty($sim_items) ) --}}
            @if (count($sim_items) != 0)

                {{--similar products--}}
                <div id="primary" class="site-content " >

                    {{--  product title--}}

                    <div
                        class="mt-3 mt-sm-4 elementor-element elementor-element-3205fef1 elementor-widget elementor-widget-heading mb-0"
                        >

                        <div class="elementor-widget-container">


                            <h3 class="elementor-heading-title elementor-size-default ps-2 sop-font"
                                >
                                <a class="sn-shop-link"
                                   href="{{url('/'.$item->WithoutspaceShopname)}}">{{$item->shop_name->shop_name}}</a>
                                မှဆင်တူ
                                <a class="sn-shop-link"
                                   href="{{ url($item->WithoutspaceShopname.'/similar_items/'.$item->category_id.'/'.$item->id.'/'.$item->shop_name->id) }}">{{$item->ykbeauty_cat}}
                                    များ</a>
                            </h3>

                        </div>

                    </div>
                    {{--  products list--}}
                    <div class="col-12 main-content">
                        <div id="similar_slide" class="owl-carousel owl-theme w-100 ">
                            @foreach($sim_items as $new_item)
                                @if($new_item->ykget_discount == '0')
                                    <div class="ftc-product product yk-product">

                                        <div class="images sop-font sop-img">
                                                    <span class=" fa fa-user yk-viewcount">
                                                        {{$new_item->yk_view}}
                                                    </span>


                                            <a href="{{url($new_item->WithoutspaceShopname.'/product_detail/'.$new_item->id)}}">
                                                <img class="sop-image-w-h" src="{{url($new_item->CheckPhoto)}}"
                                                     style="border-radius: 5px;"/>
                                            </a>


                                        </div>
                                        <div class="item-description">
                                                <span class="price">
                                                    <span class="woocommerce-Price-amount amount sop-amount"
                                                         >
                                                        <bdi>
                                                            {!! $new_item->mm_price !!}
                                                        </bdi>
                                                    </span>
                                                </span>

                                            <h3 class="product_title product-name"><a
                                                    href="{{url($new_item->WithoutspaceShopname.'/product_detail/'.$new_item->id)}}"
                                                    >{{\Illuminate\Support\Str::limit($new_item->name, 8, '...')}}</a>
                                            </h3>
                                        </div>
                                    </div>
                                @else

                                    <div class="ftc-product product yk-product">

                                        <div class="images sop-font sop-img">

                                            <span class=" fa fa-user yk-viewcount">
                                                        {{$new_item->yk_view}}
                                                    </span>

                                            <div class="sop-ribbon">
                                                <span>-{{$new_item->ykget_discount->percent}}%</span>
                                            </div>

                                            <a href="{{url($new_item->WithoutspaceShopname.'/product_detail/'.$new_item->id)}}">
                                                <img class="sop-image-w-h" src="{{url($new_item->CheckPhoto)}}"
                                                     style="border-radius: 5px;"/>
                                            </a>


                                        </div>
                                        <div class="item-description">
                                                <span class="price">
                                                    <span class="woocommerce-Price-amount amount sop-amount"
                                                         >
                                                        <bdi>
                                                            {!! $new_item->ykget_discount->mm_price !!}
                                                        </bdi>
                                                    </span>
                                                </span>

                                            <h3 class="product_title product-name"><a
                                                    href="{{url($new_item->WithoutspaceShopname.'/product_detail/'.$new_item->id)}}"
                                                    >{{\Illuminate\Support\Str::limit($new_item->name, 8, '...')}}</a>
                                            </h3>
                                        </div>
                                    </div>

                                @endif
                            @endforeach
                            @if (count($sim_items) >= 20)
                                <div class="sn-similar-seeall">
                                    <a href="{{ url($item->WithoutspaceShopname.'/similar_items/'.$item->category_id.'/'.$item->id.'/'.$item->shop_name->id) }}">
                                        <div>
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </div>
                                        <div class="see-all-text">See all</div>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
                {{--similar products--}}
            @endif
            {{-- @if(!empty($sim_items_othershops) ) --}}
            @if (count($sim_items_othershops) != 0)

                {{--similar products for other shops--}}
                <div id="primary" class="site-content mt-3">


                    {{--  product title--}}

                    <div
                        class=" mt-3 mt-sm-4 elementor-element elementor-element-3205fef1 elementor-widget elementor-widget-heading mb-0"
                        >
                        <div class="elementor-widget-container">


                            <h3 class="elementor-heading-title elementor-size-default ps-2 sop-font"
                                >တခြားဆိုင်များမှ ဆင်တူ <a class="sn-shop-link"
                                                                                               href="{{ url('/other_shops/similar_items/'.$item->category_id.'/'.$item->id.'/'.$item->shop_name->id) }}">{{$item->ykbeauty_cat}}
                                    များ</a>
                            </h3>

                        </div>

                    </div>
                    {{--  products list--}}


                    <div class="col-12 main-content">
                        <!-- zh-modify -->
                        <div id="pd-discount_slide" class="owl-carousel owl-theme w-100 ">
                            @foreach($sim_items_othershops as $new_item)
                                @if($new_item->ykget_discount == '0')
                                    <div class="ftc-product product yk-product">

                                        <div class="images sop-font sop-img">
                                            <div class="yk-hover-title sop-rounded-top text-capitalize text-left g-0"
                                                 style="width:100% !important;">
                                                <img
                                                    src="{{url('images/logo/thumbs/'.$new_item->shop_name->shop_logo)}}"
                                                    class="yk-hover-logo float-left"/>
                                                <span>
                                                {{\Illuminate\Support\Str::limit($new_item->shop_name->shop_name, 15, '...')}}
                                            </span>
                                            </div>

                                            <span class=" fa fa-user yk-viewcount">
                                                        {{$new_item->yk_view}}
                                                    </span>


                                            <a href="{{url($new_item->WithoutspaceShopname.'/product_detail/'.$new_item->id)}}">
                                                <img class="sop-image-w-h" src="{{url($new_item->CheckPhoto)}}"
                                                     style="border-radius: 5px;"/>
                                            </a>


                                        </div>
                                        <div class="item-description">
                                                <span class="price">
                                                    <span class="woocommerce-Price-amount amount sop-amount"
                                                         >
                                                        <bdi>
                                                            {!! $new_item->mm_price !!}
                                                        </bdi>
                                                    </span>
                                                </span>

                                            <h3 class="product_title product-name"><a
                                                    href="{{url($new_item->WithoutspaceShopname.'/product_detail/'.$new_item->id)}}"
                                                    >{{\Illuminate\Support\Str::limit($new_item->name, 8, '...')}}</a>
                                            </h3>
                                        </div>
                                    </div>
                                @else
                                    <div class="ftc-product product yk-product">

                                        <div class="images sop-font sop-img">
                                            <div class="yk-hover-title sop-rounded-top text-capitalize text-left g-0"
                                                 style="width:100% !important;">
                                                <img
                                                    src="{{url('images/logo/thumbs/'.$new_item->shop_name->shop_logo)}}"
                                                    class="yk-hover-logo float-left"/>
                                                <span>
                                                {{\Illuminate\Support\Str::limit($new_item->shop_name->shop_name, 15, '...')}}
                                            </span>
                                            </div>

                                            <span class=" fa fa-user yk-viewcount">
                                                        {{$new_item->yk_view}}
                                                    </span>
                                            <div class="sop-ribbon">
                                                <span>-{{$new_item->ykget_discount->percent}}%</span>
                                            </div>

                                            <a href="{{url($new_item->WithoutspaceShopname.'/product_detail/'.$new_item->id)}}">
                                                <img class="sop-image-w-h" src="{{url($new_item->CheckPhoto)}}"
                                                     style="border-radius: 5px;"/>
                                            </a>


                                        </div>
                                        <div class="item-description">
                                                <span class="price">
                                                    <span class="woocommerce-Price-amount amount sop-amount"
                                                         >
                                                        <bdi>
                                                            {!! $new_item->ykget_discount->mm_price !!}
                                                        </bdi>
                                                    </span>
                                                </span>

                                            <h3 class="product_title product-name"><a
                                                    href="{{url($new_item->WithoutspaceShopname.'/product_detail/'.$new_item->id)}}"
                                                    >{{\Illuminate\Support\Str::limit($new_item->name, 8, '...')}}</a>
                                            </h3>
                                        </div>
                                    </div>

                                @endif
                            @endforeach
                            @if (count($sim_items_othershops) >= 20)
                                <div class="sn-similar-seeall sop-font">
                                    <a href="{{ url('/other_shops/similar_items/'.$item->category_id.'/'.$item->id.'/'.$item->shop_name->id) }}">
                                        <div>
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </div>
                                        <div class="see-all-text">See all</div>
                                    </a>
                                </div>
                            @endif
                        </div>

                    </div>


                </div>

                {{--similar products for other shops--}}
            @endif
        </div>

    </div>
    <div class="pt-5">
        @include('layouts.frontend.allpart.footer')
    </div>
    <div class="ftc-close-popup"></div>

    @include('layouts.frontend.allpart.mobile_footer')

    <div id="to-top" class="scroll-button">
        <a class="" onclick="scrollToTop()" title="Back to Top">Back to Top</a>
    </div>
<script>
    if (document.getElementById('clickpayment') != null) {

        if (document.getElementById('clickpayment').value == 'click') {

            location.assign('{{url('payment/order/'.$item->id)}}');
        }
    }
</script>




@endsection
@push('custom-scripts')
    <script>

        $(document).ready(function () {

            if (document.getElementById('buynowsession') != null) {
                document.getElementById('buynowbutton').click();
            }
            if (document.getElementById('clickmessenger') != null) {

                if (document.getElementById('clickmessenger').value == 'click') {
                    document.getElementById('fbbutton').click();
                }
            }



        });
        var busy = false;

        async function asywhisclick(id) {
            if (!busy) {
                busy = true;
                const result = await whislist(id);
                busy = false;

            }

            if (`{{Auth::guard('web')->check()}}`) {
                $.ajax({
                    method: "POST",
                    url: "{{route('backside.user.whilist.point')}}",
                    cache: false,
                    dataType: "json",
                    data: {
                        _token: '{{csrf_token()}}',
                        p_id: id,
                    },

                    success: function (response) {
                        console.log(response['data'])

                    },
                });
            }

        }

        // zh buynow log
        function buyNow(id) {
            if (`{{Auth::guard('web')->check()}}`) {
                $.ajax({
                    method: "POST",
                    url: "{{route('backside.user.buy_now.point')}}",
                    cache: false,
                    dataType: "json",
                    data: {
                        _token: '{{csrf_token()}}',
                        m_id: id,
                    },

                    success: function (response) {
                        console.log(response['data'])

                    },
                });
            }
            $.ajax({
                method: "Get",
                url: "{{ route('buynow') }}",
                cache: false,
                dataType: "json",
                data: {
                    id: id,
                },
                success: function (data) {

                },
                error: function (err) {
                    console.log(err);
                }

            })
        }

        //zh add to cart log
        function addToCart(id) {
            if (`{{Auth::guard('web')->check()}}`) {
                $.ajax({
                    method: "POST",
                    url: "{{route('backside.user.addtocart.point')}}",
                    cache: false,
                    dataType: "json",
                    data: {
                        _token: '{{csrf_token()}}',
                        add_id: id,
                    },

                    success: function (response) {
                        console.log(response['data'])

                    },
                });
            }
            $.ajax({
                method: "Get",
                url: "{{ route('addtocartclick') }}",
                cache: false,
                dataType: "json",
                data: {
                    id: id,
                },
                success: function (data) {

                },
                error: function (err) {
                    console.log(err);
                }

            });

        }


        // zh whislist log
        function whislist(id) {
            return new Promise(resolve => {
                $.ajax({
                    method: "post",
                    url: "{{ route('whislistclick') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    cache: false,
                    dataType: "json",
                    data: {
                        id: id,
                    },
                    success: function (data) {
                        resolve('success');

                    },
                    error: function (err) {
                        console.log(err);
                    }

                });

            })

        }


        // Initialise Carousel
        const mainCarousel = new Carousel(document.querySelector("#mainCarousel"), {
            Dots: false,
        });

        // Thumbnails
        const thumbCarousel = new Carousel(document.querySelector("#thumbCarousel"), {
            Sync: {
                target: mainCarousel,
                friction: 0,
            },
            Dots: false,
            Navigation: false,
            center: true,
            slidesPerPage: 1,
            infinite: false,
        });

        // Customize Fancybox
        Fancybox.bind('[data-fancybox="gallery"]', {
            Carousel: {
                on: {
                    change: (that) => {
                        mainCarousel.slideTo(mainCarousel.findPageForSlide(that.page), {
                            friction: 0,
                        });
                    },
                },
            },
        });

        function ifChosenFav() {
            var favourited = JSON.parse(window.localStorage.getItem("fav"));
            console.log("favCheck", favourited)
            if (favourited != null && favourited[{!! json_encode($item->id) !!}] != null) {
                $("#icon").toggleClass("fa-regular fa-solid")
                $("#icon2").toggleClass("fa-regular fa-solid")
                return
            }
        }

        function ifChosenSelection() {

            var selection = JSON.parse(window.localStorage.getItem("selection"));
            console.log("selectionCheck", selection)

            if (selection != null && selection[{!! json_encode($item->id) !!}] != null) {
                $("#selection-icon").removeClass("d-none");
                $("#selection").text("ဝယ်ဖို့ရွေးပြီးပြီ");
                $("#selection-icon2").removeClass("d-none");
                $("#selection2").text("ဝယ်ဖို့ရွေးပြီးပြီ");
                return
            }
        }

        function favCount() {
            let favourited = {!! json_encode($fav_total_count) !!}
                let
            favCount = favourited;
            if (favCount != null) {
                $("#vf-count").html(`<i class=" fa fa-heart" style="
                                            margin-bottom: 20px;
                                            margin-top: 12px;
                                            margin-left: 11px;
                                            color: grey;
                                            text-color: grey;
                                        "></i><span id="fav-count"
                                                    style="
                                                    margin-left: 3px;
                                                    color: grey;
                                                "></span>
                                        <span  class="sop-font">ကြိုက်နှစ်သက်မူ</span>`);
                $("#fav-count").html(favCount);
                return
            }
        }

        function authAndFavCount() {
            let favourited = JSON.parse(window.localStorage.getItem("fav"));
            let favLocalCount = 0;
            if (favourited != null) {
                favLocalCount = Object.keys(favourited).length;
            }
            if (favLocalCount >= 3) {
                $("#fav-disc").html(`<a href="" title="Login" data-toggle="modal" data-target="#orangeModalSubscription">
                                                        <div id="fav"
                                                            class="sop-product-d-p c-pointer d-flex flex-column justify-content-start align-items-center h-100"
                                                            >

                                                            <div>
                                                                <i id="icon2" class="zh-icon fa-regular fa-heart fa-2xl"
                                                                ></i>
                                                            </div>
                                                            <div class="pt-2">
                                                                <p  class="sop-font">ကြိုက်တယ်</p>
                                                            </div>
                                                        </div>
                                                    </a>`)
                $("#fav-no-disc").html(`<a href="" title="Login" data-toggle="modal" data-target="#orangeModalSubscription">
                                                        <div id="fav"
                                                            class=" d-flex flex-column c-pointer justify-content-start align-items-center h-100">
                                                            <div>
                                                                <i id="icon2" class="zh-icon fa-regular fa-heart fa-2xl"
                                                                ></i>
                                                            </div>
                                                            <div class="pt-2">
                                                                <p  class="sop-font">ကြိုက်တယ်</p>
                                                            </div>
                                                        </div>
                                                    </a>`)
            } else {
                return
            }

        }

        function authAndSelectionCount() {
            let selected = JSON.parse(window.localStorage.getItem("selection"));
            let selectedLocalCount = 0;
            if (selected != null) {
                selectedLocalCount = Object.keys(selected).length;
            }

            if (selectedLocalCount >= 3) {
                $("#selectionNoAuth").html(`<a href="" title="Login" data-toggle="modal" data-target="#orangeModalSubscription">
                    <div id="selection-div" class="btn btn-primary zh-addtocart-button" >
                                                    <i id="selection-icon2" class="fa-solid d-none fa-check"></i>
                                                    <span id="selection2" class="sop-font"> ဝယ်ဖို့ရွေးထားမယ်</span>
                                                </div>
                                                    </a>`)
            }
            return
        }

        $(document).ready(function () {

            authAndFavCount();
            authAndSelectionCount();

            ifChosenFav();
            ifChosenSelection();
            favCount();
            ifChosenSelectionLength();
            // ifChosenSelectionLengthM();
            ifChosenFavLength();

        });

        jQuery(function ($) {

            // Chat With Us
            $('#chatWithUs').click(function () {
                $("#chatWithUsContainer").toggleClass('d-none');
            });


            $("#fav").click(function () {

                let fav = {
                    {!! json_encode($item->id) !!}: {!! json_encode($item->toArray()) !!}
                };

                const oldFav = JSON.parse(window.localStorage.getItem("fav") || "{}");

                let setData = function () {


                    if (oldFav === null || oldFav == "{}") {
                        newFav = fav;
                    } else {
                        newFav = Object.assign(oldFav, fav);
                    }

                    localStorage.setItem("fav", JSON.stringify(newFav));


                    document.getElementById('fav-count').innerHTML = parseInt(document.getElementById('fav-count').innerHTML) + 1;
                    // document.getElementById('favw-a2c-count').innerHTML = parseInt(document.getElementById('favw-a2c-count').innerHTML) + 1;
                    // document.getElementById('favm-a2c-count').innerHTML = parseInt(document.getElementById('favm-a2c-count').innerHTML) + 1;
                    if ($("#mobileFootHeart").hasClass("fa-regular")) {
                        $("#mobileFootHeart").removeClass("fa-regular").addClass("fa-solid");
                    }
                    $("#mobileFootHeart").removeClass("op-100");
                    $("#mobileFootHeart").width();
                    $("#mobileFootHeart").addClass("op-100");

                    if ($("#windowFavNav").hasClass("fa-regular")) {
                        $("#windowFavNav").removeClass("fa-regular").addClass("fa-solid");
                    }
                    $("#windowFavNav").removeClass("op-100");
                    $("#windowFavNav").width();
                    $("#windowFavNav").addClass("op-100");
                }


                let deleteData = function () {
                    if (oldFav.hasOwnProperty({!! json_encode($item->id) !!})) {
                        delete oldFav[{!! json_encode($item->id) !!}];
                        localStorage.fav = JSON.stringify(oldFav);
                        if (document.getElementById('fav-count').innerHTML > 0) {
                            document.getElementById('fav-count').innerHTML = parseInt(document.getElementById('fav-count').innerHTML) - 1;
                        }
                        // document.getElementById('favw-a2c-count').innerHTML = parseInt(document.getElementById('favw-a2c-count').innerHTML) - 1;
                        // document.getElementById('favm-a2c-count').innerHTML = parseInt(document.getElementById('favm-a2c-count').innerHTML) - 1;
                        // if (document.getElementById('fav-count').innerHTML == 0) {
                        //     $("#vf-count").html("");
                        // }

                        if (Object.keys(oldFav).length == 0) {

                            $("#mobileFootHeart").removeClass("fa-solid").addClass("fa-regular");

                        }
                        $("#mobileFootHeart").removeClass("op-100");
                        $("#mobileFootHeart").width();
                        $("#mobileFootHeart").addClass("op-100");

                        if (Object.keys(oldFav).length == 0) {

                            $("#windowFavNav").removeClass("fa-solid").addClass("fa-regular");

                        }
                        $("#windowFavNav").removeClass("op-100");
                        $("#windowFavNav").width();
                        $("#windowFavNav").addClass("op-100");
                    }

                }

                $("#icon").toggleClass("fa-regular fa-solid")
                $("#icon").hasClass('fa-solid')
                    ? setData()
                    : deleteData();

                let newFavSync = window.localStorage.getItem("fav") != null ? Object.keys(JSON.parse(window.localStorage.getItem("fav"))) : [];

                @if (isset(Auth::guard('web')->user()->id))
                let userType = "Users"
                @elseif(isset(Auth::guard('shop_owner')->user()->id))
                let userType = "Shop_owners"
                @elseif(isset(Auth::guard('shop_role')->user()->id))
                let userType = "Manager"
                @endif

                @if (isset(Auth::guard('web')->user()->id) || isset(Auth::guard('shop_owner')->user()->id) || isset(Auth::guard('shop_role')->user()->id))
                localStorage.setItem("favID", JSON.stringify(newFavSync));
                $.ajax({
                    url: "{{url('/myfav/update')}}",
                    type: "post",
                    data: {
                        users: userType,
                        newFav: newFavSync,
                        id: userID.id,
                        _token: _token,
                    },
                    success: function (response) {
                        console.log(response)
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
                @endif
            });

            $("#selection-div").click(function () {


                if ($("#selection").html() != "ဝယ်ဖို့ရွေးပြီးပြီ") {
                    $("#selection-icon").removeClass("d-none");
                    $("#selection").html("ဝယ်ဖို့ရွေးပြီးပြီ");
                } else {
                    $("#selection-icon").addClass("d-none");
                    $("#selection").html("ဝယ်ဖို့ရွေးထားမယ်");
                }

                let selection = {
                    {!! json_encode($item->id) !!}: {!! json_encode($item->toArray()) !!}
                };

                const oldSelection = JSON.parse(window.localStorage.getItem("selection") || "{}");

                let setData = function () {


                    if (oldSelection === null || oldSelection == "{}") {
                        newselection = selection;
                    } else {
                        newselection = Object.assign(oldSelection, selection);
                    }
                    localStorage.setItem("selection", JSON.stringify(newselection));
                    document.getElementById('temp').innerHTML = parseInt(document.getElementById('temp').innerHTML) + 1;
                    // document.getElementById('nav-a2c-count').innerHTML = parseInt(document.getElementById('nav-a2c-count').innerHTML) + 1;
                    document.getElementById('navw-a2c-count').innerHTML = parseInt(document.getElementById('navw-a2c-count').innerHTML) + 1;
                    if ($("#mobile-a2c-icon").hasClass("op-50")) {
                        $("#mobile-a2c-icon").removeClass("op-50").addClass("op-100")

                    } else {
                        $("#mobile-a2c-icon").removeClass("op-100")
                        $("#mobile-a2c-icon").width();
                        $("#mobile-a2c-icon").addClass("op-100")
                        $("#windowA2cNav").removeClass("op-100")
                        $("#windowA2cNav").width();
                        $("#windowA2cNav").addClass("op-100")
                    }
                    return
                }


                let deleteData = function () {
                    if (oldSelection.hasOwnProperty({!! json_encode($item->id) !!})) {
                        delete oldSelection[{!! json_encode($item->id) !!}];
                        localStorage.selection = JSON.stringify(oldSelection);
                        document.getElementById('temp').innerHTML = parseInt(document.getElementById('temp').innerHTML) - 1;
                        // document.getElementById('nav-a2c-count').innerHTML = parseInt(document.getElementById('nav-a2c-count').innerHTML) - 1;
                        document.getElementById('navw-a2c-count').innerHTML = parseInt(document.getElementById('navw-a2c-count').innerHTML) - 1;

                        const updateSelection = JSON.parse(window.localStorage.getItem("selection") || "{}");
                        if (Object.keys(updateSelection).length == 0) {

                            $("#mobile-a2c-icon").removeClass("op-100").addClass("op-50")

                        } else {
                            $("#mobile-a2c-icon").removeClass("op-100")
                            $("#mobile-a2c-icon").width();
                            $("#mobile-a2c-icon").addClass("op-100")
                            $("#windowA2cNav").removeClass("op-100")
                            $("#windowA2cNav").width();
                            $("#windowA2cNav").addClass("op-100")
                        }
                    }
                    return
                }
                $("#selection").text() == "ဝယ်ဖို့ရွေးပြီးပြီ"
                    ? setData()
                    : deleteData();
                let newSelectionSync = window.localStorage.getItem("selection") != null ? Object.keys(JSON.parse(window.localStorage.getItem("selection"))) : [];
                @if (isset(Auth::guard('web')->user()->id) || isset(Auth::guard('shop_owner')->user()->id) || isset(Auth::guard('shop_role')->user()->id))
                localStorage.setItem("selectionID", JSON.stringify(newSelectionSync));
                $.ajax({
                    url: "{{url('/addtocart/update')}}",
                    type: "post",
                    data: {
                        users: userType,
                        newSelection: newSelectionSync,
                        id: userID.id,
                        _token: _token,
                    },
                    success: function (response) {
                        console.log(response)
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
                @endif

            });

            $('#button_slide_collection').owlCarousel({
                loop: false,
                margin: 29,
                responsiveClass: true,
                autoplay: false,
                dots: false,
                autoplayTimeout: 6000,
                autoplayHoverPause: true,
                nav: false,

                responsive: {

                    0: {
                        items: 2,
                        stagePadding: 25,
                    },
                    600: {
                        items: 3,
                    },
                    900: {
                        items: 4,
                    },
                    1200: {
                        items: 5,
                    },
                    1400: {
                        items: 6,
                    }
                }
            });

        });
    </script>



@endpush
@push('css')
    <style>
        .remove_wrapp{
            height: 822px !important;
            position:relative !important;
        }
        .summary{
            padding-right: 0;
        }
        .marginleft{
            margin-left: 10px;
        }
        .mprice{
            text-decoration: line-through !important;
        }
        .zh-icon{
           color: rgb(120, 1, 22) !important;
        }
        .sop-font .zh-p .grey{
            color: grey;
        }
        .userstyle{

            margin-bottom: 20px;
            margin-top: 12px;
            margin-left: 11px;
            color: grey;
            text-color: grey;
        }
        .leftgrey{
            margin-left: 5px;
            color: grey;
        }
        .product_title{
            text-transform: none!important;
        }
        .sn-product-outstock{
            color:red !important;
        }
        .kid{
            font-size:22px;
        }
        .couple{
            height:22px; color:#d80007;
        }
        .women{
            font-size:22px; color:#F7BEC0;
        }
        .men{
            font-size:22px; color:#2E8BC0;
        }
        .unisex{
            font-size:22px; color:#000000;
        }
        .elementor-size-default .product-name .size-content .elementor-widget-heading{
            border-bottom: 2px solid #a0793614;
        }
        .item_type{
            margin: 0 10px;
            font-weight:400;
        }
        .item_tag_name{
            color:#780116 !important;
            text-decoration: underline!important;
        }
        .fbold{
           font-weight: bold;
        }
        .zh-addtocart-button{
            color:white !important;
        }
        .yk-product{
           border: 0px !important;
        }
        .sop-amount{
            font-weight: 600!important;
        }

        .sop-ribbon-pd span {
            width: 136px;
            height: 30px;
            top: 13px;
            right: -46px;
            position: absolute;
            display: block;
            background: #FF0000;
            color: #333;
            font-family: arial;
            font-size: 14px;
            color: white;
            text-align: center;
            line-height: 30px;
            transform: rotate(
                45deg
            );
            -webkit-transform: rotate(52deg);
        }

        .sop-ribbon-pd {
            height: 110px;
            display: block;
            position: absolute;
            overflow: hidden;
            z-index: 111;
            top: 0;
            right: 0;
        }

        .ss-chat-wrapper {
            background: #780116;
            width: 35px;
            height: 35px;
            padding: 3px;
            border-radius: 50%;
        }

        .chat-with-us img:hover {
            cursor: pointer;
        }

        .chat-with-us-container {
            background: #ffffff;
            bottom: 70px;
            z-index: 999;
            border: 1px solid #c1c1c1;
            box-shadow: 0px 0px 5px 0px #dbdbdb;
            border-radius: 20px;
            padding: 25px 0;
        }

        .chat-with-us-container ul li:hover {
            background: #efefef;
            cursor: pointer;
        }

        .sn-buynow-button {
            /* zh-modify */
            background: #fff !important;
            border-radius: 5px !important;
            border-color: #780116 !important;
            width: 100% !important;
            color: #780116 !important;
            font-size: 18px !important;
            padding: 7px 0 !important;
            /*font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;*/
            font-weight: 500 !important;
        }

        .sn-buynow-button:HOVER {
            background: #f3f3f3b9 !important;
        }

        .zh-addtocart-button {
            background: #780116 !important;
            border-radius: 5px !important;
            border-color: #780116 !important;
            width: 100% !important;
            color: rgba(247, 181, 56, 1) !important;
            font-size: 18px !important;
            padding: 7px 0 !important;
            /*font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;*/
            font-weight: 500 !important;
        }

        .sop-product-image-d {
            width: 100% !important;

            aspect-ratio: 3/2;
            vertical-align: inherit !important;
        }
    </style>
@endpush

