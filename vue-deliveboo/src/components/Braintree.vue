<template>
  <div id="dropin-container"></div>
  <button id="submit-button" class="button button--small button--orange w-100">
    Acquista
  </button>
</template>

<script>
export default {
  name: "Braintree",
  methods: {
    goToLogin() {
      window.location.href = "http://127.0.0.1:8000/login"; // Route per il login
    },
    goToRegister() {
      window.location.href = "http://127.0.0.1:8000/register"; // Route per la registrazione
    },
  },
  mounted() {
    var button = document.querySelector("#submit-button");

    braintree.dropin.create(
      {
        authorization: "sandbox_g42y39zw_348pk9cgf3bgyw2b", // Usa il tuo token di autorizzazione sandbox
        selector: "#dropin-container",
      },
      function (err, instance) {
        if (err) {
          console.error(err);
          return;
        }

        button.addEventListener("click", function () {
          instance.requestPaymentMethod(function (err, payload) {
            if (err) {
              console.error(err);
              return;
            }

            // Invia payload.nonce al tuo server
            console.log("Nonce ricevuto:", payload.nonce);
            // Logica per inviare il nonce al server backend
          });
        });
      }
    );
  },
};
</script>

<style scoped>
.button {
  cursor: pointer;
  font-weight: 500;
  line-height: inherit;
  text-align: center;
  border-style: solid;
  border-width: 1px;
  border-radius: 3px;
  display: inline-block;
}

.button--small {
  padding: 10px 20px;
  font-size: 0.875rem;
}

.button--orange {
  background-color: #ff9653;
  color: white;
  transition: all 200ms ease;
}

.button--green:hover {
  background-color: #8bdda8;
  color: white;
}
</style>
