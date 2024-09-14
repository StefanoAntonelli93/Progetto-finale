<script>
import TitlePage from "../components/TitlePage.vue";

export default {
  name: "Npt Found",
  components: {
    TitlePage,
  },
};
</script>

<template>
  <TitlePage :titlePage="'Not Found'"></TitlePage>
  <div class="container-fluid p-5">
    <h1>Page Not found.</h1>
  </div>
</template>
