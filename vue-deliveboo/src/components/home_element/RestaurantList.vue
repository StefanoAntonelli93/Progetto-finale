<script>
import TitlePage from "../TitlePage.vue";
import axios from "axios";
export default {
  name: "restaurant_list",
  components: {
    TitlePage,
  },
  data() {
    return {
      restaurants: [],
      api: {
        baseUrl: "http://127.0.0.1:8000/api/",
        endPoints: "restaurants",
      },
      currentPage: 1,
    };
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
      <div class="col-6" v-for="restaurant in restaurants">
        <div class="restaurant-card d-flex flex-wrap gap-3 mb-3 py-3">
          <div class="col-lg-4 col-md-12">
            <img
              class="category_img ms-3"
              :src="restaurant.image_url"
              :alt="restaurant.name"
            />
          </div>
          <div class="col-lg-6 col-md-12">
            <p>{{ restaurant.restaurant_name }}</p>
            <p class="text-secondary">{{ restaurant.address }}</p>
            <p>{{ restaurant.description }}</p>
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
  border: 1px solid black;
}
</style>
