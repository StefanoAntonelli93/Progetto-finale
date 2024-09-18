<script>
export default {
  name: "Cart",
};
</script>

<template>
  <div class="cart-background">
    <div class="cart-outer">
      <div>
        <h2 class="cart-title text-center pt-4">Il tuo ordine</h2>
      </div>
      <div class="cart-data">
        <div>
          <img
            src="/src/assets/img/logo_boo.png"
            alt="Non hai ancora aggiunto alcun prodotto. Quando lo farai, compariranno qui!"
            class="cart-image"
          />
          <div class="cart-description ps-4">
            <h5>
              Non hai ancora aggiunto alcun prodotto. Quando lo farai,
              compariranno qui!
            </h5>
          </div>
        </div>
      </div>
      <!-- Pay button -->
      <div class="cart-pay pb-4">
        <div class="cart-btn">
          <button class="btn btn-primary">Procedi</button>
        </div>
        <div class="cart-btn">
          <button class="btn btn-danger">Svuota</button>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
* {
  color: white;
}

.cart-outer {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  width: 100%;
  height: 100%;
  border-radius: 20px;
  box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
  backdrop-filter: blur(8px);
  -webkit-backdrop-filter: blur(8px);
}
.cart-background {
  background-image: url("/src/assets/img/pizza.png");
  background-size: cover;
  background-position: center;
  position: sticky;
  top: 164px;
  width: 300px;
  height: 450px;
  border-radius: 20px;
}

.cart-data {
  display: flex;
  flex-direction: column;
  justify-content: center;
  width: 300px;
}
.cart-pay {
  width: 100%;
  display: flex;
  justify-content: space-around;
  align-items: center;
}

.cart-image {
  width: 100%;
  filter: saturate(8) invert(1);
}

.cart-btn {
  .btn-primary {
    width: 80px;
    text-align: center;
    border: none;
  }
}
</style>
