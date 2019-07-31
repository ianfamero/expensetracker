<template>
  <div>
    <section class="section">
      <div class="container">
        <div class="columns">
          <div class="column is-6 is-offset-1">
            <div class="card">
                <div class="card-header">
                  <div class="card-header-title">EXPENSE TRACKER</div>
                </div>
                <div class="card-content">
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque ab aliquid ducimus ratione molestias saepe maxime labore porro cumque esse assumenda quas asperiores itaque vitae iure adipisci, aperiam sed? Natus.
                </div>
            </div>
          </div>
          <div class="column is-4">
            <div class="card">
                <div class="card-content">
                  <b-tabs v-model="activeTab">
                    <b-tab-item label="Login">
                      <b-field label="Email">
                        <b-input type="email" v-model="loginFormData.email"></b-input>
                      </b-field>
                      <b-field label="Password">
                        <b-input type="password" v-model="loginFormData.password"></b-input>
                      </b-field>
                      <b-button type="is-primary" @click="login">Login</b-button>
                    </b-tab-item>
                    <b-tab-item label="Register">
                      <b-field label="Name">
                        <b-input type="name" v-model="registerFormData.name"></b-input>
                      </b-field>
                      <b-field label="Username">
                        <b-input type="username" v-model="registerFormData.username"></b-input>
                      </b-field>
                      <b-field label="Email">
                        <b-input type="email" v-model="registerFormData.email"></b-input>
                      </b-field>
                      <b-field label="Password">
                        <b-input type="password" v-model="registerFormData.password"></b-input>
                      </b-field>
                      <b-button type="is-primary" @click="register">Register</b-button>
                    </b-tab-item>
                  </b-tabs>
                </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        activeTab: 0,
        loginFormData: this.initLoginFormData(),
        registerFormData: this.initRegisterFormData(),
      }
    },
    created() {
      document.title = "Login";
    },
    methods: {
      initLoginFormData: function() {
        return {
          email: '',
          password: '',
        }
      },
      initRegisterFormData: function() {
        return {
          name: '',
          username: '',
          email: '',
          password: '',
        }
      },
      login: function() {

      },
      register: function() {

      }
    }
  }
</script>