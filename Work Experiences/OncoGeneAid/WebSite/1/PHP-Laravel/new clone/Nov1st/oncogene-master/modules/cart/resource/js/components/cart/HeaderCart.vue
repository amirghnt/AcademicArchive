<template>
    <v-menu offset-y content-class="header-cart" @input="menuStatus">
        <template v-slot:activator="{ on, attrs }">

            <div class="btn-cart"  v-bind="attrs" v-on="on">
                <v-icon color="#00bfd6">mdi-cart</v-icon>
                <span>سبد خرید</span>
                <span id="cart-product-count" v-if="Object.keys(cartData).length>0" :data-counter="replaceNumber(cartData['products'][cart_type].length)"></span>
            </div>
        </template>

        <div v-if="!getResponse" class="header_cart_box progress-box">

            <v-progress-circular
                indeterminate
                color="red"
            ></v-progress-circular>

        </div>
        <div  class="header_cart_box" v-else-if="Object.keys(cartData).length>0 && cartData.final_price[cart_type]!=undefined">
            <div class="box_label">
                <span>({{ replaceNumber(cartData['products'][cart_type].length)  }}) کالا</span>
                <a v-bind:href="$siteUrl+'/Cart'" class="router-link">مشاهده سبد خرید</a>
            </div>
            <div id="header_cart_content">
                <table class="cart_table" style="margin-top: 0px">
                    <template v-for="(array,key) in cartData['product_with_sending_type'][1]['normal']">
                        <template v-if="array['product_key']!=undefined">
                            <header-cart-product-info
                                v-for="(index,key3) in array['product_key']"
                                :key="index"
                                :priceVariation="cartData['products'][cart_type][index]"
                            />
                        </template>
                        <template v-else>
                            <template v-for="(array2,key2) in array">
                                <header-cart-product-info
                                    v-for="(index,key3) in array2['product_key']"
                                    :key="index"
                                    :priceVariation="cartData['products'][cart_type][index]"
                                />
                            </template>
                        </template>
                    </template>
                </table>
            </div>
            <div class="box_label" style="height: 50px">
                <div>
                    <span>مبلغ قابل پرداخت : </span>
                    <span>{{ replaceNumber(number_format(cartData.final_price[cart_type]['normal'])) }} تومان</span>
                </div>
                <a v-bind:href="$siteUrl+'/shipping'" class="btn order_page" style="color:white !important;">ثبت سفارش</a>
            </div>

        </div>

        <div v-else>
            <div class="header_cart_box">
                <div class="empty-cart-message">
                    <p>سبد خرید شما خالیست</p>
                </div>
            </div>
        </div>
    </v-menu>
</template>

<script>
    import myMixin from "../../../../../../resources/js/myMixin";
    import HeaderCartProductInfo from './HeaderCartProductInfo';
    export default {
        name: "HeaderCart",
        props:['cart_type'],
        mixins:[myMixin],
        data(){
            return{
                show_dialog_box:false,
                selected_product:null,
                cartData:[],
                getResponse:false,
            }
        },
        mounted() {
            this.CartProductData();
            const self=this;
            this.$root.$on('update-cart',function () {
                self.getResponse=false;
                self.cartData=[];
                self.CartProductData();
            });
        },
        methods:{
            CartProductData:function () {
                const url=this.$siteUrl+"/site/CartProductData";
                this.axios.get(url).then(response=>{
                    this.cartData=response.data;
                    this.getResponse=true;
                    this.$nextTick(function () {
                        this.$root.$emit('addLoadEvent','header-cart');
                    });
                }).catch(error=>{
                    this.getResponse=true;
                });
            },
            menuStatus:function (val) {
                if(val===true){
                    this.$nextTick(function () {
                        this.$root.$emit('addLoadEvent','header-cart');
                    });
                }
            }
        },
        components:{
            HeaderCartProductInfo
        }
    }
</script>

<style>
    @import "../../style.css";
</style>
            
