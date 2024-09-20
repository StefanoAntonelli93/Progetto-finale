<script>
import Braintree from "../components/Braintree.vue";
import { store } from "@/store";
export default {
  data() {
    return {
      store,
      isModalOpen: false,
      modalTitle: "",
      via: "",
      viaError: false,
      civico: "",
      civicoError: false,
      citofono: "",
      piano: "",
      citta: "",
      cittaError: false,
      cap: "",
      capError: false,
      nomeCognome: "",
      nomeCognomeError: false,
      telefono: "",
      telefonoError: false,
      orarioConsegna: "",
      note: "",
      metodoPagamento: "", // Variabile per il metodo di pagamento selezionato
    };
  },
  components: {
    Braintree,
  },
  methods: {
    openModal(title) {
      this.modalTitle = title;
      this.isModalOpen = true;
      document.body.style.overflow = "hidden"; // Disabilita lo scroll
    },
    closeModal() {
      this.isModalOpen = false;
      document.body.style.overflow = ""; // Ripristina lo scroll
    },
    validateVia() {
      this.viaError = !this.via;
    },
    validateCivico() {
      this.civicoError = !this.civico;
    },
    validateCitta() {
      this.cittaError = !this.citta;
    },
    validateCap() {
      this.capError = !this.cap;
    },
    validateNomeCognome() {
      this.nomeCognomeError = !this.nomeCognome;
    },
    validateTelefono() {
      this.telefonoError = !this.telefono;
    },
    selectPayment(paymentMethod) {
      this.metodoPagamento = paymentMethod; // Seleziona il metodo di pagamento
      console.log("Metodo di pagamento selezionato:", paymentMethod);
    },
  },
};
</script>

