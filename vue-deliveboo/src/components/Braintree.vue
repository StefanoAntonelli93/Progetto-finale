<template>
  <div id="dropin-container"></div>
  <button
    id="submit-button"
    class="button button--small button--green w-100 mt-3"
    @click="handlePayment()"
  >
    Paga
  </button>
</template>
<script>
export default {
  name: "Braintree",
  props: {
    validateFields: {
      type: Function,
      required: true,
    },
  },
  methods: {
    handlePayment() {
      // Controlla se i campi obbligatori sono stati compilati
      if (this.validateFields()) {
        // Se i campi sono validi, procedi con la richiesta del metodo di pagamento
        this.instance.requestPaymentMethod((err, payload) => {
          if (err) {
            console.error(err);
            return;
          }
          console.log("Nonce ricevuto:", payload.nonce);
          // Logica per inviare il nonce al server backend
        });
      } else {
        // Mostra un messaggio d'errore se i campi non sono validi
        alert("Compila tutti i campi obbligatori.");
      }
    },
    goToLogin() {
      window.location.href = "http://127.0.0.1:8000/login"; // Route per il login
    },
    goToRegister() {
      window.location.href = "http://127.0.0.1:8000/register"; // Route per la registrazione
    },
  },
  mounted() {
    braintree.dropin.create(
      {
        authorization: "sandbox_g42y39zw_348pk9cgf3bgyw2b", // Usa il tuo token di autorizzazione sandbox
        selector: "#dropin-container",
      },
      (err, instance) => {
        if (err) {
          console.error(err);
          return;
        }

        // Salva l'istanza di Braintree in `this` per usarla in `handlePayment`
        this.instance = instance;
      }
    );
  },
};
</script>

<style scoped>
.button {
  cursor: pointer;
  font-weight: 500;
  left: 3px;
  line-height: inherit;
  position: relative;
  text-decoration: none;
  text-align: center;
  border-style: solid;
  border-width: 1px;
  border-radius: 3px;
  -webkit-appearance: none;
  -moz-appearance: none;
  display: inline-block;
}

.button--small {
  padding: 10px 20px;
  font-size: 0.875rem;
}

.button--green {
  outline: none;
  background-color: #64d18a;
  border-color: #64d18a;
  color: white;
  transition: all 200ms ease;
}

.button--green:hover {
  background-color: #8bdda8;
  color: white;
}
</style>
