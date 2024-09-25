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
      isNextPage: null,
      isPrevPage: null,
      isLogged: null,
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

      if (categories && !this.store.category.includes(categories)) {
        // Add categories to params if they are provided
        this.store.category.push(categories);
      } else {
        this.store.category = this.store.category.filter(
          (cat) => cat !== categories
        );
      }

      if (this.store.category.length > 0) {
        params.categories = this.store.category.join(",");
      }

      axios
        .get(url, { params })
        .then((response) => {
          this.isNextPage = response.data.results.next_page_url;
          this.isPrevPage = response.data.results.prev_page_url;
          console.log(response.data);
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
  <!-- slogan -->
  <!-- link top-->
  <a id="top"></a>
  <!-- carosello -->
  <section class="row my-5">
    <Carousel class="col" />
  </section>
  <!-- ricerca categoria -->
  <section class="my-5">
    <div class="slogan-fixed background-slogan">
      <h1 class="fw-bold text-center mb-5">Scegli cosa mangiare a Venezia</h1>
    </div>
    <div class="row">
      <ul
        id="category"
        class="d-flex flex-wrap gap-3 justify-content-center mt-5"
      >
        <li
          class="list-unstyled card-category"
          @click="selectFilter(category)"
          :class="{ isActive: store.selectedCategories.includes(category) }"
          v-for="category in store.categories"
          :key="category.id"
        >
          <div
            @click="categoryCall(category.name)"
            class="d-flex flex-column gap-2"
          >
            <img
              class="category_img"
              :src="category.img"
              :alt="category.name"
            />
            <p class="text-center fw-semibold">{{ category.name }}</p>
          </div>
        </li>
      </ul>
    </div>
  </section>
  <!-- db categories -->

  <!-- ristoranti -->
  <section class="py-4 container">
    <RestaurantList
      @previous-page="prevPage()"
      @next-page="nextPage()"
      @fill-restaurants="categoryCall()"
      :isNextPage="isNextPage"
      :isPrevPage="isPrevPage"
      :selectedCategory="selectedCategory"
    />
  </section>
</template>

<style scoped lang="scss">
@use "@/assets/scss/partials/variables.scss" as *;
@use "@/assets/scss/partials/commons.scss" as *;

h1 {
  color: $primary-color;
}

.card-category {
  background-color: rgba(248, 248, 248, 0.4);
  border-radius: 20px;
  box-shadow: 5px 7px 5px 4px rgba(0, 0, 0, 0.2);
  transition: transform 0.4s;
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
  transform: scale(1.04);
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

// .background-slogan {
//   background-image: url("@/assets/img/venezia.jpg");
//   background-size: cover; /* Copre completamente il contenitore */
//   background-repeat: no-repeat; /* Non ripete l'immagine */
//   width: 50%; /* Occupa tutta la larghezza */
//   height: 500px; /* Imposta un'altezza specifica (esempio: 500px) */
//   padding: 100px; /* Padding interno */
//   margin: 20px 0 100px 0; /* Margini superiori e inferiori */
//   position: relative; /* Posizionamento relativo per il contenuto sovrapposto */
//   color: white; /* Colore del testo se applicabile */
//   text-align: center; /* Centra il testo */
// }
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