<template>
  <button class="ms-3 mb-3 text-white btn btn-back" @click="$router.go(-1)">
    Torna indietro
  </button>
  <div class="container-fluid py-3">
    <div class="row">
      <div class="col-12 col-lg-8 mb-3">
        <div class="content">
          <div class="container bg-light p-5">
            <h3>Indirizzo di consegna</h3>

            <div class="section-wrapper">
              <section class="section-1">
                <div class="address-field">
                  <label for="via">Via</label>
                  <input
                    type="text"
                    id="via"
                    v-model="via"
                    @blur="validateVia"
                    :class="{ error: viaError }"
                    placeholder="Inserisci la via"
                  />
                  <p v-if="viaError" class="error-message">
                    Il nome della via è necessario
                  </p>
                </div>

                <div class="address-field">
                  <label for="civico">Numero Civico</label>
                  <input
                    type="text"
                    id="civico"
                    v-model="civico"
                    @blur="validateCivico"
                    :class="{ error: civicoError }"
                    placeholder="Digita il numero civico"
                  />
                  <p v-if="civicoError" class="error-message">
                    Il numero civico è necessario
                  </p>
                </div>

                <div class="address-field">
                  <label for="citofono">Citofono (facoltativo)</label>
                  <input
                    type="text"
                    id="citofono"
                    v-model="citofono"
                    placeholder="Digita il nome del citofono"
                  />
                </div>
              </section>

              <section class="section-2">
                <div class="address-field">
                  <label for="piano">Piano (facoltativo)</label>
                  <input
                    type="text"
                    id="piano"
                    v-model="piano"
                    placeholder="Digita il numero del piano"
                  />
                </div>

                <div class="address-field">
                  <label for="citta">Città</label>
                  <input
                    type="text"
                    id="citta"
                    v-model="citta"
                    @blur="validateCitta"
                    :class="{ error: cittaError }"
                    placeholder="Inserisci la tua città"
                  />
                  <p v-if="cittaError" class="error-message">
                    Città o località obbligatori
                  </p>
                </div>

                <div class="address-field">
                  <label for="cap">CAP</label>
                  <input
                    type="text"
                    id="cap"
                    v-model="cap"
                    @blur="validateCap"
                    :class="{ error: capError }"
                    placeholder="Inserisci il CAP"
                  />
                  <p v-if="capError" class="error-message">
                    Il CAP è obbligatorio
                  </p>
                </div>
              </section>
            </div>

            <hr />

            <h3>Dettagli personali</h3>

            <div class="section-wrapper">
              <section class="section-1">
                <div class="address-field">
                  <label for="nomeCognome">Nome e Cognome</label>
                  <input
                    type="text"
                    id="nomeCognome"
                    v-model="nomeCognome"
                    @blur="validateNomeCognome"
                    :class="{ error: nomeCognomeError }"
                    placeholder="Inserisci il tuo nome e cognome"
                  />
                  <p v-if="nomeCognomeError" class="error-message">
                    Nome e cognome sono necessari
                  </p>
                </div>
              </section>

              <section class="section-2">
                <div class="address-field">
                  <label for="telefono">Numero di telefono</label>
                  <input
                    type="text"
                    id="telefono"
                    v-model="telefono"
                    @blur="validateTelefono"
                    :class="{ error: telefonoError }"
                    placeholder="Inserisci il tuo numero di telefono"
                  />
                  <p v-if="telefonoError" class="error-message">
                    Il numero di telefono è necessario
                  </p>
                </div>
              </section>
            </div>

            <hr />

            <!-- Extra Items Container -->
            <div class="extra-items d-none">
              <!-- Primo Extra Item -->
              <div class="extra-item" @click="openModal('Orario di consegna')">
                <section class="left-section">
                  <i class="fas fa-clock"></i>
                </section>
                <section class="middle-section">
                  <p>Orario di consegna</p>
                  <small>Arrivo previsto entro: 15-30 min</small>
                </section>
                <section class="right-section">
                  <i class="fas fa-chevron-right"></i>
                </section>
              </div>

              <!-- Secondo Extra Item -->
              <div class="extra-item" @click="openModal('Note ordine')">
                <section class="left-section">
                  <i class="fas fa-shopping-bag"></i>
                </section>
                <section class="middle-section">
                  <p>Note ordine</p>
                  <small>Lascia una nota per il locale</small>
                </section>
                <section class="right-section">
                  <i class="fas fa-chevron-right"></i>
                </section>
              </div>

              <!-- Terzo Extra Item -->
              <div class="extra-item" @click="openModal('Metodo di pagamento')">
                <section class="left-section">
                  <i class="fas fa-wallet"></i>
                </section>
                <section class="middle-section">
                  <p>Paga con</p>
                  <small class="error-message"
                    >Seleziona il metodo di pagamento</small
                  >
                </section>
                <section class="right-section">
                  <i class="fas fa-chevron-right"></i>
                </section>
              </div>
            </div>

            <!-- Modale Custom per Orario di consegna -->
            <div
              v-if="isModalOpen && modalTitle === 'Orario di consegna'"
              class="custom-modal-overlay"
              @click.self="closeModal"
            >
              <div class="custom-modal">
                <!-- Icona "X" per chiudere la modale -->
                <button class="modal-close-btn" @click="closeModal">×</button>

                <h2>{{ modalTitle }}</h2>

                <label for="orarioConsegna">Specifica l’orario</label>
                <select
                  id="orarioConsegna"
                  v-model="orarioConsegna"
                  class="select-input"
                >
                  <option disabled value="">
                    Scegli un orario di consegna
                  </option>
                  <option>Entro 15-30 minuti</option>
                  <option>Entro 30-45 minuti</option>
                  <option>Entro 45-60 minuti</option>
                </select>

                <button class="btn-confirm" @click="closeModal">Fatto</button>
              </div>
            </div>

            <!-- Modale Custom per Note ordine -->
            <div
              v-if="isModalOpen && modalTitle === 'Note ordine'"
              class="custom-modal-overlay"
              @click.self="closeModal"
            >
              <div class="custom-modal">
                <!-- Icona "X" per chiudere la modale -->
                <button class="modal-close-btn" @click="closeModal">×</button>

                <h2>{{ modalTitle }}</h2>

                <p class="modal-description">
                  Lascia una nota per il locale. Se qualcuno dei destinatari
                  dell'ordine ha allergie alimentari, contatta direttamente il
                  locale. Se non riesci a trovare le informazioni sulle allergie
                  di cui hai bisogno, non ordinare da questo locale.
                </p>

                <div class="note-container">
                  <label for="note">Aggiungi una nota</label>
                  <textarea
                    id="note"
                    v-model="note"
                    maxlength="160"
                    placeholder="Ad esempio: “Senza formaggio, per favore”. Se hai allergie o intolleranze alimentari, contatta direttamente il locale."
                  ></textarea>
                  <div class="character-counter">{{ note.length }}/160</div>
                </div>

                <p class="note-warning">
                  Per ordini che includono alcolici, tieni a portata di mano un
                  documento di identità.
                </p>

                <button class="btn-confirm" @click="closeModal">Fatto</button>
              </div>
            </div>

            <!-- Modale Custom per Metodo di Pagamento -->
            <div
              v-if="isModalOpen && modalTitle === 'Metodo di pagamento'"
              class="custom-modal-overlay"
              @click.self="closeModal"
            >
              <div class="custom-modal">
                <!-- Icona "X" per chiudere la modale -->
                <button class="modal-close-btn" @click="closeModal">×</button>

                <h2>{{ modalTitle }}</h2>

                <div
                  class="payment-option"
                  @click="selectPayment('Carta di credito o di debito')"
                >
                  <i class="fas fa-credit-card"></i>
                  <p>Carta di credito o di debito</p>
                  <i
                    v-if="metodoPagamento === 'Carta di credito o di debito'"
                    class="fas fa-check-circle selected-payment"
                  ></i>
                </div>
                <div class="payment-option" @click="selectPayment('Contanti')">
                  <i class="fas fa-money-bill-wave"></i>
                  <p>Contanti</p>
                  <i
                    v-if="metodoPagamento === 'Contanti'"
                    class="fas fa-check-circle selected-payment"
                  ></i>
                </div>
                <div class="payment-option" @click="selectPayment('PayPal')">
                  <i class="fab fa-paypal"></i>
                  <p>PayPal</p>
                  <i
                    v-if="metodoPagamento === 'PayPal'"
                    class="fas fa-check-circle selected-payment"
                  ></i>
                </div>

                <button class="btn-confirm" @click="closeModal">Fatto</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- brain tree*********************************************** -->
      <div class="col-12 col-lg-4">
        <div class="braintree content bg-light p-3">
          <h3>Riepilogo ordine</h3>
          <div class="content p-3 bg-white mb-4">
            <ul class="list-unstyled">
              <li v-for="item in store.cart" :key="item.id">
                {{ item.quantity }} - {{ item.name }} - {{ item.price }} &euro;
              </li>
            </ul>
            <p class="fw-semibold">Totale: {{ store.total }} &euro;</p>
          </div>

          <div>
            <Braintree />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped lang="scss">
