<script>
export default {
  name: "Header",
  methods: {
    goToLogin() {
      window.location.href = "http://127.0.0.1:8000/login"; // Route Blade per il login
    },
    goToRegister() {
      window.location.href = "http://127.0.0.1:8000/register"; // Route Blade per la registrazione
    },
  },
};
</script>

<template>
  <header>
    <div class="container-fluid d-flex justify-content-between">
      <div class="left">
        <a href="/">
          <img
            src="@/assets/img/logo_boo.png"
            alt="DeliveBoo Logo"
            class="logo"
          />
        </a>
      </div>
      <div class="right">
        <!-- Sezione 1 -->
        <div class="right-section align-items-center show">
          <button @click="goToLogin" class="btn btn-primary">
            <i class="fa fa-user"></i> Accedi
          </button>
          <button @click="goToRegister" class="btn btn-primary ms-4">
            Crea un account
          </button>
          <div class="right-section ms-4">
            <img
              src="@/assets/img/italy-flag.png"
              alt="Italian Flag"
              class="flag"
            />
          </div>
        </div>

        <!-- Sezione 2 -->

        <!-- Sezione 3 -->
        <div class="right-section hidden">
          <!-- Menu hamburger -->
          <button
            type="button"
            class="btn btn-outline-secondary navbar-toggler"
            data-bs-toggle="modal"
            data-bs-target="#menuModal"
          >
            <!-- Icona menu hamburger -->
            <i class="fa fa-bars hamburger-icon"></i>
          </button>

          <!-- Modale del menu -->
          <div
            class="modal fade"
            id="menuModal"
            tabindex="-1"
            aria-labelledby="menuModalLabel"
            aria-hidden="true"
          >
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="menuModalLabel">Menu</h5>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                  <!-- Pulsanti Accedi e crea un account -->
                  <div class="account-buttons">
                    <button @click="goToLogin" class="btn btn-light">
                      Accedi
                    </button>
                    <button @click="goToRegister" class="btn btn-primary">
                      Crea un account
                    </button>
                  </div>

                  <!-- Lista di opzioni -->
                  <ul class="account-options">
                    <li><i class="fa fa-phone"></i> Contatti</li>
                    <li><i class="fa fa-building"></i> Diventa partner</li>
                    <li><i class="fa fa-users"></i> Chi siamo</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>

<!-- Style -->
<style scoped lang="scss">
@use "@/assets/scss/partials/variables.scss" as *;

header {
  background-color: rgb(236, 236, 236);
  padding: 25px 0; /* Aggiungi del padding sopra e sotto */
  box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.2);
  transition: box-shadow 0.3s ease; /* Transizione per un effetto fluido */
  z-index: 100; /* Mantiene l'header sopra gli altri elementi */
}

.container {
  display: flex; /* Usa Flexbox per gestire il layout delle sezioni */
  justify-content: space-between; /* Spazia le sezioni sinistra e destra */
  align-items: center; /* Allinea verticalmente al centro */
  // max-width: 1200px; /* Larghezza massima del container */
  margin: 0 auto; /* Centra orizzontalmente */
  padding: 0 15px; /* Padding ai lati */
}

/* Sezione sinistra */

.logo {
  width: 200px; /* Puoi regolare la dimensione dell'immagine */
  height: auto;
  color: $primary-color;
}

/* Sezione destra */
.right {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 15px;
}

.right-section {
  padding: 0 10px; /* Aggiunge 10px di padding a sinistra e a destra */
}

.btn-primary {
  background-color: $primary-color;
  border: none;
  display: flex;
  align-items: center; /* Allinea l'icona con il testo */
}

.btn-primary .fa {
  margin-right: 8px;
}

/* Stile per la bandiera */
.flag {
  width: 20px;
  height: 15px;
}

/* Menu hamburger */
.modal-header {
  border-bottom: none;
}

/* Ingrandisci l'icona del menu ad hamburger */
.hamburger-icon {
  font-size: 30px; /* Puoi regolare questa dimensione */
  color: black; /* Colore dell'icona */
}

.modal-body {
  padding-top: 0;
}

.account-buttons {
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
}

.account-buttons .btn-light {
  background-color: #f5f5f5;
  border: 1px solid #ccc;
  padding: 10px 20px;
}

.account-buttons .btn-primary {
  background-color: orange;
  border: none;
  padding: 10px 20px;
}

.account-options {
  list-style: none;
  padding: 0;
  margin: 0;
}

.account-options li {
  display: flex;
  align-items: center;
  margin-bottom: 15px;
  font-size: 16px;
}

.account-options li i {
  margin-right: 10px;
  color: #666;
}

/* Stile per i singoli pulsanti */
.btn-close {
  background-color: transparent;
}

.hidden {
  display: none;
}

.show {
  display: flex;
}

@media screen and (max-width: 580px) {
  .hidden {
    display: block;
  }
  .show {
    display: none;
  }
}
</style>
