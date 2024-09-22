<script>
import { store } from "@/store";
export default {
  name: "order_counter",
  props: {
    itemDetails: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      count: 0,
      store,
    };
  },
  methods: {
    decrease() {
      if (this.count !== 0) this.count--;
    },
    increase() {
      this.count++;
    },
    added() {
      if (this.count > 0) {
        this.$emit("add-to-cart", {
          ...this.itemDetails,
          quantity: this.count,
          price: this.count * this.itemDetails.price,
        });
        this.count = 0;
        // Resetta il contatore dopo l'aggiunta
      }
    },
  },
};
</script>

<template>
  <div class="d-flex flex-column justify-content-around align-items-end">
    <div class="d-flex flex-column">
      <div
        class="d-flex justify-content-between align-items-center mb-4 counter"
      >
        <button @click="decrease()" id="decrease" class="py-1">-</button>
        <div id="count" class="px-3">{{ count }}</div>
        <button @click="increase()" id="increase" class="py-1">+</button>
      </div>
      <div>
        <button class="w-100" @click="added()">Aggiungi</button>
      </div>
    </div>
  </div>
</template>

<style scoped lang="scss">
@use "../assets/scss/partials/variables.scss" as *;
button {
  background-color: rgb(254, 255, 255);
  border: 2px solid #ff9553b9;
  border-radius: 5px;
  padding: 10px 10px;
  cursor: pointer;
  transition: background-color 0.3s ease, border-color 0.3s ease;

  &:hover {
    background-color: #ff9553b9;
    border-color: #ff7553;
    color: #fff;
  }

  &:active {
    background-color: #d86f54;
    border-color: #ff5335;
    color: #fff;
  }

  &:focus {
    outline: none;
    background-color: #ff7553;
    border-color: #ff5335;
    color: #fff;
  }
}

.counter {
  width: 110px;
}
</style>
