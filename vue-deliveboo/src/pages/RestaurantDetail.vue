<script>
import axios from "axios";
import Cart from "@/components/cart/Cart.vue";
import OrderCounter from "@/components/OrderCounter.vue";
import { store } from "@/store";

export default {
  name: "RestaurantDetail",
  components: {
    Cart,
    OrderCounter,
  },
  data() {
    return {
      store,
      restaurant: null,
      cart: [], // Inizializza carrello vuoto
      plate: [],
      baseImageUrl: "http://127.0.0.1:8000/storage/",
      showModal: false,
      selectedItem: null,
    };
  },
  computed: {
    categoriesString() {
      return this.restaurant.categories
        .map((category) => category.name)
        .join(", ");
    },
  },
  created() {
    this.store.total = !isNaN(parseFloat(localStorage.getItem("total")))
      ? parseFloat(localStorage.getItem("total"))
      : 0;
  },
  mounted() {
    this.loadCart();
    this.fetchRestaurantDetails();
  },
  methods: {
    loadCart() {
      this.cart = JSON.parse(localStorage.getItem("cart")) || []; // Carica il carrello dal localStorage
      console.log("carrello mounted", this.cart);
    },

    fetchRestaurantDetails() {
      const restaurantId = this.$route.params.id;

      const restaurantPromise = axios.get(
        `http://127.0.0.1:8000/api/restaurants/${restaurantId}`
      );
      const menuPromise = axios.get(
        `http://127.0.0.1:8000/api/restaurants/${restaurantId}/plates`
      );

      Promise.all([restaurantPromise, menuPromise])
        .then(([restaurantResponse, menuResponse]) => {
          this.restaurant = restaurantResponse.data.result;
          this.plate = menuResponse.data.result;
          console.log("Menu Data:", menuResponse.data);
        })
        .catch((error) => console.error(error));
    },

    addToCart(item) {
      const restaurantIdInCart =
        this.cart.length > 0 ? this.cart[0].restaurantId : null;

      if (restaurantIdInCart && restaurantIdInCart !== this.restaurant.id) {
        // memorizzo elemento selezionato
        this.selectedItem = item;
        //  apri modale
        this.showModal = true;
        // interrompi
        return;
      }

      // Aggiungi il ristoranteId all'oggetto item
      const cartItem = this.cart.find((cartItem) => cartItem.id === item.id);
      if (cartItem) {
        cartItem.quantity += item.quantity;
        cartItem.price += item.price;
        this.store.total += item.price; // Aggiorna il totale
      } else {
        this.cart.push({
          ...item,
          restaurantId: this.restaurant.id, // Salva l'ID del ristorante corrente
        });
        this.store.total += item.price;
      }
      this.updateLocalStorage();
    },

    removeFromCart(itemId) {
      const itemToRemove = this.cart.find((item) => item.id === itemId);
      if (itemToRemove) {
        this.store.total -= itemToRemove.price; // Riduci il totale
        this.cart = this.cart.filter((item) => item.id !== itemId); // Rimuovi l'elemento dal carrello
        this.updateLocalStorage();
      }
    },

    emptyCart() {
      this.cart = [];
      this.store.total = 0; // Resetta il totale
      this.updateLocalStorage();
    },

    updateLocalStorage() {
      localStorage.setItem("cart", JSON.stringify(this.cart));
      localStorage.setItem("total", this.store.total.toString());
    },
    clearCartAndAddNew() {
      // Svuota il carrello e aggiungi il nuovo elemento
      this.emptyCart(); // svuota il carrello
      this.addToCart(this.selectedItem); // Aggiungi l'articolo al carrello
      this.closeModal(); // Chiudi modale
    },

    closeModal() {
      this.showModal = false;
    },
  },
};
</script>

