<template>
  <b-modal :active.sync="isShowModal" has-modal-card>
    <div class="modal-card" style="margin: 0 auto; max-width: 90%; width: 800px">
      <header class="modal-card-head">
          <p class="modal-card-title">Add Expense</p>
      </header>
      <section class="modal-card-body">
        <b-field label="Amount" :type="{ 'is-danger': this.$root.validator(formError.expense_amount) }" :message="{ [formError.expense_amount] : this.$root.validator(formError.expense_amount) }">
          <b-input type="text" v-model="formData.expense_amount"></b-input>
        </b-field>
        <b-field label="Description" :type="{ 'is-danger': this.$root.validator(formError.expense_description) }" :message="{ [formError.expense_description] : this.$root.validator(formError.expense_description) }">
          <b-input type="text" v-model="formData.expense_description"></b-input>
        </b-field>
      </section>
      <footer class="modal-card-foot">
        <button class="button" type="button" @click="closeModal">Close</button>
        <b-button type="is-primary" @click="addExpense">Add</b-button>
      </footer>
    </div>
  </b-modal>
</template>

<script>
var URL = '/tracker/';
export default {
  data() {
    return {
      isShowModal: false,
      formError: '',
      formData: this.initFormData()
    }
  },
  methods: {
    initFormData: function() {
      return {
        expense_description: '',
        expense_amount: '',
        expense_date: '',
      }
    },
    addExpense: function() {
      this.formData.expense_date = moment(this.formData.expense_date).format("YYYY/MM/DD");
      axios.post(URL + 'add', this.formData)
      .then(response => {
        this.formError = [];
        this.$root.showToast('is-success', 'Success! An amount of &#8369;' + this.formData.expense_amount + ' has been deducted from your spendable funds.');
        this.formData = this.initFormData();
        this.$parent.getDatas();
        this.isShowModal = false;
      }).catch(error => {
        if (error.response.status == 422) {
          this.formError = error.response.data;
        } else if (error.response.status == 400) {
          this.$root.showToast('is-danger', 'Insufficient funds!');
        } else {
          this.$root.showToast('is-danger', 'Failed. Please try again.');
        }
      });
    },
    showModal: function(date) {
      this.formData.expense_date = date;
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
