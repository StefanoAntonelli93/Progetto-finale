<script>
import { ref, onMounted, onBeforeUnmount } from "vue";
import pizzaImage from "@/assets/img/pizza.png";
import hamburgerImage from "@/assets/img/hamburger.png";
import sushiImage from "@/assets/img/sushi.png";
import iceCreamImage from "@/assets/img/ice-cream.png";

export default {
  name: "Carousel",
  setup() {
    // Array di immagini e testi
    const images = ref([
      { src: pizzaImage, alt: "Pizza" },
      { src: hamburgerImage, alt: "Hamburger" },
      { src: sushiImage, alt: "Sushi" },
      { src: iceCreamImage, alt: "Gelato" },
    ]);

    const texts = ref([
      "Scopri la pizza più amata in città: croccante, gustosa e sempre calda!",
      "Goditi i tuoi fast food preferiti direttamente a casa tua, senza perdere un solo minuto!",
      "Assapora l'essenza del Giappone: sushi fresco e delizioso, pronto per te!",
      "Rendi ogni giornata più dolce con i nostri dessert irresistibili, perfetti per ogni occasione!",
    ]);

    const currentSlide = ref(0);
    let intervalId = null;

    // Funzione per avviare il carosello
    const startCarousel = () => {
      intervalId = setInterval(() => {
        currentSlide.value = (currentSlide.value + 1) % images.value.length; // Cambia la slide
      }, 7000); // Ogni 7 secondi
    };

    // Funzione per fermare il carosello
    const stopCarousel = () => {
      if (intervalId) {
        clearInterval(intervalId);
      }
    };

    const setSlide = (index) => {
      currentSlide.value = index;
    };

    onMounted(() => {
      startCarousel();
    });

    onBeforeUnmount(() => {
      stopCarousel();
    });

    return {
      images,
      texts,
      currentSlide,
      setSlide,
    };
  },
};
</script>

<template>
  <div class="second-container">
    <!-- Carosello immagini -->
    <div class="carousel-images">
      <img
        v-for="(image, index) in images"
        :src="image.src"
        :alt="image.alt"
        :key="index"
        :class="{ active: currentSlide === index }"
        class="carousel-image shadow-box"
      />
    </div>

    <!-- Carosello testi -->
    <div class="carousel-texts">
      <div
        v-for="(text, index) in texts"
        :key="index"
        :class="{ active: currentSlide === index }"
        class="carousel-text"
      >
        <!-- Indicatori di stato -->
        <div class="carousel-indicators">
          <span
            v-for="(image, index) in images"
            :key="index"
            @click="setSlide(index)"
            :class="{ active: currentSlide === index }"
            class="indicator"
          ></span>
        </div>
        <div>
          <p>{{ text }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped lang="scss">
.second-container {
  margin: 40px;
  background: url("@/assets/img/marble-background.png") no-repeat center center;
  background-size: cover;
  text-align: center;
}

/* Carosello immagini */
.carousel-images {
  display: flex;
  justify-content: center;
  align-items: center;
  position: relative;
  height: 400px;
  width: 100%;
  /* Definisci un'altezza fissa per evitare salti nel layout */
}

.carousel-image {
  position: absolute; /* Sovrappone tutte le immagini l'una sull'altra */
  width: 600px;
  img {
    background-size: contain;
  }
  height: 400px;
  opacity: 0;
  transition: opacity 1s ease; /* Transizione fluida di 1 secondo */
  border-radius: 15px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 6px 20px rgba(0, 0, 0, 0.1);
  transform: ease scale(1.1); /* Ingrandita leggermente all'inizio */
}

.carousel-image.active {
  opacity: 1; /* Mostra l'immagine attiva con dissolvenza */
  transform: scale(1); /* Torna alla dimensione normale */
}

/* Carosello testi */
.carousel-texts {
  margin-top: 10px;
  text-align: center;
  height: 50px;
  margin-bottom: 50px;
  font-family: "Open Sans", sans-serif;
  color: #333;
  position: relative;
}

.carousel-text {
  position: absolute;
  font-size: 24px;
  opacity: 0;
  transition: opacity 0.5s ease-in-out;
  width: 100%;
  transform: translateY(20px);
}

.carousel-text.active {
  opacity: 1;
}

.shadow-box {
  box-shadow: 8px 8px 7px 2px rgba(0, 0, 0, 0.3);
}

.carousel-text p {
  text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
  color: #444;
}

/* Indicatori */
.carousel-indicators {
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
}

.indicator {
  width: 15px;
  height: 15px;
  background-color: #ccc;
  border-radius: 50%;
  margin: 0 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.indicator.active {
  background-color: #63c0fe;
}

@media screen and (max-width: 800px) {
  .carousel-image {
    width: 500px;
  }
  .carousel-images {
    height: 350px;
    margin-bottom: 30px;
  }
}

@media screen and (max-width: 500px) {
  .carousel-image {
    width: 300px;
  }
  .carousel-image {
    height: 300px;
  }
  .carousel-images {
    height: 300px;
  }
}
</style>
