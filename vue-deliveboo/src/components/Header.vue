<template>
  <header>
    <div class="container">
      <div class="left">
        <a href="/">
          <img
            src="@/assets/img/deliveboo-logo.png"
            alt="DeliveBoo Logo"
            class="logo"
          />
        </a>
      </div>
      <div class="right">
        <!-- Sezione 1 -->
        <div class="right-section">
          <button class="btn btn-primary">
            <i class="fa fa-user"></i> Accedi
          </button>
        </div>

        <!-- Sezione 2 -->
        <div class="right-section">
          <img
            src="@/assets/img/italy-flag.png"
            alt="Italian Flag"
            class="flag"
          />
        </div>

        <!-- Sezione 3 -->
        <div class="right-section">
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
                    <button class="btn btn-light">Accedi</button>
                    <button class="btn btn-primary">Crea un account</button>
                  </div>

                  <!-- Lista di opzioni -->
                  <ul class="account-options">
                    <li><i class="fa fa-credit-card"></i> Carte Fedeltà</li>
                    <li><i class="fa fa-info-circle"></i> Ti serve aiuto?</li>
                    <li><i class="fa fa-bicycle"></i> Diventa rider</li>
                    <li>
                      <i class="fa fa-building"></i> Just Eat for business
                    </li>
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

<!-- Script -->
<script>
export default {
  name: "Header",
};
</script>

<!-- Style -->
<style scoped lang="scss">
@use "@/assets/scss/partials/variables.scss" as *;

header {
  padding: 20px 0; /* Aggiungi del padding sopra e sotto */
  height: 100px; /* Aumenta l'altezza dell'header */
  box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.2);
  transition: box-shadow 0.3s ease; /* Transizione per un effetto fluido */
  z-index: 100; /* Mantiene l'header sopra gli altri elementi */
}

.container {
  display: flex; /* Usa Flexbox per gestire il layout delle sezioni */
  justify-content: space-between; /* Spazia le sezioni sinistra e destra */
  align-items: center; /* Allinea verticalmente al centro */
  max-width: 1200px; /* Larghezza massima del container */
  margin: 0 auto; /* Centra orizzontalmente */
  padding: 0 15px; /* Padding ai lati */
}

/* Sezione sinistra */
.left {
}

.logo {
  width: 150px; /* Puoi regolare la dimensione dell'immagine */
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
  width: 30px;
  height: auto;
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
</style>
