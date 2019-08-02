<template>
  <b-modal :active.sync="isShowModal" has-modal-card>
    <div class="modal-card" style="margin: 0 auto; max-width: 90%; width: 800px">
      <header class="modal-card-head">
        <p class="modal-card-title">Add Fund</p>
      </header>
      <section class="modal-card-body">
        <b-field label="Amount" :type="{ 'is-danger': this.$root.validator(formError.amount) }" :message="{ [formError.amount] : this.$root.validator(formError.amount) }">
          <b-input type="text" v-model="formData.amount"></b-input>
        </b-field>
      </section>
      <footer class="modal-card-foot">
        <button class="button" type="button" @click="closeModal">Close</button>
        <b-button type="is-primary" @click="addFund">Add</b-button>
      </footer>
    </div>
  </b-modal>
</template>

<script>
var URL = '/funds/';
export default {
  data() {
    return {
      formData: this.initFormData(),
      formError: '',
      isShowModal: false,
    }
  },
  methods: {
    initFormData: function() {
      return {
        amount: '',
      }
    },
    addFund: function() {
      axios.post(URL + 'add', this.formData)
      .then(response => {
        this.formError = [];
        this.$root.showToast('is-success', 'Success! An amount of &#8369;' + this.formData.amount + ' has been added to your spendable funds.');
        this.formData = this.initFormData();
        this.$parent.getDatas();
        this.isShowModal = false;
      }).catch(error => {
        if (error.response.status == 422) {
          this.formError = error.response.data;
        }  else {
          this.$root.showToast('is-danger', 'Failed. Please try again.');
        }
      });
    },
    showModal: function() {
      Vue.nextTick(() => this.isShowModal = true);
    },
    closeModal: function() {
      this.isShowModal = false;
      this.formData = this.initFormData();
      this.formError = [];
    }
  }
}
</script>
