<template>
    <footer>
      <!-- Logo al centro, sopra le altre sezioni -->
      <div class="logo-container">
        <img src="@/assets/img/logo-bianco.png" alt="Logo DeliveBoo" class="footer-logo">
      </div>
  
      <div class="container">
        <!-- Sezione 1: Informazioni aziendali o link rapidi -->
        <div class="footer-section">
          <h5>Informazioni aziendali</h5>
          <ul>
            <li><a href="#">Chi siamo</a></li>
            <li><a href="#">Termini e condizioni</a></li>
            <li><a href="#">Privacy Policy</a></li>
          </ul>
        </div>
  
        <!-- Sezione 2: Link social -->
        <div class="footer-section">
          <h5>Seguici</h5>
          <div class="social-icons">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-instagram"></i></a>
          </div>
        </div>
  
        <!-- Sezione 3: Altri link o copyright -->
        <div class="footer-section">
          <h5>Contatti</h5>
          <ul>
            <li><a href="#">Contattaci</a></li>
            <li><a href="#">Supporto</a></li>
          </ul>
          <p>&copy; 2024 DeliveBoo. Tutti i diritti riservati.</p>
        </div>
      </div>
    </footer>
  </template>
  
  <script>
  export default {
    name: 'Footer',
  };
  </script>
  
  <!-- Stile -->
  <style scoped lang="scss">
  @import '@/assets/scss/variables.scss';
  
  footer {
    background-color: #333; /* Sfondo scuro */
    color: white;
    padding: 40px 0;
  }
  
  /* Contenitore per il logo, centrato */
  .logo-container {
    display: flex;
    justify-content: center;
    margin-bottom: 50px; /* Spazio sotto il logo */
  }
  
  .footer-logo {
    width: 150px; /* Dimensione del logo */
    height: auto;
  }
  
  /* Contenitore principale del footer */
  .container {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
  }
  
  /* Sezioni del footer */
  .footer-section {
    flex: 1;
    margin-right: 30px;
  }
  
  .footer-section h5 {
    font-size: 18px;
    margin-bottom: 15px;
  }
  
  .footer-section ul {
    list-style: none;
    padding: 0;
  }
  
  .footer-section ul li {
    margin-bottom: 10px;
  }
  
  .footer-section ul li a {
    color: white;
    text-decoration: none;
    transition: color 0.3s;
  }
  
  .footer-section ul li a:hover {
    color: orange;
  }
  
  /* Icone social */
  .social-icons a {
    margin-right: 10px;
    font-size: 20px;
    color: white;
    transition: color 0.3s;
  }
  
  .social-icons a:hover {
    color: orange;
  }
  
  /* Stile per il testo di copyright */
  footer p {
    margin-top: 20px;
    font-size: 14px;
    color: #ccc;
  }
  </style>
  