<script>
import axios from "axios";
import Cart from "@/components/cart/Cart.vue";
import OrderCounter from "@/components/OrderCounter.vue";
import { store } from "@/store";

export default {
  name: "RestaurantDetail",
  components: {
    Cart,
    OrderCounter,
  },
  data() {
    return {
      store,
      restaurant: null,
      cart: JSON.parse(localStorage.getItem("cart")) || [], // Recupera il carrello dal localStorage se esiste
      plate: [],
      baseImageUrl: "http://127.0.0.1:8000/storage/",
    };
  },
  computed: {
    categoriesString() {
      return this.restaurant.categories
        .map((category) => category.name)
        .join(", ");
    },
  },
  created() {
    this.fetchRestaurantDetails();
    this.store.total = !isNaN(parseFloat(localStorage.getItem("total")))
      ? parseFloat(localStorage.getItem("total"))
      : 0;
  },
  methods: {
    fetchRestaurantDetails() {
      const restaurantId = this.$route.params.id;

      const restaurantPromise = axios.get(
        `http://127.0.0.1:8000/api/restaurants/${restaurantId}`
      );
      const menuPromise = axios.get(
        `http://127.0.0.1:8000/api/restaurants/${restaurantId}/plates`
      );

      Promise.all([restaurantPromise, menuPromise])
        .then(([restaurantResponse, menuResponse]) => {
          this.restaurant = restaurantResponse.data.result;
          this.plate = menuResponse.data.result;
          console.log("Menu Data:", menuResponse.data);
        })
        .catch((error) => console.error(error));
    },

    addToCart(item) {
      const cartItem = this.cart.find((cartItem) => cartItem.id === item.id);
      if (cartItem) {
        cartItem.quantity += item.quantity;
        cartItem.price += item.price;
        this.store.total += item.price; // Aggiorna il totale
      } else {
        this.cart.push(item);
        this.store.total += item.price;
      }
      this.updateLocalStorage(); // Aggiorna sia il carrello che il totale nel localStorage
    },

    removeFromCart(itemId) {
      const itemToRemove = this.cart.find((item) => item.id === itemId);

      if (itemToRemove) {
        this.store.total -= itemToRemove.price; // Riduci il totale
        this.cart = this.cart.filter((item) => item.id !== itemId); // Rimuovi l'elemento dal carrello
        this.updateLocalStorage(); // Aggiorna il localStorage
      }
    },

    emptyCart() {
      this.cart = [];
      this.store.total = 0; // Resetta il totale
      this.updateLocalStorage(); // Aggiorna il localStorage
    },

    updateLocalStorage() {
      localStorage.setItem("cart", JSON.stringify(this.cart)); // Salva il carrello nel localStorage
      localStorage.setItem("total", this.store.total.toString()); // Salva il totale nel localStorage
    },
  },
};
</script>

<template>
  <router-link class="no-style-link" :to="{ name: 'home' }">
    <p>indietro</p>
  </router-link>
  <div v-if="restaurant" class="restaurant-detail container-fluid p-5 mt-3">
    <div class="row">
      <div class="col-lg-9 col-sm-12 px-4">
        <!-- immagine ristorante -->
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-12">
            <img
              class="w-100"
              :src="baseImageUrl + restaurant.img"
              :alt="restaurant.restaurant_name"
            />
          </div>
          <!-- dettagli ristorante -->

          <div class="col-lg-6 col-md-6 col-sm-12">
            <h1>{{ restaurant.restaurant_name }}</h1>
            <p>{{ restaurant.address }}</p>
            <p>{{ restaurant.description }}</p>
            {{ categoriesString }}
          </div>
        </div>

        <!-- menu ristorante -->
        <div>
          <h3 class="pt-5 home-menu">Home {{ restaurant.restaurant_name }}</h3>

          <div class="row">
            <div class="col-12">
              <ul class="p-0">
                <li
                  class="list-unstyled"
                  v-for="plate in plate"
                  :key="plate.id"
                >
                  <div class="plate-cards container p-3">
                    <div class="row">
                      <div class="col-4">
                        <p class="fw-bold">
                          {{ plate.name }}
                        </p>
                        <p>{{ plate.ingredients }}</p>
                        <p>{{ plate.price }} &euro;</p>
                      </div>
                      <div class="col-4">
                        <div>
                          <img
                            class="plate-img"
                            :src="plate.image_url"
                            :alt="plate.name"
                          />
                        </div>
                      </div>
                      <!-- Counter per gli ordini + aggiungi ordine al carrello -->
                      <OrderCounter
                        class="col-4"
                        @add-to-cart="addToCart"
                        :item-details="{
                          id: plate.id,
                          name: plate.name,
                          price: plate.price,
                        }"
                      />
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 pb-3">
        <Cart
          :cart="cart"
          @remove-from-cart="removeFromCart"
          @empty-cart="emptyCart"
        />
      </div>
    </div>
  </div>
</template>

<style scoped lang="scss">
.restaurant-detail {
  border-radius: 10px;
}
img {
  border-radius: 10px;
}
.plate-cards {
  border: 2px solid#ff9553b9;
  margin-top: 10px;
  border-radius: 10px;
}

.plate-img {
  width: 100%;
}

.home-menu {
  background-color: rgb(255, 255, 255);
}
</style>
