<template>
  <section class="section">
    <div class="container">
      <div>
        <h1>PHP {{ user.spendable_amount }}</h1>
        <h2>Spendable Funds</h2>
        <b-button type="is-primary" @click="showAddExpenseModal(date)">Add Expense</b-button>
      </div>
      <div><br>
        <b-field>
          <b-datepicker icon="calendar-today" style="width: 300px" v-model="date"></b-datepicker>
        </b-field>
        <b-table :data="expenses" :columns="columns"></b-table>
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
      expenses: [],
      columns: [
        {
          field: 'expense_description',
          label: 'Description',
        },
        {
          field: 'expense_amount',
          label: 'Amount',
        }
      ],
      date: new Date(),
    }
  },
  watch: {
    date: function() {
      this.getDatas();
    }
  },
  created() {
    document.title = "Tracker";
    this.getDatas();
  },
  methods: {
    getDatas: function() {
      axios.post(URL + 'get-datas', {date: moment(this.date).format("YYYY/MM/DD")})
      .then(response => {
        this.user = response.data.user;
        this.expenses = response.data.expenses;
      }).catch(error => {

      });
    },
    getDate: function() {
      return moment(new Date()).format("YYYY/MM/DD");
    },
    showAddExpenseModal: function(date) {
      this.$refs.expense.showModal(date);
    },
  }
}
</script>
