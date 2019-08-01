<template>
  <section class="section">
    <div class="container">
      <div>
        <h1>PHP {{ user.savings_amount }}</h1>
        <b-button @click="showAddExpenseModal">Add Expense</b-button>
      </div>

    </div>
    <add-expense-modal ref="expense"></add-expense-modal>
  </section>
</template>

<script>
var URL = '/tracker/';
export default {
  data() {
    return {
      user: [],
    }
  },
  created() {
    document.title = "Tracker";
    this.getDatas();
  },
  methods: {
    getDatas: function() {
      axios.get(URL + 'get-datas')
      .then(response => {
        this.user = response.data.user;
      }).catch(error => {

      });
    },
    showAddExpenseModal: function() {
      this.$refs.expense.showModal();
    },
  }
}
</script>
