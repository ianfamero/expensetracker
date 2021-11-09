<template>
  <div>
    <nav class="navbar is-primary" role="navigation" aria-label="main navigation">
      <div class="navbar-brand">
        <a class="navbar-item" href="/"><h3><strong>EXPENSE TRACKER</strong></h3></a>
        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="main-menu" @click="isOpen = !isOpen" v-bind:class="{'is-active': isOpen}">
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
        </a>
      </div>
      <div id="main-menu" class="navbar-menu" :class="{'is-active': isOpen}">
        <div class="navbar-start">
          <router-link class="navbar-item" to="/tracker">Tracker</router-link>
          <router-link class="navbar-item" to="/funds">Funds</router-link>
          <router-link class="navbar-item" to="/debts">Debts</router-link>
        </div>
        <div class="navbar-end">
          <div class="navbar-item has-dropdown is-hoverable">
            <a class="navbar-link">{{ user.name }}</a>
            <div class="navbar-dropdown is-right">
              <a class="navbar-item">My Reports</a>
              <a class="navbar-item">Transactions History</a>
              <hr class="navbar-divider">
              <a class="navbar-item" href="/logout">Logout</a>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </div> 
</template>

<script>
export default {
  data() {
    return {
      user: [],
      isOpen: false,
    }
  },
  created() {
    this.getUser();
  },
  watch: {
    '$route' () {
      this.isOpen = false;
    }
  },
  methods: {
    getUser: function() {
      axios.get('/get-user')
      .then(response => {
        this.user = response.data.user;
      }).catch(error => {

      });
    },
  }
}
</script>
