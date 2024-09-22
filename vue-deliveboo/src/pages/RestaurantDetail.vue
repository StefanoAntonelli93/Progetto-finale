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
      cart: [], // Inizializza carrello vuoto
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
    this.store.total = !isNaN(parseFloat(localStorage.getItem("total")))
      ? parseFloat(localStorage.getItem("total"))
      : 0;
  },
  mounted() {
    this.loadCart();
    this.fetchRestaurantDetails();
    console.log("mounted");
  },
  methods: {
    loadCart() {
      this.cart = JSON.parse(localStorage.getItem("cart")) || []; // Carica il carrello dal localStorage
      console.log("carrello mounted", this.cart);
    },

    fetchRestaurantDetails() {
      const restaurantId = this.$route.params.id;
      console.log(restaurantId);

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
      this.updateLocalStorage();
      console.log(this.cart);
    },

    removeFromCart(itemId) {
      const itemToRemove = this.cart.find((item) => item.id === itemId);
      if (itemToRemove) {
        this.store.total -= itemToRemove.price; // Riduci il totale
        this.cart = this.cart.filter((item) => item.id !== itemId); // Rimuovi l'elemento dal carrello
        this.updateLocalStorage();
      }
    },

    emptyCart() {
      this.cart = [];
      this.store.total = 0; // Resetta il totale
      this.updateLocalStorage();
    },

    updateLocalStorage() {
      localStorage.setItem("cart", JSON.stringify(this.cart));
      localStorage.setItem("total", this.store.total.toString());
    },
  },
};
</script>

<template>
  <router-link class="no-style-link ps-5" :to="{ name: 'home' }">
    <button class="btn btn-secondary primary-color">Indietro</button>
  </router-link>
  <div v-if="restaurant" class="restaurant-detail container-fluid px-5 mt-4">
    <div class="row">
      <div class="col-lg-8 col-sm-12 px-4">
        <!-- immagine ristorante e dati ristorante -->
        <div class="row mx-auto restaurant-card shadow-box">
          <div class="h-100 col-lg-6 col-md-6 col-sm-12 p-2">
            <img
              class="img_restaurant"
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

        <h3 class="mt-5 home-menu">Home {{ restaurant.restaurant_name }}</h3>
        <div class="row">
          <div class="col-12">
            <ul class="p-0">
              <li
                class="list-unstyled shadow-box mb-4"
                v-for="plate in plate"
                :key="plate.id"
              >
                <div class="plate-cards p-3">
                  <div class="row justify-content-between h-100">
                    <div class="col-lg-5 col-sm-12 h-100">
                      <img
                        class="plate-img"
                        :src="plate.image_url"
                        :alt="plate.name"
                      />
                    </div>
                    <div class="margin-t-10 col-lg-4 col-sm-12">
                      <p class="fw-bold">
                        {{ plate.name }}
                      </p>
                      <p>{{ plate.ingredients }}</p>
                      <p>{{ plate.price }} &euro;</p>
                    </div>

                    <!-- Counter per gli ordini + aggiungi ordine al carrello -->
                    <OrderCounter
                      class="col-lg-2 col-sm-12"
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

      <div class="col-lg-4 pb-3 mb-2">
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
@use "@/assets/scss/partials/variables.scss" as *;
.restaurant-detail {
  border-radius: 10px;
}
.primary-color {
  background-color: $primary-color;
  margin-left: 12px;
  border: none;
}

.img_restaurant {
  object-fit: cover;
  width: 100%;
  height: 100%;
}

.restaurant-card {
  height: 350px;
  border: 2px solid#ff9553b9;
  border-radius: 12px;
  display: flex;
  justify-content: end;
}
img {
  border-radius: 10px;
}
.plate-cards {
  border: 2px solid#ff9553b9;
  height: 250px;
  margin-top: 10px;
  border-radius: 10px;
}
li {
  border-radius: 10px;
}

.plate-img {
  object-fit: cover;
  width: 100%;
  height: 100%;
}

.home-menu {
  background-color: rgb(255, 255, 255);
}

.shadow-box {
  box-shadow: 16px 10px 9px 4px rgba(0, 0, 0, 0.3);
}

@media screen and (max-width: 992px) {
  .plate-cards {
    height: auto;
    .card-50 {
      height: 50%;
    }
  }
  .margin-t-10 {
    margin-top: 20px;
  }
  .restaurant-card {
    height: auto;
    padding: 20px;
  }
}
</style>
