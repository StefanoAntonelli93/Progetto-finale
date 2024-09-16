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
  <div>
    <!-- Header -->
    <Header />

    <main>
      <router-view></router-view>
    </main>

    <Footer />
  </div>
</template>

<style scoped lang="scss"></style>
