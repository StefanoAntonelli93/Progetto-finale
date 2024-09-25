<script>
import Header from "./components/Header.vue";
import Footer from "./components/Footer.vue";

export default {
  name: "App",
  components: {
    Header,
    Footer,
  },
};
</script>
<template>
  <!-- Header -->
  <Header />

  <main class="p-5 container-fluid background-main">
    <div class="content">
      <router-view></router-view>
      <!-- Qui verranno caricati i tuoi componenti -->
    </div>
  </main>
  <Footer />
</template>

<style scoped lang="scss">
.background-main {
  position: relative; /* Crea un contesto di posizionamento per il pseudo-elemento */
  overflow: hidden; /* Nasconde eventuali contenuti in eccesso */
}

.background-main::before {
  content: ""; /* Necessario per il pseudo-elemento */
  position: absolute; /* Posiziona il pseudo-elemento in modo assoluto */
  top: 0; /* Inizia dall'alto */
  left: 0; /* Inizia a sinistra */
  right: 0; /* Estendi fino a destra */
  bottom: 0; /* Estendi fino in basso */
  background-image: url("@/assets/img/background.jpg"); /* Percorso dell'immagine */
  background-size: 20%; /* Mantiene le dimensioni originali dell'immagine */
  background-repeat: repeat; /* Non ripetere l'immagine */
  background-position: center; /* Centra l'immagine */
  opacity: 0.1; /* Imposta l'opacità al 50% */
  z-index: 0; /* Imposta un z-index più basso per posizionarlo sotto */
}

.content {
  position: relative; /* Permette ai contenuti di sovrapporsi all'immagine di sfondo */
  z-index: 1; /* Assicura che il contenuto sia sopra l'immagine di sfondo */
}
</style>
