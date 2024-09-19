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

  <main class="p-5 container-fluid">
    <router-view></router-view>
  </main>

  <Footer />
</template>

<style scoped lang="scss"></style>
