<script>
export default {
  name: "restaurant_menu",

  props: ["restaurantId"],
};
</script>

<template>
  <div class="container">
    <div class="content bg-primary"><h1>card ristorante</h1></div>

    <div class="row">
      <div class="col-8">
        <div class="content bg-success vh-100">
          <h2>menu</h2>
        </div>
      </div>
      <div class="col-4">
        <div class="content bg-warning vh-100">
          <h1>carrello</h1>
        </div>
      </div>
    </div>
  </div>
</template>
