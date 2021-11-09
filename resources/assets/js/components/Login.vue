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
                    <b-field label="Email" :type="{ 'is-danger': this.$root.validator(loginFormError.email) }" :message="{ [loginFormError.email] : this.$root.validator(loginFormError.email) }">
                      <b-input type="email" v-model="loginFormData.email"></b-input>
                    </b-field>
                    <b-field label="Password" :type="{ 'is-danger': this.$root.validator(loginFormError.password) }" :message="{ [loginFormError.password] : this.$root.validator(loginFormError.password) }">
                      <b-input type="password" v-model="loginFormData.password"></b-input>
                    </b-field>
                    <b-button type="is-primary" @click="login">Login</b-button>
                  </b-tab-item>

                  <b-tab-item label="Register">
                    <b-field label="Name" :type="{ 'is-danger': this.$root.validator(registerFormError.name) }" :message="{ [registerFormError.name] : this.$root.validator(registerFormError.name) }">
                      <b-input type="name" v-model="registerFormData.name"></b-input>
                    </b-field>
                    <b-field label="Username" :type="{ 'is-danger': this.$root.validator(registerFormError.username) }" :message="{ [registerFormError.username] : this.$root.validator(registerFormError.username) }">
                      <b-input type="username" v-model="registerFormData.username"></b-input>
                    </b-field>
                    <b-field label="Email" :type="{ 'is-danger': this.$root.validator(registerFormError.email) }" :message="{ [registerFormError.email] : this.$root.validator(registerFormError.email) }">
                      <b-input type="email" v-model="registerFormData.email"></b-input>
                    </b-field>
                    <b-field label="Password" :type="{ 'is-danger': this.$root.validator(registerFormError.password) }" :message="{ [registerFormError.password] : this.$root.validator(registerFormError.password) }">
                      <b-input type="password" v-model="registerFormData.password"></b-input>
                    </b-field>
                    <b-button type="is-primary" @click="register">Register</b-button>
                  </b-tab-item>

                </b-tabs>
              </div>
              <b-loading :is-full-page="false" :active.sync="isLoading" :can-cancel="true"></b-loading>
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
        loginFormData: this.initLoginFormData(),
        registerFormData: this.initRegisterFormData(),
        loginFormError: '',
        registerFormError: '',
        activeTab: 0,
        isLoading: false,
      }
    },
    created() {
      document.title = "Expense Tracker";
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
        axios.post('/login', this.loginFormData)
        .then(response => {
          window.location.href = "/tracker";
        }).catch(error => {
          if (error.response.status == 422) {
            this.loginFormError = error.response.data;
          } else {
            this.loginFormError = [];
            this.$root.showToast('is-danger', 'Incorrect username/password');
          }
        });
      },
      register: function() {
        this.isLoading = true;
        axios.post('/register', this.registerFormData)
        .then(response => {
          this.registerFormData = [];
          this.registerFormError = [];
          this.isLoading = false;
          this.$root.showToast('is-success', 'Registration successful!');
        }).catch(error => {
          if (error.response.status == 422) {
            this.registerFormError = error.response.data;
          }  else {
            this.$root.showToast('is-danger', 'Registration not successful!');
          }
          this.isLoading = false;
        });
      }
    }
  }
</script>