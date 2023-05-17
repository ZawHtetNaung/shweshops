<template>
    <div class="site-content">
        <div
            class="products default loading row g-2 g-md-3"
            style="padding-bottom: 12px"
        >
            <div class="d-flex justify-content-between align-items-center">
                <div class="col-5">
                    <label
                        class="ps-2"
                        style="
                            text-align: left;
                            font-size: 1.2rem;
                            color: #780116 !important;
                        "
                        >ဆိုင်များရွေးရန်</label
                    >
                </div>
                <div class="d-flex align-items-center">
                    <!-- <div class="d-flex align-items-center"> -->
                    <input
                        type="text"
                        v-model="search"
                        placeholder="ဆိုင်အမည်.."
                        id="sop-filter-search"
                    />
                    <div
                        class="d-flex align-items-center align-self-stretch sop-filter-search"
                    >
                        <i class="fas fa-search px-3"></i>
                    </div>
                </div>
            </div>
            <div
                class="col-6 col-sm-4 col-md-3 col-lg-2 yk-fade"
                v-for="d in this.filteredList"
                v-bind:key="d.id"
            >
                <div
                    class="ftc-product product mb-2"
                    style="box-shadow: none !important"
                >
                    <div class="images post-img sop-img shop-img">
                        <a
                            :href="
                                '/' +
                                d.WithoutspaceShopname

                            "
                        >
                            <img
                                :src="'images/logo/mid/' + d.shop_logo"
                                class="sop-image-w-h sn-shop-image"
                            />
                        </a>
                    </div>
                </div>
                <div class="post-info">
                    <header class="entry-header">
                        <!-- Blog Title -->
                        <h3 class="yk-product-title">
                            <a
                                class="sop-font-content mt-2"
                                style="font-family: sans-serif !important"
                                :href="
                                    host +
                                    '/' +
                                    d.WithoutspaceShopname

                                "
                                >{{ d.shop_name }}</a
                            >
                        </h3>

                        <span class="vcard author" style=""></span>
                        <!-- Blog Categories -->
                    </header>

                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["latest_shops"],
    name: "ShopsComponent",
    data: function () {
        return {
            shops: "",
            host: "",
            hostname: "",
            emptyonserver: 0,
            togglespin: false,
            clickloadmorecount: 0,
            search: "",
        };
    },

    mounted() {
        this.host = this.$hostname;

        this.shops = this.latest_shops;
        console.log("shops==");
        console.log(this.shops);
        console.log("filter==");
        console.log(this.filteredList);
    },

    computed: {
        filteredList() {
            return Object.values(this.shops).filter((shop) => {
                return shop.shop_name
                    .toLowerCase()
                    .includes(this.search.toLowerCase());
            });
        },
    },
    filters: {},
    methods: {},
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
.sop-filter-search {
    border: 1px solid #780116;
    border-left: 0;
    background-color: #780116;
    color: white;
    border-radius: 0 5px 5px 0;
    padding: 0rem 1rem 0 0rem;
}
input[type="text"],
input[type="email"],
input[type="url"],
input[type="password"],
input[type="search"],
input[type="number"],
input[type="tel"],
input[type="range"],
input[type="date"],
input[type="month"],
input[type="week"],
input[type="time"],
input[type="datetime"],
input[type="datetime-local"],
input[type="color"],
textarea {
    color: #666;
    filter: none !important;
    border-radius: 0;
    -moz-border-radius: 0;
    -webkit-border-radius: 0;
    display: inline-block;
    border: 1px solid #e5e5e5;
    background: #fff;
    padding: 11px 15px;
    margin: 0;
    width: 100%;
    border-radius: 0;
    -moz-border-radius: 0;
    -webkit-border-radius: 0;
    text-align: left;
    width: 100%;
    box-shadow: none;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
}
@media only screen and (max-width: 576px) {
    .sop-filter-search {
        width: 50px;
    }
    input[type="text"],
    input[type="email"],
    input[type="url"],
    input[type="password"],
    input[type="search"],
    input[type="number"],
    input[type="tel"],
    input[type="range"],
    input[type="date"],
    input[type="month"],
    input[type="week"],
    input[type="time"],
    input[type="datetime"],
    input[type="datetime-local"],
    input[type="color"],
    textarea {
        padding: 5px 10px;
    }
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
