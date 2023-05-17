<template>
    <div class="site-content">

        <!-- Top Content -->
        <!-- <div
            class="text-center mt-3 mt-sm-4 elementor-element elementor-element-3205fef1 elementor-widget elementor-widget-heading"
        >
            <div class="elementor-widget-container">
                <h3
                    class="elementor-heading-title elementor-size-default"
                    style=""
                >
                    Best Selling Items
                </h3>
                <figure class="wp-caption">
                    <img
                        width="139"
                        height="21"
                        :src="this.hostname + '/test/title-after.png'"
                        class="attachment-large size-large"
                        alt=""
                    />
                </figure>
            </div>
        </div> -->
        <!-- Top Content -->
        <div
          v-infinite-scroll="loadPopularItemsMore"
          infinite-scroll-disabled="busy"
          infinite-scroll-distance="140"
        >
        <!-- <div

        > -->
          <div
            class="products default loading row g-2 g-md-3"
            style="padding-bottom: 12px"
          >
              <div
                  class="col-6 col-sm-4 col-md-3 col-lg-2 yk-fade"
                  v-for="(item, index) in this.popdata"
                  :key="index"
              >
                  <div
                      class="ftc-product product mb-2"
                      style="box-shadow: none !important"
                  >
                      <div class="post-img sop-img">
                          <a
                              style="color: #ffe775 !important"
                              :href="host + '/' + item.WithoutspaceShopname"
                          >
                              <div
                                  class="yk-hover-title sop-rounded-top text-capitalize text-left g-0"
                                  style="width: 100% !important"
                              >
                                  <img
                                      v-lazy="
                                          host +
                                          '/images/logo/thumbs/' +
                                          item.ShopName.shop_logo
                                      "
                                      class="yk-hover-logo float-left"
                                  />
                                  <span>
                                      {{
                                          item.ShopName.shop_name
                                              | strlimit(15, "..")
                                      }}</span
                                  >
                              </div>
                          </a>
                          <span class="fa fa-user yk-viewcount">
                              <!--                                                 //you want to use yk_view from laravel eloquent but in vue you must write camelcase-->
                              {{ item.YkView }}
                          </span>
                          <a
                              :href="
                                  host +
                                  '/' +
                                  item.WithoutspaceShopname +
                                  '/product_detail/' +
                                  item.id
                              "
                          >
                              <img
                                  :src="host + '/' + item.CheckPhoto"
                                  class="sop-image-w-h"
                              />
                          </a>
                      </div>
                      <div class="item-description">
                          <!--                                                 <span class="zh-shop_name">-->
                          <!--                                                     {{item.ShopName.shop_name | strlimit(15,'..')}}-->
                          <!--                                                </span>-->

                          <span class="price">
                              <span
                                  class="woocommerce-Price-amount amount sop-amount"
                              >
                                  <bdi
                                      v-if="item.price == 0"
                                      v-html="item.MmPrice"
                                  >
                                  </bdi>
                                  <bdi v-else v-html="item.MmPrice"> </bdi>
                              </span>
                          </span>

                          <h3 class="product_title product-name">
                              <a
                                  :href="
                                      host +
                                      '/' +
                                      item.WithoutspaceShopname +
                                      '/product_detail/' +
                                      item.id
                                  "
                                  >{{ item.name | strlimit(12, "...") }}</a
                              >
                          </h3>
                          <!--                        <h3 class="product_title product-name"><a-->
                          <!--                            :href="host+'/product_detail/'+item.id">{{ item.ShopName.shop_name | strlimit(12,'...') }}</a>-->
                          <!--                        </h3>-->
                      </div>
                  </div>
              </div>
                <div
                    v-if="this.emptyonserverpop === 0"
                    class="col-12"
                    style="height: 222px !important"
                >

                    <div
                        class="yk-wrapper fff"
                        style="position: relative !important; margin-top: 56px"
                    >
                        <div class="ct-spinner5">
                            <div class="bounce1"></div>
                            <div class="bounce2"></div>
                            <div class="bounce3"></div>
                        </div>
                    </div>
                </div>
                <!-- <button @click="loadMore()">Load More</button> -->

              <!-- <div class="d-flex justify-content-center fa-3x mb-3 sop-sans">
                  <button
                      v-if="
                          this.clickloadmorecount < 5 && this.emptyonserver == 0
                      "
                      id=""
                      class="btn btn-danger zh-button"
                      @click="loadmoreclick($event)"
                  >
                      <span
                          class="fa fa-spinner"
                          v-bind:class="{ 'fa-spin': togglespin }"
                      ></span>
                      View More
                  </button>
                  <a
                      style="color: white !important"
                      :href="this.host + '/see_all_pop'"
                      v-else
                      class="btn btn-danger zh-button"
                  >
                      <span class="fa fa-arrow-circle-right"></span>
                      See All
                  </a>
              </div> -->
          </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
