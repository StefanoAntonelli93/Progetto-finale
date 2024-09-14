<script>
import TitlePage from "../components/TitlePage.vue";

export default {
  name: "restaurant_menu",
  components: {
    TitlePage,
  },
};
</script>

<template>
  <!-- title -->
  <TitlePage :titlePage="'Ristoranti'"></TitlePage>
</template>
