<template>
  <div class="PaypalPage">
    <PayPal
      env="sandbox"
      ref="paypal"
      amount="10.00"
      currency="USD"
      v-bind:client="payPal"
    >
    </PayPal>
  </div>
</template>

<script>
import PayPal from "vue-paypal-checkout";
export default {
  name: "PaypalPage",
  components: { PayPal },
  data: function () {
    return {
      payPal: {
        sandbox:
          "AWi18rxt26-hrueMoPZ0tpGEOJnNT4QkiMQst9pYgaQNAfS1FLFxkxQuiaqRBj1vV5PmgHX_jA_c1ncL",
        production:
          "AVZhosFzrnZ5Mf3tiOxAD0M6NHv8pcB2IFNHAfp_h69mmbd-LElFYkJUSII3Y0FPbm7S7lxBuqWImLbl",
      },
    };
  },
  mounted: function () {
    const script = document.createElement("script");
    script.src = `https://www.sandbox.paypal.com/webapps/hermes?flow=1-P&ulReturn=true&token=EC-37U17608KG3700346`;
    script.addEventListener("load", this.setLoaded);
    document.body.appendChild(script);
  },
};
</script>
