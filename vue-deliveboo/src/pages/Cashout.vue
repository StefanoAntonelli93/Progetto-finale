<script>
import Braintree from "../components/Braintree.vue";
import axios from "axios";
import { store } from "@/store";

export default {
  data() {
    return {
      store,
      cart: [],
      nomeCognome: "",
      nomeCognomeError: false,
      deliveryAddress: "",
      deliveryAddressError: false,
      note: "",
      plate_id: [],
      plate_qt: [],
    };
  },
  components: {
    Braintree,
  },
  mounted() {
    this.loadCart();
    this.cart.forEach((element) => {
      this.plate_id.push(element.id);
      this.plate_qt.push(element.quantity);
    });
  },
  methods: {
    updateLocalStorage() {
      localStorage.setItem("cart", JSON.stringify(this.cart));
      localStorage.setItem("total", this.store.total.toString());
    },
    loadCart() {
      this.cart = JSON.parse(localStorage.getItem("cart")) || [];
      console.log("Carrello caricato", this.cart);
    },
    validateFields() {
      this.nomeCognomeError = !this.nomeCognome;
      this.deliveryAddressError = !this.deliveryAddress;

      return !(this.nomeCognomeError || this.deliveryAddressError);
    },
    async submitForm() {
      if (!this.validateFields()) {
        alert("Compila tutti i campi obbligatori.");
        return;
      }

      const formData = {
        customer_name: this.nomeCognome,
        delivery_address: this.deliveryAddress,
        restaurant_id: this.cart[0].restaurantId,
        price: this.store.total,
        plate_id: this.plate_id,
        quantity: this.plate_qt,
      };

      try {
        const response = await axios.post(
          "http://127.0.0.1:8000/api/orders",
          formData,
          {
            headers: {
              "Content-Type": "application/json", // Assicurati che il Content-Type sia corretto
            },
          }
        );

        console.log("Ordine inviato con successo:", response.data);
        alert("Ordine inviato con successo!");
        this.cart = [];
        this.store.total = 0; // Resetta il totale
        this.updateLocalStorage();
        this.$router.push("/");
      } catch (error) {
        console.error(
          "Errore nell'invio dell'ordine:",
          error.response ? error.response.data : error.message
        );
        alert("Si è verificato un errore durante l'invio dell'ordine.");
      }
    },
  },
};
</script>

<template>
  <button class="ms-3 mb-3 text-white btn btn-back" @click="$router.go(-1)">
    Torna indietro
  </button>
  <div class="container-sm border-orange rounded p-5">
    <div class="row">
      <!-- Form del cliente -->
      <div class="col-12">
        <h3 class="p-0 m-0 mb-3">Riepilogo ordine</h3>
        <form @submit.prevent="submitForm">
          <!-- Nome e Cognome -->
          <div class="mb-3">
            <label for="nomeCognome" class="form-label">Nome e Cognome</label>
            <input
              type="text"
              id="nomeCognome"
              v-model="nomeCognome"
              class="form-control"
              :class="{ 'is-invalid': nomeCognomeError }"
              required
            />
            <div v-if="nomeCognomeError" class="invalid-feedback">
              Nome e cognome obbligatorio.
            </div>
          </div>

          <!-- Indirizzo di Consegna -->
          <div class="mb-3">
            <label for="indirizzoConsegna" class="form-label"
              >Indirizzo di Consegna</label
            >
            <input
              type="text"
              id="indirizzoConsegna"
              v-model="deliveryAddress"
              class="form-control"
              :class="{ 'is-invalid': deliveryAddressError }"
              required
            />
            <div v-if="deliveryAddressError" class="invalid-feedback">
              Indirizzo obbligatorio (via e numero civico).
            </div>
          </div>

          <!-- Note (opzionale) -->
          <div class="mb-3">
            <label for="note" class="form-label">Note (opzionale)</label>
            <textarea
              id="note"
              v-model="note"
              class="form-control"
              placeholder="Aggiungi eventuali richieste o note per la consegna"
            ></textarea>
          </div>
          <div class="braintree content braintree-color rounded p-3">
            <div class="content p-3 bg-white mb-4">
              <ul class="list-unstyled">
                <li v-for="item in cart" :key="item.id">
                  {{ item.quantity }} - {{ item.name }} -
                  {{ item.price }} &euro;
                </li>
              </ul>
              <p class="fw-semibold">Totale: {{ store.total }} &euro;</p>
            </div>

            <!-- braintree -->
            <div>
              <Braintree
                :validateFields="validateFields"
                :submitForm="submitForm"
              />
            </div>
          </div>
          <!-- Pulsante per inviare il form -->
          <!-- <button type="submit" class="btn btn-primary">
            Procedi al pagamento
          </button> -->
        </form>
      </div>
    </div>
  </div>

  <!-- Riepilogo ordine e pagamento -->
</template>

<style scoped lang="scss">
@use "@/assets/scss/partials/variables.scss" as *;

.braintree {
  position: sticky;
  top: 20px;
}

.btn-back {
  background-color: $primary-color;
}
.btn-back:hover {
  background-color: rgb(168, 120, 64);
}
.border-orange {
  border: 2px solid#ff9553b9;
}
.braintree-color {
  background-color: #ff9653;
}
</style>
