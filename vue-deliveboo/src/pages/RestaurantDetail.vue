<script>
import axios from "axios";

export default {
  name: "RestaurantDetail",
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
  <div v-if="restaurant" class="restaurant-detail container py-5 mt-3">
    <div class="row">
      <!-- immagine ristorante -->
      <div class="col-6">
        <img
          class="w-100"
          :src="baseImageUrl + restaurant.img"
          :alt="restaurant.restaurant_name"
        />
      </div>
      <!-- dettagli ristorante -->

      <div class="col-6">
        <h1>{{ restaurant.restaurant_name }}</h1>
        <p>{{ restaurant.address }}</p>
        <p>{{ restaurant.description }}</p>

        {{ categoriesString }}
      </div>
    </div>

    <!-- menu ristorante -->
    <div>
      <h3 class="py-5 home-menu">Home {{ restaurant.restaurant_name }}</h3>
      <div class="container">
        <div class="row">
          <div class="col-8">
            <ul>
              <li class="list-unstyled" v-for="plate in plate" :key="plate.id">
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
                    <!-- button -->
                    <div
                      class="col-2 d-flex flex-column justify-content-around align-items-center"
                    >
                      <div
                        class="d-flex justify-content-center align-items-center"
                      >
                        <button class="py-1">-</button>
                        <div class="px-3">1</div>
                        <button class="py-1">+</button>
                      </div>
                      <div>
                        <button>Aggiungi</button>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
          <div class="col-3">carrello</div>
        </div>
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
  button {
    background-color: rgb(254, 255, 255);
    border: 2px solid #ff9553b9;
    border-radius: 5px;
    padding: 10px 10px;
    cursor: pointer;
    transition: background-color 0.3s ease, border-color 0.3s ease;

    &:hover {
      background-color: #ff9553b9;
      border-color: #ff7553;
      color: #fff;
    }

    &:active {
      background-color: #d86f54;
      border-color: #ff5335;
      color: #fff;
    }

    &:focus {
      outline: none;
      background-color: #ff7553;
      border-color: #ff5335;
      color: #fff;
    }
  }
}

.plate-img {
  width: 100%;
}

.home-menu {
  background-color: rgb(255, 255, 255);
}
</style>
