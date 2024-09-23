<script>
import axios from "axios";
import { store } from "@/store";
import { onMounted } from "vue";

export default {
  name: "restaurant_list",
  props: {
    selectedCategory: {
      type: Object,
      default: null,
    },
    isNextPage: "boolean",
    isPrevPage: "boolean",
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
    prevPage() {
      this.$emit("previous-page");
    },
    nextPage() {
      this.$emit("next-page");
    },
  },
  mounted() {
    this.$emit("fill-restaurants");
    console.log(this.isPrevPage);
  },
};
</script>

<template>
  <div class="row gap-2">
    <h2 class="p-0">Ristoranti Disponibili</h2>
    <div
      class="col-12 restaurant-card my-2"
      v-for="restaurant in store.restaurants"
      :key="restaurant.id"
    >
      <router-link
        class="no-style-link"
        :to="{ name: 'RestaurantDetail', params: { id: restaurant.id } }"
      >
        <div class="row h-100">
          <div class="card-50 col-lg-6 col-md-12">
            <img
              class="restaurant_img rounded"
              :src="baseImageUrl + restaurant.img"
              :alt="restaurant.name"
            />
          </div>
          <div class="card-50 col-lg-6 col-md-12 card-content">
            <div class="d-flex justify-content-between">
              <h2>{{ restaurant.restaurant_name }}</h2>
            </div>
            <hr class="orange-border my-2" />
            <div class="d-flex justify-content-between flex-wrap">
              <h3 class="me-2">Indirizzo:</h3>
              <h3>{{ restaurant.address }}</h3>
            </div>
            <hr class="orange-border my-2" />
            <div class="d-flex justify-content-between flex-wrap">
              <h4 class="me-2">Chi siamo:</h4>
              <h4 class="text-end">{{ restaurant.description }}</h4>
            </div>
            <hr class="orange-border my-2" />
            <div class="d-flex justify-content-between flex-wrap">
              <h4 class="me-2">Cucina:</h4>
              <h4
                class="d-flex gap-2 flex-wrap"
                v-if="restaurant.categories.length"
              >
                <div
                  v-for="category in restaurant.categories"
                  :key="category.id"
                >
                  {{ category.name }}
                </div>
              </h4>
              <h4 v-else>Nessuna categoria specificata</h4>
            </div>
          </div>
        </div>
      </router-link>
    </div>
    <div class="p-0" v-if="store.restaurants.length === 0">
      <h2>Ci dispiace ma non abbiamo trovato nessun ristorante</h2>
    </div>
    <nav class="p-0 d-flex justify-content-between gap-2 mt-4">
      <div>
        <button v-if="isPrevPage" class="btn btn-secondary" @click="prevPage">
          Indietro
        </button>
        <button
          v-if="isNextPage"
          class="btn btn-secondary ms-2"
          @click="nextPage"
        >
          Avanti
        </button>
      </div>
    </nav>
  </div>
</template>

<style scoped lang="scss">
@use "@/assets/scss/partials/variables.scss" as *;
@use "@/assets/scss/partials/commons.scss" as *;
.orange-border {
  border: 2px solid $primary-color;
}
.restaurant-card {
  border-radius: 5px;
  height: 350px;
  padding: 20px;
  border: 2px solid#ff9553b9;
  box-shadow: 16px 10px 9px 4px rgba(0, 0, 0, 0.3);
  cursor: pointer;
  p {
    user-select: none;
  }
  img {
    width: 100%;
    height: 100%;
  }
}

.card-50 {
  height: 100%;
  overflow-y: scroll;
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

@media screen and (max-width: 992px) {
  .restaurant-card {
    height: 600px;
    .card-50 {
      height: 50%;
    }
  }
  .card-content {
    margin-top: 20px;
  }
}
</style>
