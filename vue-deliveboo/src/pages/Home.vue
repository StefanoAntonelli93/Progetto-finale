<script>
import { store } from "../store";
import RestaurantList from "../components/home_element/RestaurantList.vue";
import Carousel from "../components/home_element/Carousel.vue";
import axios from "axios";

export default {
  name: "home",
  data() {
    return {
      store,
      currentPage: 1,
      show: 1,
      api: {
        baseUrl: "http://127.0.0.1:8000/api/",
        endPoints: "restaurants",
      },
    };
  },
  components: {
    RestaurantList,
    Carousel,
  },
  methods: {
    selectFilter(category) {
      // Toggle category selection
      if (this.store.selectedCategories.includes(category)) {
        // If the category is already selected, remove it
        this.store.selectedCategories = this.store.selectedCategories.filter(
          (selected) => selected !== category
        );
      } else {
        // If it's not selected, add it to the array
        this.store.selectedCategories.push(category);
      }
    },

    categoryCall(categories) {
      const url = this.api.baseUrl + this.api.endPoints;
      const params = {
        page: this.currentPage,
      };

      if (categories && !this.store.category.includes(categories)) {
        // Add categories to params if they are provided
        this.store.category.push(categories);
      } else {
        this.store.category = this.store.category.filter(
          (cat) => cat !== categories
        );
      }

      console.log(this.store.category);
      if (this.store.category.length > 0) {
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
};
</script>
<template>
  <!-- title -->
  <!-- <TitlePage :titlePage="'Homepage'"></TitlePage> -->
  <!-- router link alle pagine menu ristorante e cashout -->
  <!-- <router-link class="btn btn-primary me-2" :to="{ name: 'restaurant_menu' }"
      >pagina menu ristorante</router-link
    >
    <router-link class="btn btn-primary" :to="{ name: 'cashout' }"
      >pagina cashout</router-link
    > -->
  <!-- slogan -->
  <!-- link top-->
  <a id="top"></a>
  <!-- carosello -->
  <section class="row">
    <Carousel class="col" />
  </section>
  <section>
    <div class="slogan-fixed">
      <h1 class="fw-bold text-center mb-5">Scegli cosa mangiare a Venezia</h1>
    </div>
  </section>
  <!-- ricerca categoria -->
  <section>
    <div class="row">
      <ul id="category" class="d-flex flex-wrap gap-3 justify-content-center">
        <li
          class="list-unstyled"
          @click="selectFilter(category)"
          :class="{ isActive: store.selectedCategories.includes(category) }"
          v-for="category in store.categories"
          :key="category.id"
        >
          <div
            @click="categoryCall(category.name)"
            class="card-category d-flex flex-column gap-2"
          >
            <div class="card-category d-flex flex-column gap-2">
              <img
                class="category_img"
                :src="category.img"
                :alt="category.name"
              />
              <p class="text-center">{{ category.name }}</p>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </section>
  <!-- db categories -->

  <!-- ristoranti -->
  <section class="py-4 container">
    <h4 class="py-4">Ristoranti</h4>
    <RestaurantList :selectedCategory="selectedCategory" />
  </section>
</template>

<style scoped lang="scss">
@use "@/assets/scss/partials/variables.scss" as *;
@use "@/assets/scss/partials/commons.scss" as *;

h1 {
  color: $primary-color;
}

.card-category {
  background-color: rgba(250, 249, 249, 0.2);
  border-radius: 20px;
  box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.3);
  cursor: pointer;
  p {
    user-select: none;
  }
  img {
    pointer-events: none;
    border-radius: 20px 20px 0 0;
  }
}

.card-category:hover {
  background-color: rgba(
    128,
    128,
    128,
    0.4
  ); /* Cambia il colore dello sfondo al passaggio del mouse */
}

.isActive {
  background-color: rgba(128, 128, 128, 0.6);
  border-radius: 20px;
}

.card-category:active {
  background-color: rgba(
    128,
    128,
    128,
    0.6
  ); /* Cambia il colore dello sfondo quando cliccato */
}

@media screen and (max-width: 800px) {
  .slogan-fixed {
    margin-top: 75px;
  }
}
@media screen and (max-width: 500px) {
  main {
    padding: 20px;
  }
  .slogan-fixed {
    margin-top: 150px;
  }
}
</style>