<template>
  <a id="top"></a>
  <router-link class="no-style-link ps-5 zero-padding" :to="{ name: 'home' }">
    <button class="btn primary-color text-white">Indietro</button>
  </router-link>
  <div
    v-if="restaurant"
    class="restaurant-detail container-fluid px-5 mt-4 zero-padding"
  >
    <div class="row">
      <div class="col-xxl-8 col-sm-12 px-4">
        <!-- immagine ristorante e dati ristorante -->
        <div class="row mx-auto restaurant-card bg-white shadow-box">
          <div class="col-lg-6 col-sm-12 p-3 h-100">
            <img
              class="img_restaurant w-100 h-100"
              :src="baseImageUrl + restaurant.img"
              :alt="restaurant.restaurant_name"
            />
          </div>
          <!-- dettagli ristorante -->

          <div
            class="col-lg-6 col-sm-12 d-flex flex-column h-100 restaurant-card-content"
          >
            <h1 class="m-0 mt-2">{{ restaurant.restaurant_name }}</h1>
            <hr class="orange-border my-2" />
            <div class="d-flex justify-content-between flex-wrap">
              <h4 class="me-2">Indirizzo:</h4>
              <h4 class="text-end">{{ restaurant.address }}</h4>
            </div>
            <hr class="orange-border my-2" />
            <div class="d-flex justify-content-between flex-wrap">
              <h4 class="me-2">Chi siamo:</h4>
              <p class="text-start">{{ restaurant.description }}</p>
            </div>
            <hr class="orange-border my-2" />
            <div class="d-flex justify-content-between flex-wrap">
              <h4 class="me-2">Cucina:</h4>
              <h4 class="text-end">{{ categoriesString }}</h4>
            </div>
          </div>
        </div>

        <!-- menu ristorante -->

        <h2 class="mt-5 home-menu">Menù {{ restaurant.restaurant_name }}</h2>
        <div class="row">
          <div class="col-12">
            <ul class="p-0">
              <li
                class="list-unstyled shadow-box mb-4"
                v-for="plate in plate"
                :key="plate.id"
              >
                <div class="plate-cards bg-white p-3">
                  <div class="row justify-content-between h-100">
                    <div class="col-xxl-5 col-xl-12 h-100">
                      <img
                        class="plate-img"
                        :src="plate.image_url"
                        :alt="plate.name"
                      />
                    </div>
                    <div
                      class="col-xxl-5 col-xl-12 d-flex flex-column justify-content-around"
                    >
                      <div
                        class="d-flex justify-content-between flex-wrap margin-top-10"
                      >
                        <h4 class="me-2">Piatto:</h4>
                        <h4 class="text-end">{{ plate.name }}</h4>
                      </div>
                      <hr class="orange-border my-2" />
                      <div
                        class="d-flex flex-wrap justify-content-between flex-wrap"
                      >
                        <h4 class="me-2">Ingredienti:</h4>
                        <h4 class="text-end">{{ plate.ingredients }}</h4>
                      </div>
                      <hr class="orange-border my-2" />
                      <div class="d-flex justify-content-between flex-wrap">
                        <h4 class="me-2">Prezzo:</h4>
                        <h4 class="text-end">{{ plate.price }} &euro;</h4>
                      </div>
                    </div>

                    <!-- Counter per gli ordini + aggiungi ordine al carrello -->
                    <OrderCounter
                      class="col-xxl-2 col-xl-12"
                      @add-to-cart="addToCart"
                      :item-details="{
                        id: plate.id,
                        name: plate.name,
                        price: plate.price,
                      }"
                    />
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Modale -->

      <div v-if="showModal" class="modal-backdrop">
        <div class="modal-content">
          <h4>Attenzione</h4>
          <p>
            Hai già articoli di un altro ristorante nel carrello. Vuoi svuotare
            il carrello per aggiungere nuovi articoli?
          </p>
          <div class="modal-buttons">
            <button class="btn" @click="closeModal">Annulla</button>
            <button class="btn" @click="clearCartAndAddNew(item)">
              Svuota e Aggiungi
            </button>
          </div>
        </div>
      </div>
      <!-- fine modale -->

      <div class="col-xxl-4 pb-3 mb-2 px-4">
        <Cart
          :cart="cart"
          @remove-from-cart="removeFromCart"
          @empty-cart="emptyCart"
        />
      </div>
    </div>
  </div>

  <div class="d-flex justify-content-center my-4">
    <a class="btn primary-color text-white mt-2" href="#top">Torna su</a>
  </div>
</template>

<style scoped lang="scss">
@use "@/assets/scss/partials/variables.scss" as *;
.restaurant-detail {
  border-radius: 10px;
}
.primary-color {
  background-color: $primary-color;
  margin-left: 12px;
  border: none;
}

.restaurant-card {
  height: 350px;
  border: 2px solid#ff9553b9;
  border-radius: 10px;
}

.restaurant-card-content {
  overflow-y: scroll;
}
img {
  border-radius: 10px;
}

.orange-border {
  border: 2px solid#ff9553b9;
}
.plate-cards {
  border: 2px solid#ff9553b9;
  height: 250px;
  margin-top: 10px;
  border-radius: 10px;
}

li {
  border-radius: 10px;
}

.plate-img {
  object-fit: cover;
  width: 100%;
  height: 100%;
}

.shadow-box {
  box-shadow: 16px 10px 9px 4px rgba(0, 0, 0, 0.3);
}

button {
  box-shadow: 5px 5px 6px 2px rgba(0, 0, 0, 0.3);
}
button:hover {
  background-color: rgb(168, 120, 64);
}

// stile modale
.modal-backdrop {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}

.modal-content {
  background-color: white;
  padding: 20px;
  border-radius: 10px;
  width: 300px;
  text-align: center;
}

.modal-buttons {
  display: flex;
  justify-content: space-around;
  margin-top: 20px;

  button {
    background-color: $primary-color;
    color: white;
    cursor: pointer;
  }
  button:hover {
    background-color: rgb(231, 122, 58);
  }
}

@media screen and (max-width: 1400px) {
  .plate-cards {
    height: auto;
  }
  .margin-top-10 {
    margin-top: 20px;
  }
}

@media screen and (max-width: 992px) {
  .plate-cards {
    height: auto;
    .card-50 {
      height: 50%;
    }
  }
  .margin-t-10 {
    margin-top: 20px;
  }
  .restaurant-card {
    height: auto;
    padding: 20px;
  }
}

@media screen and (max-width: 992px) {
  .zero-padding {
    padding: 0 !important;
  }
}
</style>