@use "@/assets/scss/partials/variables.scss" as *;

.braintree {
  position: sticky;
  top: 20px;
}
/* Stile per la modale */
.custom-modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: flex-start;
  z-index: 1000;
}

.custom-modal {
  background-color: white;
  padding: 30px;
  border-radius: 8px;
  width: 500px;
  max-width: 90%;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
  text-align: left;
  margin-top: 100px;
  position: relative;
}

.modal-close-btn {
  position: absolute;
  top: 10px;
  right: 10px;
  background: none;
  border: none;
  font-size: 24px;
  cursor: pointer;
}

.modal-close-btn:hover {
  color: red;
}

.note-container {
  margin-top: 20px;
}

textarea {
  width: 100%;
  height: 100px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 14px;
  resize: none;
}

.character-counter {
  text-align: right;
  font-size: 12px;
  color: #666;
  margin-top: 5px;
}

.note-warning {
  font-size: 12px;
  color: #666;
  margin-top: 10px;
}

.modal-description {
  font-size: 14px;
  color: #666;
  margin-bottom: 15px;
}

.btn-confirm {
  background-color: #ff6600;
  color: white;
  padding: 14px;
  border: none;
  border-radius: 5px;
  width: 100%;
  cursor: pointer;
  font-size: 16px;
}

.btn-confirm:hover {
  background-color: #e65c00;
}

.payment-option {
  display: flex;
  align-items: center;
  padding: 15px;
  border: 1px solid #ddd;
  border-radius: 8px;
  margin-bottom: 12px;
  cursor: pointer;
  position: relative;
  transition: background-color 0.3s ease;
}

.payment-option i {
  font-size: 22px;
  margin-right: 15px;
  color: #ff6600;
}

.payment-option p {
  flex-grow: 1;
  margin: 0;
  font-size: 16px;
}

.payment-option:hover {
  background-color: #f1f1f1;
}

.selected-payment {
  color: green;
  font-size: 20px;
  position: absolute;
  right: 10px;
  top: 15px;
}

h1 {
  text-align: center;
}

h3 {
  text-align: center;
  margin-bottom: 20px;
}

.section-wrapper {
  display: flex;
  justify-content: space-between;
  width: 100%;
}

section {
  display: flex;
  flex-direction: column;
  width: 48%;
  margin-bottom: 15px;
}

.address-field {
  margin-bottom: 15px;
}

label {
  font-weight: bold;
  margin-bottom: 5px;
  display: block;
}

input[type="text"] {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

input[type="text"].error {
  border-color: red;
}

.error-message {
  color: red;
  font-size: 12px;
  margin-top: 5px;
}

hr {
  margin-top: 20px;
  border: none;
  border-top: 1px solid #ccc;
  width: 100%;
}

.extra-items {
  width: 100%;
}

.extra-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  border: 1px solid #ddd;
  border-radius: 8px;
  margin-bottom: 12px;
  background-color: #fff;
  padding: 10px;
  cursor: pointer;
}

.left-section i {
  font-size: 22px;
  color: #ff6600;
  margin-right: 15px;
}

.middle-section {
  flex-grow: 1;
  text-align: left;
}

.right-section i {
  font-size: 18px;
  color: #333;
}

.btn-pay {
  background-color: $primary-color;
  color: #fff;
  width: 100%;
}

.btn-back {
  background-color: $primary-color;
}
</style>
