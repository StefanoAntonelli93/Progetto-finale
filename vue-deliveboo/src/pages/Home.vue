<template>
  <!-- title -->
  <!-- <TitlePage :titlePage="'Homepage'"></TitlePage> -->
  <main class="p-5">
    <div class="main-container mt-3">
      <!-- Sezione sinistra: Ricerca -->
      <!-- <section class="left-section">
        <div class="content">
          <h1>Ordina cibo e tanto altro</h1>
          <p>Ristoranti e spesa, a domicilio</p>

          <div class="search-container">
            <input
              type="text"
              placeholder="Cerca qui i ristoranti"
              class="search-input"
            />

            <router-link
              activeClass="fw-bold"
              class="link"
              :to="{ name: 'restaurant_menu' }"
            >
              <button class="search-btn">Cerca</button>
            </router-link>
          </div>
        </div>
      </section> -->

      <!-- Sezione destra divisa in due parti, con la sinistra inclinata e più piccola -->
      <!-- <section class="right-section"> -->
      <!-- Sezione più piccola inclinata a sinistra -->
      <!-- <div class="colored-section"></div> -->
      <!-- Sezione più grande con immagine a destra -->
      <!-- <div class="image-section py-5">
          <img
            src="@/assets/img/busta-con-logo.png"
            alt="Busta con logo"
            class="bag-image"
          />
        </div> -->
      <!-- </section> -->
    </div>

    <!-- router link alle pagine menu ristorante e cashout -->
    <router-link class="btn btn-primary me-2" :to="{ name: 'restaurant_menu' }"
      >pagina menu ristorante</router-link
    >
    <router-link class="btn btn-primary" :to="{ name: 'cashout' }"
      >pagina cashout</router-link
    >
    <!-- slogan -->
    <!-- link top-->
    <a id="top"></a>
    <section>
      <div class="slogan-fixed">
        <h1 class="fw-bold">Scegli cosa mangiare a Venezia</h1>
      </div>
    </section>
    <!-- ricerca categoria -->
    <section>
      <h3 class="text-center py-4">Ricerca il tuo ristorante per categoria</h3>
      <div>
        <ul class="d-flex gap-3 justify-content-center">
          <li class="list-unstyled" v-for="category in store.categories">
            <div class="card-category d-flex flex-column gap-2">
              <img
                class="mt-5 category_img"
                :src="category.img"
                :alt="category.name"
              />
              <p class="text-center">{{ category.name }}</p>
            </div>
          </li>
        </ul>
      </div>
    </section>

    <!-- ristoranti -->
    <section>
      <h4>Ristoranti</h4>
      <p>qui ci vanno tutti i ristoranti con chiamata api</p>
    </section>

    <!-- carosello -->
    <!-- <section>
      <Carousel />
    </section> -->
  </main>
</template>

<script>
import { store } from "../store";
import TitlePage from "../components/TitlePage.vue";
import Carousel from "../components/home_element/Carousel.vue";

export default {
  name: "home",
  data() {
    return {
      store,
    };
  },
  components: {
    TitlePage,
    Carousel,
  },
};
</script>

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

.card-category:active {
  background-color: rgba(
    128,
    128,
    128,
    0.6
  ); /* Cambia il colore dello sfondo quando cliccato */
}

// main {
//   padding: 0;
// }

// /* Layout principale con Flexbox */
// .main-container {
//   display: flex;
//   justify-content: space-between;
//   align-items: center;
//   max-width: 100%;
//   height: 100%;
// }

// /* Sezione sinistra */
// .left-section {
//   flex: 1;
//   padding: 40px;
//   display: flex;
//   justify-content: center; /* Centra orizzontalmente */
//   align-items: center; /* Centra verticalmente */
// }

// .content {
//   text-align: center; /* Centra il testo all'interno del contenitore */
// }

// .left-section h1 {
//   font-size: 48px;
//   font-weight: bold;
//   color: #333;
//   margin-bottom: 20px;
// }

// .left-section p {
//   font-size: 24px;
//   color: #666;
//   margin-bottom: 40px;
// }

// .search-container {
//   display: flex;
//   align-items: center;
// }

// .search-input {
//   padding: 15px;
//   font-size: 18px;
//   border: 1px solid #ddd;
//   border-radius: 30px 0 0 30px;
//   outline: none;
//   width: 350px;
// }

// .search-btn {
//   padding: 15px 30px;
//   font-size: 18px;
//   background-color: #63c0fe; /* Cambiato il colore del pulsante */
//   color: white;
//   border: none;
//   border-radius: 0 30px 30px 0;
//   cursor: pointer;
//   transition: background-color 0.3s;
// }

// .search-btn:hover {
//   background-color: darken(#63c0fe, 10%);
// }

// /* Sezione destra divisa in due parti */
// .right-section {
//   flex: 1;
//   display: flex;
//   height: 100%;
// }

// /* Sezione più piccola inclinata con nuovo colore */
// .colored-section {
//   background-color: #63c0fe; /* Colore cambiato */
//   width: 15%; /* Ridotto a un 15% della larghezza */
//   clip-path: polygon(100% 0, 100% 100%, 0 100%); /* Inclinazione a sinistra */
//   height: 100%;
// }

// /* Sezione con immagine a destra e nuovo colore */
// .image-section {
//   background-color: #63c0fe; /* Colore cambiato */
//   width: 85%; /* Occupa l'85% della larghezza */
//   display: flex;
//   justify-content: center;
//   align-items: center;
// }

// .bag-image {
//   max-width: 350px;
//   height: auto;
// }
//
</style>
