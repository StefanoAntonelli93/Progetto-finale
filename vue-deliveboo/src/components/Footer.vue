<template>
  <footer>
    <div class="container">
      <div class="d-flex flex-wrap w-100 gap-5">
        <!-- Prima sezione del footer: Informazioni aziendali -->
        <div class="footer-section col">
          <h3>Informazioni aziendali</h3>
          <ul>
            <li><a href="#">Chi siamo</a></li>
            <li><a href="#">Termini e condizioni</a></li>
            <li><a href="#">Privacy Policy</a></li>
          </ul>
        </div>

        <!-- Seconda sezione del footer: Link ai social media -->
        <div class="footer-section col">
          <h3>Contatti</h3>
          <ul>
            <li><a href="#">Contattaci</a></li>
            <li><a href="#">Supporto</a></li>
          </ul>
          <div class="social-icons">
            <a href="#">
              <font-awesome-icon :icon="['fab', 'square-twitter']"
            /></a>
            <a href="#">
              <font-awesome-icon :icon="['fab', 'square-facebook']"
            /></a>
            <a href="#">
              <font-awesome-icon :icon="['fab', 'square-instagram']"
            /></a>
          </div>
        </div>

        <!-- Quarta sezione del footer: Mappa -->
        <div class="map-section p-0 col">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.8354345093747!2d144.95373541590466!3d-37.81627957975198!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d43baffd555%3A0xb1f6c53b37efdf6a!2sMelbourne%20CBD%2C%20VIC%2C%20Australia!5e0!3m2!1sen!2sus!4v1634567890987!5m2!1sen!2sus"
            style="border: 0"
            allowfullscreen=""
            loading="lazy"
          ></iframe>
        </div>
      </div>
    </div>
    <div class="container d-flex justify-content-end">
      <p>&copy; 2024 DeliveBoo. Tutti i diritti riservati.</p>
    </div>
  </footer>
</template>
<script>
export default {
  name: "Footer",
};
</script>
<style scoped lang="scss">
@use "@/assets/scss/partials/variables.scss" as *;

footer {
  background-color: #333;
  color: white;
  padding: 40px 0;
}

iframe {
  height: 100%;
  width: 100%;
}

.container {
  display: flex;
  justify-content: space-between;
  align-items: stretch;
  max-width: 1200px;
  margin: 0 auto;
  gap: 30px;
}

.footer-section {
  background-color: #696969bb;
  padding: 20px;
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
  color: #f89616;
}

.social-icons a {
  margin-right: 15px;
  font-size: 24px;
  color: white;
  transition: color 0.3s;
}

.social-icons a:hover {
  color: #f89616;
}

footer p {
  margin-top: 20px;
  font-size: 14px;
  color: #ccc;
}

/* Stile per la sezione mappa */
// .map-section {
//   flex: 1;
// }

// .map-container {
//   width: 300px;
//   height: 200px;
//   margin-top: 10px;
//   border-radius: 8px;
//   overflow: hidden;
//   box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
// }
</style>
