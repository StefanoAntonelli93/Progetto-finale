<script>
import TitlePage from "../TitlePage.vue";
import axios from "axios";
export default {
  name: "restaurant_list",
  props: {
    selectedCategory: {
      type: Object,
      default: null,
    },
  },
  components: {
    TitlePage,
  },
  data() {
    return {
      baseImageUrl: "http://127.0.0.1:8000/storage/",
      restaurants: [],
      api: {
        baseUrl: "http://127.0.0.1:8000/api/",
        endPoints: "restaurants",
      },
      currentPage: 1,
    };
  },
  computed: {
    filteredRestaurants() {
      if (!this.selectedCategory) return this.restaurants;
      return this.restaurants.filter((restaurant) =>
        restaurant.categories.includes(this.selectedCategory.id)
      );
    },
  },
  methods: {
    prevPage() {
      console.log("pagina precedente");
      this.currentPage--;
      this.getRestaurants();
    },
    nextPage() {
      console.log("pagina seguente");
      this.currentPage++;
      this.getRestaurants();
    },
    getRestaurants() {
      const url = this.api.baseUrl + this.api.endPoints;
      //   console.log(url);
      axios
        .get(url, {
          params: {
            page: this.currentPage,
          },
        })
        .then((response) => {
          //   console.log(response);
          // se l'array è popolato restituisci qualcosa altrimenti messaggio errore
          if (response.data.results.data.length) {
            // console.log(response.data.results);
            this.restaurants = response.data.results.data;
            // console.log(response.data.results.data);
          } else {
            console.log("errore chiamata api");
          }
        })
        .catch((error) => console.log(error));
    },
  },
  created() {
    this.getRestaurants();
  },
};
</script>

<template>
  <div class="container">
    <div class="row">
      <div
        class="col-6"
        v-for="restaurant in filteredRestaurants"
        :key="restaurant.id"
      >
        <div class="restaurant-card d-flex flex-wrap gap-3 mb-3 py-y3">
          <div class="col-lg-4 col-md-12">
            <img
              class="category_img ms-3"
              :src="baseImageUrl + restaurant.img"
              :alt="restaurant.name"
            />
          </div>
          <div class="col-lg-6 col-md-12">
            <p>{{ restaurant.restaurant_name }}</p>
            <p class="text-secondary">{{ restaurant.address }}</p>
            <p>{{ restaurant.description }}</p>

            <!-- categorie -->
            <div v-if="restaurant.categories.length">
              <p>Categorie:</p>

              <div v-for="category in restaurant.categories" :key="category.id">
                {{ category.name }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <nav class="py-4 d-flex justify-content-center gap-2">
      <button class="btn btn-primary" @click="prevPage">indietro</button>
      <button class="btn btn-primary" @click="nextPage">avanti</button>
    </nav>
  </div>
</template>

<style scoped lang="scss">
.restaurant-card {
  background-color: rgba(250, 249, 249, 0.2);
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
</style>
