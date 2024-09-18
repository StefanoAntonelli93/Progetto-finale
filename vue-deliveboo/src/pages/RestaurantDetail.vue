<script>
import axios from "axios";
import Cart from "@/components/cart/Cart.vue";
import OrderCounter from "@/components/OrderCounter.vue";

export default {
  name: "RestaurantDetail",
  components: {
    Cart,
    OrderCounter,
  },
  data() {
    return {
      restaurant: null,
      plate: [],
      baseImageUrl: "http://127.0.0.1:8000/storage/",
    };
  },
  computed: {
    categoriesString() {
      // Mappa le categorie per ottenere un array di nomi e poi uniscili in una stringa separata da virgola
      return this.restaurant.categories
        .map((category) => category.name)
        .join(", ");
    },
  },
  created() {
    this.fetchRestaurantDetails();
  },
  methods: {
    fetchRestaurantDetails() {
      const restaurantId = this.$route.params.id;

      // Chiamate API
      const restaurantPromise = axios.get(
        `http://127.0.0.1:8000/api/restaurants/${restaurantId}`
      );
      const menuPromise = axios.get(
        `http://127.0.0.1:8000/api/restaurants/${restaurantId}/plates`
      );

      // Esecuzione delle chiamate in parallelo
      Promise.all([restaurantPromise, menuPromise])
        .then(([restaurantResponse, menuResponse]) => {
          // Assegna i dati alle variabili
          this.restaurant = restaurantResponse.data.result;
          this.plate = menuResponse.data.result;
          console.log("Menu Data:", menuResponse.data);
        })
        .catch((error) => console.error(error));
    },
  },
};
</script>
<template>
  <div v-if="restaurant" class="restaurant-detail container p-5 mt-3">
    <div class="row">
      <div class="col-9 px-4">
        <!-- immagine ristorante -->
        <div class="row">
          <div class="col-5">
            <img
              class="w-100"
              :src="baseImageUrl + restaurant.img"
              :alt="restaurant.restaurant_name"
            />
          </div>
          <!-- dettagli ristorante -->

          <div class="col-5">
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
                      <div class="col-6">
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
                      <OrderCounter />
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="col-3 pb-3">
        <Cart />
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
