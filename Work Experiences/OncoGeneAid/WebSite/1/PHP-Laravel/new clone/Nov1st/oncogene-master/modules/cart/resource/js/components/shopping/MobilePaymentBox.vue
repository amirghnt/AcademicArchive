<template>
    <div class="mobile-payemnt-box" style="padding:15px">

        <slot name="message"></slot>

        <div class="order_info shipping_data_box" style="border:0px">
            <slot name="factor"></slot>
        </div>

        <div class="page_content" style='padding:0px 15px'>

            <div class="shipping_data_box payment_box" style="padding:10px 10px 0px 10px;margin-top:0px">
                <v-radio-group v-model="radioGroup">
                    <slot name="paymentitems"></slot>
                </v-radio-group>
            </div>

            <slot name="content"></slot>

        </div>


        <div style="padding-top:80px"></div>

        <div class="checkout-sticky" style="padding:0px 10px 0px 30px;z-index: 2">

            <v-btn color="#ef394e" class="checkout-btn" @click="sendFormData()">
                پرداخت و ثبت نهایی
            </v-btn>


            <div >
                <div>مبلغ قابل پرداخت</div>
                <div style="font-weight: bold;font-size:17px">
                    {{ price }}
                </div>
            </div>

        </div>

    </div>
</template>

<script>
    export default {
        name: "MobilePaymentBox",
        props:['price','token'],
        data(){
            return {
                radioGroup:1
            }
        },
        methods:{
            sendFormData:function () {
                const form = document.createElement("form");
                form.setAttribute("method", "POST");
                form.setAttribute("action", this.$siteUrl+'/order/payment');
                form.setAttribute("target", "_self");

                const hiddenField = document.createElement("input");
                hiddenField.setAttribute("name", "_token");
                hiddenField.setAttribute("value", this.token);
                form.appendChild(hiddenField);

                const hiddenField2 = document.createElement("input");
                hiddenField2.setAttribute("name", "pay_type");
                hiddenField2.setAttribute("value", this.radioGroup);
                form.appendChild(hiddenField2);

                document.body.appendChild(form);
                form.submit();
                document.body.removeChild(form);
            }
        }
    }
</script>
