<template>
    <div
        v-infinite-scroll="loadDiscountItemsMore"
        infinite-scroll-disabled="busy"
        infinite-scroll-distance="10"
    >

        <div
            class="products default loading row g-2 g-md-3"
            style="padding-bottom: 12px"
        >
            <div
                class="col-6 col-sm-4 col-md-3 col-lg-2 yk-fade"
                v-for="d in this.discountdata"
                :key="d.id"
            >
                <div
                    class="ftc-product product mb-2"
                    style="box-shadow: none !important"
                >
                    <a
                        :href="
                            host +
                            '/' +
                            d.WithoutspaceShopname +
                            '/product_detail/' +
                            d.id
                        "
                    >
                        <div class="sop-ribbon">
                            <span>-{{ d.YkgetDiscount.percent }}%</span>
                        </div>
                    </a>
                    <div class="post-img sop-img">
                        <a
                            style="color: #ffe775 !important"
                            :href="host + '/' + d.WithoutspaceShopname"
                        >
                            <div
                                class="yk-hover-title sop-rounded-top text-capitalize text-left g-0"
                                style="width: 100% !important"
                            >
                                <img
                                    v-lazy="
                                        host +
                                        '/images/logo/thumbs/' +
                                        d.ShopName.shop_logo
                                    "
                                    class="yk-hover-logo float-left"
                                />
                                <span>
                                    {{
                                        d.ShopName.shop_name
                                            | strlimit(15, "..")
                                    }}</span
                                >
                            </div>
                        </a>
                        <span class="fa fa-user yk-viewcount">
                            <!--                                                 //you want to use yk_view from laravel eloquent but in vue you must write camelcase-->
                            {{ d.YkView }}
                        </span>
                        <a
                            :href="
                                host +
                                '/' +
                                d.WithoutspaceShopname +
                                '/product_detail/' +
                                d.id
                            "
                        >
                            <img
                                :src="host + '/' + d.CheckPhoto"
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
                                <bdi v-html="d.MmPrice"> </bdi>
                            </span>
                        </span>

                        <!--                        <h3 class="product_title product-name"><a-->
                        <!--                            :href="host+'/product_detail/'+item.id">{{ item.ShopName.shop_name | strlimit(12,'...') }}</a>-->
                        <!--                        </h3>-->
                    </div>
                </div>
            </div>
            <div
                v-if="this.emptyonserver === 0"
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

            <!-- <div class="d-flex justify-content-center fa-3x mb-3 sop-sans">
                <button
                    v-if="this.clickloadmorecount < 5"
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
                <div v-else>
                    <a
                        style="color: white !important"
                        :href="this.host + '/see_all_discount/' + this.shopid"
                        v-if="this.shopid == 'all'"
                        class="btn btn-danger zh-button"
                    >
                        <span class="fa fa-arrow-circle-right"></span>
                        See All
                    </a>
                    <a
                        style="color: white !important"
                        :href="
                            this.host +
                            '/see_all_discount_for_shop/' +
                            this.shopid
                        "
                        v-else
                        class="btn btn-danger zh-button"
                    >
                        <span class="fa fa-arrow-circle-right"></span>
                        See All
                    </a>
                </div>
            </div> -->
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    props: ["shop_id", "discountlimit", "discountlatest"],
    name: "DiscountitemsComponent",
    data: function () {
        return {
            shopid: "all",
            emptyonserver: 0,
            // togglespin: false,
            discountdata: [],
            // clickloadmorecount: 0,
            hostname: "",
            host: "",
            // latestviewcount: "",
            dislatest: true,
            dislimit: 0,
            busy: false,
        };
    },

    mounted() {
        this.host = this.$hostname;
        if (this.shop_id != undefined) {
            this.shopid = this.shop_id;
        }

        // console.log("this is discount ffffffffffff  ");
        // console.log(this.discountitems);

        this.dislatest = this.discountlatest;
        this.dislimit = this.discountlimit;

        this.loadDiscountItemsMore();

        // this.limit = 12;
        console.log(this.discountdata);
    },

    computed: {},
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
    methods: {
        loadDiscountItemsMore() {
            this.busy = true;

            axios
                .get(
                    this.host +
                    "/get_discount_ajax/" +
                    this.dislimit +
                    "/" +
                    this.shopid
                )
                .then((response) => {
                    if (response.statusText == "OK") {
                        setTimeout(() => {
                            let setemptyonserver = (e) => {
                                this.emptyonserver = e;
                                this.dislimit += response.data[1];
                            };

                            let setfilterdata = (data) => {
                                data.map((d) => {
                                    this.discountdata.push(d);
                                });
                            }

                            let setbusy = () => {
                                if (this.emptyonserver == 1) {
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
                            this.$emit("forparentfromdiscount", {
                                discountlimit: this.dislimit,
                                discountlatest: this.dislatest,
                            });
                        }, 500);

                        console.log(response.data.length);
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
