<script>
import { store } from "@/store";
export default {
  name: "Cart",
  props: {
    cart: {
      type: Array,
      default: () => [],
    },
  },
  data() {
    return {
      store,
    };
  },
  methods: {
    dropItem(itemId) {
      this.$emit("remove-from-cart", itemId); // Passa l'ID dell'item da rimuovere
      console.log("cancello item:", itemId);
    },
    empty() {
      this.store.total = 0;
      this.$emit("empty-cart");
    },
  },
};
</script>

<template>
  <div class="cart-background">
    <div class="cart-outer p-2">
      <h2 class="cart-title text-center">Il tuo ordine</h2>
      <div
        class="cart-data d-flex flex-column justify-content-center align-items-center"
      >
        <ul class="p-0 m-0" v-if="cart.length > 0">
          <li
            class="d-flex justify-content-between align-items-center mb-1 ps-1"
            v-for="item in cart"
            :key="item.id"
          >
            {{ item.quantity }} - {{ item.name }} - Prezzo: {{ item.price }} €
            <button @click="dropItem(item.id)" class="btn btn-danger">X</button>
          </li>
        </ul>
        <div class="backgraud-opacity" v-else>
          <img
            src="/src/assets/img/logo_boo.png"
            alt="Non hai ancora aggiunto alcun prodotto. Quando lo farai, compariranno qui!"
            class="cart-image"
          />
          <div class="cart-description text-center">
            <h5>
              Non hai ancora aggiunto alcun prodotto. Quando lo farai,
              compariranno qui!
            </h5>
          </div>
        </div>
      </div>
      <!-- Pay button -->
      <div class="cart-pay">
        <div class="cart-btn">
          <button class="btn btn-light text-primary">
            Totale: {{ store.total }}€
          </button>
        </div>
        <div class="cart-btn">
          <router-link
            class="no-style-link"
            :to="{ name: 'cashout' }"
            v-if="store.cart.length > 0"
          >
            <button class="btn btn-primary">Procedi</button>
          </router-link>
          <button class="btn btn-primary" disabled v-else>Procedi</button>
        </div>
        <div class="cart-btn">
          <button @click="empty()" class="btn btn-danger">Svuota</button>
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
  backdrop-filter: blur(2px);
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
  height: 300px;
  overflow-y: scroll;
  ul {
    width: 90%;
  }
  li {
    position: relative;
    background-color: rgba(0, 0, 0, 0.67);
    padding: 5px 20px 5px 5px;
    width: 100%;
    border-radius: 10px;
    button {
      position: absolute;
      top: 0px;
      right: 0px;
      bottom: 0px;
      padding: 0 7px;
    }
  }
}
.backgraud-opacity {
  background-color: rgba(0, 0, 0, 0.67);
  border-radius: 10px;
}
.cart-pay {
  width: 100%;
  display: flex;
  justify-content: space-around;
  align-items: center;
}

.cart-image {
  width: 100%;
}

.cart-btn {
  .btn-primary {
    width: 80px;
    text-align: center;
    border: none;
  }
}
</style>
