<template>
    <main>
      <div class="main-container">
        <!-- Sezione sinistra: Ricerca -->
        <section class="left-section">
          <div class="content">
            <h1>Ordina cibo e tanto altro</h1>
            <p>Ristoranti e spesa, a domicilio</p>
            
            <div class="search-container">
              <input type="text" placeholder="Indirizzo completo" class="search-input" />
              <button class="search-btn">Cerca</button>
            </div>
          </div>
        </section>
    
        <!-- Sezione destra divisa in due parti, con la sinistra inclinata e più piccola -->
        <section class="right-section">
          <!-- Sezione più piccola inclinata a sinistra -->
          <div class="colored-section"></div>
          <!-- Sezione più grande con immagine a destra -->
          <div class="image-section">
            <img src="@/assets/img/busta-con-logo.png" alt="Busta con logo" class="bag-image">
          </div>
        </section>
      </div>

      
    </main>
  </template>
  
  <script>
  export default {
    name: 'Main',
  };
  </script>
  
  <style scoped lang="scss">
  @import '@/assets/scss/variables.scss';
  
  main {
    padding: 0;
    height: 75vh; /* Altezza a tutta la viewport */
  }
  
  /* Layout principale con Flexbox */
  .main-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 100%;
    height: 100%;
  }
  
  /* Sezione sinistra */
  .left-section {
    flex: 1;
    padding: 40px;
    display: flex;
    justify-content: center; /* Centra orizzontalmente */
    align-items: center; /* Centra verticalmente */
  }
  
  .content {
    text-align: center; /* Centra il testo all'interno del contenitore */
  }
  
  .left-section h1 {
    font-size: 48px;
    font-weight: bold;
    color: #333;
    margin-bottom: 20px;
  }
  
  .left-section p {
    font-size: 24px;
    color: #666;
    margin-bottom: 40px;
  }
  
  .search-container {
    display: flex;
    align-items: center;
  }
  
  .search-input {
    padding: 15px;
    font-size: 18px;
    border: 1px solid #ddd;
    border-radius: 30px 0 0 30px;
    outline: none;
    width: 350px;
  }
  
  .search-btn {
    padding: 15px 30px;
    font-size: 18px;
    background-color: #63c0fe; /* Cambiato il colore del pulsante */
    color: white;
    border: none;
    border-radius: 0 30px 30px 0;
    cursor: pointer;
    transition: background-color 0.3s;
  }
  
  .search-btn:hover {
    background-color: darken(#63c0fe, 10%);
  }
  
  /* Sezione destra divisa in due parti */
  .right-section {
    flex: 1;
    display: flex;
    height: 100%;
  }
  
  /* Sezione più piccola inclinata con nuovo colore */
  .colored-section {
    background-color: #63c0fe; /* Colore cambiato */
    width: 15%; /* Ridotto a un 15% della larghezza */
    clip-path: polygon(100% 0, 100% 100%, 0 100%); /* Inclinazione a sinistra */
    height: 100%;
  }
  
  /* Sezione con immagine a destra e nuovo colore */
  .image-section {
    background-color: #63c0fe; /* Colore cambiato */
    width: 85%; /* Occupa l'85% della larghezza */
    display: flex;
    justify-content: center;
    align-items: center;
  }
  
  .bag-image {
    max-width: 350px;
    height: auto;
  }
  </style>
  