<template>
  <div>
    <nav class="navbar" role="navigation" aria-label="main navigation">
      <div class="navbar-brand">
        <a href="#" class="navbar-item"><h3><strong>EXPENSE TRACKER</strong></h3></a>
        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="main-menu">
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
        </a>
      </div>
      <div id="main-menu" class="navbar-menu">
        <div class="navbar-start">
          <router-link class="navbar-item" to="/tracker">Tracker</router-link>
          <router-link class="navbar-item" to="/funds">Funds</router-link>
        </div>
        <div class="navbar-end">
          <div class="navbar-item has-dropdown is-hoverable">
            <a class="navbar-link">Ian Benedict</a>
            <div class="navbar-dropdown">
              <a class="navbar-item">My Profile</a>
              <hr class="navbar-divider">
              <a class="navbar-item">Logout</a>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </div> 
</template>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
  if ($navbarBurgers.length > 0) {
    $navbarBurgers.forEach( el => {
      el.addEventListener('click', () => {
        const target = el.dataset.target;
        const $target = document.getElementById(target);
        el.classList.toggle('is-active');
        $target.classList.toggle('is-active');
      });
    });
  }
});
export default {
  data() {
    return {
        
    }
  }
}
</script>
