<x-wrappercomponent div-id="preminumwrap" toshow-id="preminum"></x-wrappercomponent>

{{-- shop slide--}}
<div id="preminum" class="col-12 d-none show_dev">
    <div id="primary2" class="sop-font px-md-3">
        {{--  product title--}}
        <div class="mt-4 elementor-element elementor-element-3205fef1 elementor-widget elementor-widget-heading px-4 px-md-5">
            <div class="elementor-widget-container d-flex justify-content-between">
                <h3 class="elementor-heading-title elementor-size-default" style="font-family: sans-serif!important">Our Premium Shops</h3>
            </div>
        </div>
        @if (count($premium) == 0)
          <div class="sn-no-items">
            <div class="sn-cross-sign"></div>
            <i class="fa-solid fa-box-open"></i>
            <span>No Premium Shops Available.</span>
          </div>
        @else
        {{--  product title--}}
        <div class="col-12 mt-4 main-content ">
            <div id='shop_slide' class="owl-carousel owl-theme w-100 ps-4 px-md-5">
                @foreach($premium as $shop)

                <article class="post-wrapper">
                    <div class="post-img sop-img">
                        <a class="" href="{{url('/'.$shop->withoutspace_shopname)}}">
                            @if(empty($shop->shop_logo))
                            <img src="test/test1.jpg"class="sn-shop-image attachment-ftc_blog_shortcode_thumb size-ftc_blog_shortcode_thumb wp-post-image lazyloaded  sop-image-w-h"alt="">
                            @else
                            <img src="{{url('images/logo/mid/'.$shop->shop_logo)}}"class="sn-shop-image attachment-ftc_blog_shortcode_thumb size-ftc_blog_shortcode_thumb wp-post-image lazyloaded  sop-image-w-h"
                            alt="">
                            @endif
                        </a>
                    </div>
                    <div class="post-info">
                        <header class="entry-header">
                            <!-- Blog Title -->
                            <h3 class="yk-product-title "><a class="sop-font-content sop-font mt-2" style="font-family: sans-serif!important"
                                href="{{url('/'.$shop->withoutspace_shopname)}}">{{\Illuminate\Support\Str::limit($shop->shop_name, 12, '...')}}</a>
                            </h3>
                            <!-- Blog Author -->
                            <span class="vcard author" style=""></span>
                            <!-- Blog Categories -->
                        </header>
                        <div class="clear"></div>
                        {{-- <div class="entry-content sop-amount sop-font-content sop-font sop-color-vermilion">
                            <p>{{\Illuminate\Support\Str::limit($shop->description, 16, '..')}}</p>
                        </div> --}}
                        <div class="clear"></div>
                        {{-- <a href="{{url('shops/'.$shop->id)}}"class=" float-start sop-btmn">Shop Now
                        </a> --}}
                    </div>
                </article>
                @endforeach
                {{-- <div class="sn-similar-seeall">
                    <a href="">
                      <div>
                        <i class="fa-solid fa-arrow-right"></i>
                      </div>
                      <div class="see-all-text">See all</div>
                    </a>
                  </div> --}}
            </div>
        </div>
        @endif
    </div>
</div>
{{-- preminum seller slide--}}
