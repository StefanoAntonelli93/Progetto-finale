<script>
import axios from "axios";

export default {
  name: "RestaurantDetail",
  data() {
    return {
      restaurant: null,
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
      // collego all'url l'id del ristorante selezionato
      const restaurantId = this.$route.params.id;
      axios
        .get(`http://127.0.0.1:8000/api/restaurants/${restaurantId}`)
        .then((response) => {
          this.restaurant = response.data.result;
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
    <div class="container">menu</div>
  </div>
</template>

<style scoped lang="scss">
.restaurant-detail {
  border-radius: 10px;
}
img {
  border-radius: 10px;
}
</style>
