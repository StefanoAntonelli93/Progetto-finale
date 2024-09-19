<script>
import axios from "axios";
import { store } from "@/store";

export default {
  name: "restaurant_list",
  props: {
    selectedCategory: {
      type: Object,
      default: null,
    },
  },

  data() {
    return {
      store,
      show: 1,
      baseImageUrl: "http://127.0.0.1:8000/storage/",
      api: {
        baseUrl: "http://127.0.0.1:8000/api/",
        endPoints: "restaurants",
      },
      currentPage: 1,
    };
  },
  computed: {
    filteredRestaurants() {
      if (!this.selectedCategory) return this.store.restaurants;
      return this.restaurants.filter((restaurant) =>
        restaurant.categories.includes(this.selectedCategory.id)
      );
    },
  },
  methods: {
    resetCategories() {
      this.store.category = [];
      this.store.selectedCategories = [];
      this.categoryCall(null);
      this.show = 1;
    },
    prevPage() {
      console.log("pagina precedente");
      this.currentPage--;
      this.categoryCall();
    },
    nextPage() {
      console.log("pagina seguente");
      this.currentPage++;
      this.categoryCall();
    },
    categoryCall(categories) {
      const url = this.api.baseUrl + this.api.endPoints;
      const params = {
        page: this.currentPage,
      };

      if (categories) {
        // Add categories to params if they are provided
        this.store.category.push(categories);
        params.categories = this.store.category.join(",");
      }

      axios
        .get(url, { params })
        .then((response) => {
          const data = response.data.results.data;
          if (data && data.length) {
            this.store.restaurants = data;
            this.show = 1; // Set show to 1 if restaurants are found
          } else {
            this.store.restaurants = [];
            console.log("No restaurants found");
            this.show = 0; // Set show to 0 if no restaurants are found
          }
        })
        .catch((error) => console.log(error));
    },
  },
  created() {
    this.categoryCall();
  },
};
</script>

<template>
  <div class="row gap-2">
    <div
      class="col-lg-6 col-md-12 restaurant-card p-2"
      v-for="restaurant in store.restaurants"
      :key="restaurant.id"
    >
      <router-link
        class="no-style-link"
        :to="{ name: 'RestaurantDetail', params: { id: restaurant.id } }"
      >
        <div class="row h-100">
          <div class="col-lg-6 col-md-12">
            <img
              class="restaurant_img"
              :src="baseImageUrl + restaurant.img"
              :alt="restaurant.name"
            />
          </div>
          <div class="col-lg-6 col-md-12">
            <h3 class="m-0">{{ restaurant.restaurant_name }}</h3>
            <p class="text-secondary">Via: {{ restaurant.address }}</p>
            <p>{{ restaurant.description }}</p>
            <!-- categorie -->
            <div
              class="d-flex flex-wrap gap-1"
              v-if="restaurant.categories.length"
            >
              Categorie:
              <div v-for="category in restaurant.categories" :key="category.id">
                {{ category.name }}
              </div>
            </div>
          </div>
        </div>
      </router-link>
    </div>
    <div v-if="store.restaurants.length === 0">
      <h2>Ci dispiace ma non abbiamo trovato nessun ristorante</h2>
    </div>
  </div>

  <nav class="py-4 d-flex justify-content-between gap-2 mt-4">
    <div class="d-flex gap-2">
      <button class="btn btn-secondary" @click="prevPage">indietro</button>
      <button class="btn btn-secondary" @click="nextPage">avanti</button>
    </div>

    <div class="text-end">
      <button class="btn btn-secondary" @click="resetCategories">Reset</button>
    </div>
  </nav>
</template>

<style scoped lang="scss">
@use "@/assets/scss/partials/variables.scss" as *;
@use "@/assets/scss/partials/commons.scss" as *;

.restaurant-card {
  background-color: rgba(255, 123, 0, 0.264);
  border-radius: 5px;
  box-shadow: 4px 4px 8px rgba(167, 165, 162, 0.3);
  cursor: pointer;
  p {
    user-select: none;
  }
  img {
    pointer-events: none;
  }
}

.restaurant_img {
  width: 100%;
  height: 100%;
}

.restaurant-card:hover {
  background-color: rgba(
    128,
    128,
    128,
    0.4
  ); /* Cambia il colore dello sfondo al passaggio del mouse */
}

.restaurant-card:active {
  background-color: rgba(
    128,
    128,
    128,
    0.6
  ); /* Cambia il colore dello sfondo quando cliccato */
}
.no-style-link {
  text-decoration: none;
  color: inherit;
}

.no-style-link:hover {
  text-decoration: none;
}

button {
  background-color: $primary-color;
}
@media screen and (min-width: 992px) {
  .col-lg-6 {
    flex: 0 0 auto;
    width: 49.5%;
  }
}

@media screen and (max-width: 992px) {
  .restaurant-card {
    height: auto;
  }
}
</style>
