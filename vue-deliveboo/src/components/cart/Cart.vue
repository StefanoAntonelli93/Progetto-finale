<script>
export default {
  name: "Cart",
};
</script>

<template>
  <!-- <div class="cart-outer">
    <div class="cart-data"></div>
    <div class="cart-pay"></div>
  </div> -->
  <div data-v-4cea1779="" data-v-41beb9f5="" class="cart-header">
    <h2 data-v-4cea1779="" class="cart-header__title cart-header__title--mb">
      Il tuo ordine
    </h2>
    <div data-v-4cea1779="" class="cart-header__info"><!----></div>
  </div>
  <div
    data-v-3df201c0=""
    data-v-41beb9f5=""
    class="cart-info"
    data-test-id="empty-cart-info"
  >
    <div data-v-3df201c0="">
      <img
        data-v-3df201c0=""
        src="https://glovoapp.com/images/svg/astronaut-grey-scale.svg"
        alt="Non hai ancora aggiunto alcun prodotto. Quando lo farai, compariranno qui!"
        data-test-id="cart-info-image"
        class="cart-info__image"
      />
    </div>
    <div
      data-v-3df201c0=""
      data-test-id="cart-info-description"
      class="cart-info__description"
    >
      Non hai ancora aggiunto alcun prodotto. Quando lo farai, compariranno qui!
    </div>
  </div>
  <!---->
  <div data-v-41beb9f5="">
    <div
      data-v-3009d050=""
      data-v-3e1b7ac4=""
      data-test-id="minimum-basket-surcharge"
      class="mbs-view"
      viewtype="desktop"
      should-display-fees-info="true"
    >
      <button
        data-v-3009d050=""
        data-test-id="mbs-container"
        aria-label="Informazioni aggiuntive"
        class="mbs"
        style="--background-colour: var(--helio-color-primaryBackground)"
      >
        <div
          data-v-8acd1cc8=""
          data-v-3009d050=""
          data-test-id="progress-bar"
          class="progress-bar"
          style="
            --percentage-color: #00a082;
            --background-color: #e9f8f5;
            --percentage: 0%;
          "
          aria-label="0"
        >
          <div data-v-8acd1cc8="" class="progress-bar__percentage"></div>
        </div>
        <span
          data-v-3009d050=""
          data-test-id="surcharge-button"
          class="mbs__message"
          ><img
            alt="ℹ️"
            height="14"
            width="14"
            style="position: relative; top: 2px"
            src="https://glovoapp.com/images/svg/feedback/info.svg"
            class="mbs__info-icon"
          />
          <span
            >Raggiungi <b>12,00&nbsp;€</b> per risparmiare
            <b><span>0,99&nbsp;€</span></b> di commissioni!</span
          ></span
        >
        <img
          data-v-3009d050=""
          height="6"
          src="https://glovoapp.com/images/svg/arrow-top--black.svg"
          alt=""
          role="presentation"
          class="mbs__arrow"
        />
      </button>
    </div>
  </div>
  <div data-v-41beb9f5=""><!----></div>
</template>

<style scoped>
.cart-desktop[data-v-41beb9f5] {
  background: var(--helio-color-floatingElementBackground);
  border-radius: 10px;
  box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
  box-sizing: border-box;
  display: flex;
  flex-direction: column;
  min-height: 450px;
  overflow-x: hidden;
  padding: 0 var(--helio-space-M) var(--helio-space-M);
  position: relative;
}
.cart-outer {
  position: fixed;
  top: 164px;
  right: 50px;
  width: 300px;
  height: 500px;
  border: 1px solid black;
  background-color: gray;
}

.cart-data {
  width: 300px;
  height: 400px;
  background-color: blue;
}
.cart-pay {
  width: 300px;
  height: 100px;
  background-color: rgb(145, 194, 214);
}
</style>