// import $ from "jquery";

export default {
    props: ["popitems","poplimit","poplatest"],
    name: "PopitemsComponent",
    data: function () {
        return {
            emptyonserver: 0,
            emptyonserverpop: 0,
            // togglespin: false,
            // clickloadmorecount: 0,
            popdata: [],
            hostname: "",
            host: "",
            // latestviewcount: "",
            popularlatest: true,
            popularlimit: 0,
            busy: false,
        };
    },

    mounted() {
        this.host = this.$hostname;
        this.popularlatest = this.poplatest;
        this.popularlimit = this.poplimit;
        this.loadPopularItemsMore();

    },
    filters: {
        strlimit: function (str, limit, other) {
            if (str.length > limit) {
                let shortstring = str.substring(0, limit) + other;
                return shortstring;
            } else {
                return str;
            }
        },
    },
    computed: {},
    methods: {
        loadPopularItemsMore() {
            this.busy = true;

            axios
                .get(
                    this.host +
                        "/get_popitems_ajax/" +
                        this.popularlatest +
                        "/" +
                        this.popularlimit
                )
                .then((response) => {

                    if (response.statusText == "OK") {
                        setTimeout(() => {

                          let setemptyonserver = (e) => {
                            if(e == 1 && this.popularlatest == false) {
                              this.emptyonserver = e;
                              this.emptyonserverpop = e;
                              this.busy = true;
                            }
                            else if(e == 1) {
                              this.emptyonserver = 0;
                              this.popularlimit = 0;
                              this.busy = false;
                              this.popularlatest = !this.popularlatest;
                              // this.loadMore();
                            }
                             else {
                              this.emptyonserver = e;
                              this.popularlimit += response.data[1];
                              // console.log("limit update", this.limit);
                            }
                          };

                          let setfilterdata = (data) => {
                            data.map((d) => {
                                this.popdata.push(d);
                            });
                          }

                          let setbusy = () => {
                              if (this.emptyonserver == 1 && this.popularlatest == false) {
                                  this.busy = true;
                              } else {
                                  this.busy = false;
                              }
                          };

                          async function tosetdata() {

                            await setemptyonserver(
                                response.data[2]
                            );
                            await setfilterdata(response.data[0]);
                            await setbusy();
                          }
                          tosetdata();
                          this.$emit("forparentfrompop", {
                              poplimit: this.popularlimit,
                              poplatest: this.popularlatest,
                          });

                        }, 10);

                        // console.log("Popular Items response data", response.data[1]);
                    }
                });
        },
    },
};
</script>

<style>
.yk-fade {
    -webkit-animation: fade 2s;
    -moz-animation: fade 2s;
    -o-animation: fade 2s;
    -ms-transition: fade 2s;
    animation: fade 2s;
}
@keyframes fade {
    0% {
        opacity: 0;
    }

    100% {
        opacity: 1;
    }
}
</style>
