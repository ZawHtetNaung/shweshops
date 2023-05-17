<template>
    <div class="px-md-5">
        <div class="mx-4 mx-md-3">
            <nav class="navbar navbar-expand-sm bg-light justify-content-start mb-3"
                 style="background-color: #fff !important">
                <ul class="zh_nav navbar-nav">
                    <li class="newest_nav nav-item" :class="{ active: this.activeItem == 'newest' }">
                        <a class="nav-link" id="newest" @click.prevent="setActive('newest')">Newest</a>
                    </li>
                    <li class="popular_nav nav-item" :class="{ active: this.activeItem == 'popular' }">
                        <a class="nav-link" id="popular" @click.prevent="setActive('popular')">Popular</a>
                    </li>
                    <li class="nav-item discount_nav" :class="{ active: this.activeItem == 'discount' }">
                        <a class="nav-link" id="discount" @click.prevent="setActive('discount')">Discount</a>
                    </li>
                    <li class="nav-item shop_nav" :class="{ active: this.activeItem == 'shops' }">
                        <a class="nav-link" id="shops" @click.prevent="setActive('shops')">Shops</a>
                    </li>
                </ul>
            </nav>
            <div>
                <NewitemsComponent
                    v-if="this.activeItem == 'newest'"
                    :newitems="this.newitems"
                    :current_shop_count="this.shop_limit"
                    :newlimit="this.newlimit"
                    :newlatest="this.newlatest"
                    ref="new"
                    @forparentfromnew="getdatafromnew"
                ></NewitemsComponent>

                <PopitemsComponent
                    v-if="this.activeItem == 'popular'"
                    :poplimit="this.poplimit"
                    :poplatest="this.poplatest"
                    ref="pop"
                    @forparentfrompop="getdatafrompop"
                ></PopitemsComponent>

                <DiscountitemsComponent
                    v-if="this.activeItem == 'discount'"
                    :discountlimit="this.discountlimit"
                    :discountlatest="this.discountlatest"
                    ref="dis"
                    @forparentfromdiscount="getdatafromdiscount"
                ></DiscountitemsComponent>

                <ShopsComponent
                    v-if="this.activeItem == 'shops'"
                    :shoplimitfromparent="this.shoplimitfromparent"
                    ref="shop"
                    @forparentfromshops="getdatafromshops"
                ></ShopsComponent>
            </div>
        </div>
    </div>
</template>

<script>
import NewitemsComponent from "./NewitemsComponent.vue";
import PopitemsComponent from "./PopitemsComponent.vue";
import DiscountitemsComponent from "./discount/DiscountitemsComponent.vue";
import ShopsComponent from "./shops/ShopsComponent.vue";

export default {
    props: [
        "newitems",
        "current_shop_count",
    ],
    components: {
        NewitemsComponent: NewitemsComponent,
        PopitemsComponent: PopitemsComponent,
        DiscountitemsComponent: DiscountitemsComponent,
        ShopsComponent: ShopsComponent,
    },
    name: "MainItemsComponent",
    data: function () {
        return {
            host: '',
            popitems: [],
            activeItem: 'newest',
            poplimit: 0,
            newlimit: 20,
            discountlimit: 0,
            shoplimitfromparent: 0,
            poplatest: true,
            newlatest: true,
            shop_limit: 0,
            discountlatest: true,
        };
    },
    beforeMount() {
        this.shop_limit = this.current_shop_count;
    },
    mounted() {
        this.host = this.$hostname;
    },
    watch: {
        // whenever question changes, this function will run

    },
    computed: {},
    filters: {},
    methods: {
        isActive(menuItem) {
            return this.activeItem === menuItem;
        },
         setActive(menuItem) {
            console.log(menuItem);

            this.activeItem = menuItem;
            if(menuItem == 'popular'){
                this.poplimit=0;
            }
            if(menuItem == 'discount'){
                 this.discountlimit=0;
            }
            if(menuItem == 'shops'){
                this.shoplimitfromparent=0;
            }

        },
        // getinitialpop: function () {
        //     return new Promise((resolve, reject) => {
        //         axios.get(this.host + '/initial_pop_items').then(response => resolve(response));
        //     });
        //
        // },
        getdatafrompop: function (data) {
            this.poplimit = data.poplimit;
            this.poplatest = data.poplatest;
        },
        getdatafromnew: function (data) {
            console.log("it worked");
            this.newlimit = data.newlimit;
            this.newlatest = data.newlatest;
            this.shop_limit = data.shop_limit;
        },
        getdatafromdiscount: function (data) {
            this.discountlimit = data.discountlimit;
            this.discountlatest = data.discountlatest;
        },
        getdatafromshops: function (data) {
            this.shoplimitfromparent = data.shoplimitfromparent;
        }
    }
}
</script>

<style>

</style>
