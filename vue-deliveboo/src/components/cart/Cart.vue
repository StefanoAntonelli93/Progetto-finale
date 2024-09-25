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
      console.log("svuoto carrello");
    },
  },
};
</script>

<template>
  <div class="cart-outer bg-white p-3">
    <h2 class="cart-title text-center">Il tuo ordine</h2>
    <div
      class="cart-data d-flex flex-column justify-content-center align-items-center"
    >
      <ul v-if="cart.length > 0" class="p-0 m-0">
        <li
          class="d-flex justify-content-between align-items-center mb-2 ps-1 flex-wrap"
          v-for="item in cart"
          :key="item.id"
        >
          <div class="d-flex me-2">
            <h4 class="me-3 mb-0">Qt. {{ item.quantity }}</h4>
            <h4 class="mb-0">{{ item.name }}</h4>
          </div>

          <div>
            <h4 class="mb-0 me-3">{{ item.price }} €</h4>
          </div>

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
    <div class="total px-3" v-if="cart.length > 0">
      <hr class="orange-border my-2" />
      <div class="d-flex justify-content-between px-1 my-1">
        <h3 class="m-0">Totale:</h3>
        <h3 class="m-0">{{ store.total }}€</h3>
      </div>
      <hr class="orange-border my-2" />
    </div>
    <!-- Pay button -->
    <div class="cart-pay px-3 mt-4">
      <div class="cart-btn">
        <button @click="empty()" class="btn btn-danger button-shadow">
          Svuota
        </button>
      </div>
      <div class="cart-btn">
        <router-link
          class="no-style-link"
          :to="{ name: 'cashout' }"
          v-if="cart.length > 0"
        >
          <button class="btn btn-orange text-white button-shadow">
            Procedi
          </button>
        </router-link>
        <button class="btn button-shadow" disabled v-else>Procedi</button>
      </div>
    </div>
  </div>
</template>

<style scoped lang="scss">
@use "@/assets/scss/partials/variables.scss" as *;
.cart-outer {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  border: 2px solid#ff9553b9;
  position: sticky;
  color: black;
  top: 164px;
  min-height: 500px;
  border-radius: 10px;
  box-shadow: 16px 10px 9px 4px rgba(0, 0, 0, 0.3);
}

.cart-data {
  min-height: 300px;
  overflow-y: scroll;
  ul {
    width: 95%;
  }
  li {
    position: relative;
    box-shadow: 5px 3px 4px rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(0, 0, 0, 0.087);
    padding: 5px 20px 5px 5px;
    border-radius: 10px;
    button {
      position: absolute;
      top: -1px;
      right: -1px;
      bottom: -1px;
      padding: 0 7px;
      border: 1px solid red;
    }
  }
}
.button-shadow {
  box-shadow: 5px 5px 6px 2px rgba(0, 0, 0, 0.3);
}
.backgraud-opacity {
  border-radius: 10px;
}
.cart-pay {
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
  button {
    border-radius: 10px;
  }
}

.cart-image {
  width: 100%;
  filter: grayscale(1) invert(0.2) opacity(0.6);
}

.cart-btn {
  .btn-primary {
    width: 80px;
    text-align: center;
    border: none;
  }
}
.orange-border {
  border: 2px solid#ff9553b9;
}
.btn-orange {
  background-color: $primary-color;
}
.btn-orange:hover {
  background-color: rgb(168, 120, 64);
}
</style>
