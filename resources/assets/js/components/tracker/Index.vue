<template>
  <section class="section">
    <div class="container">
      <div class="page-top">
        <h1 class="title is-1" v-if="!isLoading">&#8369; {{ user.spendable_amount | numberFormat }}</h1>
        <h5 class="subtitle is-5">Spendable Funds</h5>
        <b-button type="is-primary" @click="showAddExpenseModal(date, null)">Add Expense</b-button>
        <br><br><b-datepicker icon="calendar-today" class="tracker-datepicker" v-model="date" :date-formatter="(date) => dateFormat(date)"></b-datepicker>
      </div>
      <div class="card">
        <div class="card-content">
          <b-table :data="expenses" 
            :paginated="isPaginated"
            :per-page="perPage"
            :current-page.sync="currentPage"
            :pagination-simple="isPaginationSimple"
            :pagination-position="paginationPosition"
            aria-next-label="Next page"
            aria-previous-label="Previous page"
            aria-page-label="Page"
            aria-current-label="Current page"
            hoverable>
            <template slot-scope="props">
              <b-table-column field="expense_description" label="Description" sortable>
                {{ props.row.expense_description }}
              </b-table-column>
              <b-table-column field="expense_amount" label="Amount" width="250" class="semi-bold-18" sortable>
                &#8369; {{ props.row.expense_amount  | numberFormat }}
              </b-table-column>
              <b-table-column label="Actions" width="100">
                <b-button @click.native="del(props.row.id)" class="is-danger" size="is-small"><i class="fa fa-trash"></i></b-button>
                <b-button @click.native="showAddExpenseModal(null, props.row)" class="is-primary" size="is-small"><i class="fa fa-edit"></i></b-button>
              </b-table-column>
            </template>
            <template slot="empty">
              No expense today so far. Good job!
            </template>
            <template slot="footer">
              <div class="semi-bold-18">
                Total: &#8369; {{ total | numberFormat }}
              </div>
            </template>
          </b-table>
        </div>
      </div>
    </div>
    <add-expense-modal ref="expense"></add-expense-modal>
    <b-loading :is-full-page="true" :active.sync="isLoading" :can-cancel="true"></b-loading>
  </section>
</template>

<script>
var URL = '/tracker/';
export default {
  data() {
    return {
      user: [],
      expenses: [],
      total: '',
      date: new Date(),
      isLoading: false,
      isPaginated: true,
      isPaginationSimple: false,
      paginationPosition: 'bottom',
      defaultSortDirection: 'asc',
      currentPage: 1,
      perPage: 15
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
    del: function(id) {
      this.isLoading = true;
      axios.get(URL + 'delete/' + id)
      .then(response => {
        this.isLoading = false;
        this.getDatas();
      }).catch(error => {
        this.isLoading = false;
      });
    },
    getDatas: function() {
      this.isLoading = true;
      axios.post(URL + 'get-datas', {date: moment(this.date).format("YYYY/MM/DD")})
      .then(response => {
        this.user = response.data.user;
        this.expenses = response.data.expenses;
        this.total = response.data.total;
        this.isLoading = false;
      }).catch(error => {
        this.isLoading = false;
      });
    },
    getDate: function() {
      return moment(new Date()).format("YYYY/MM/DD");
    },
    dateFormat: function(date) {
      return moment(date).format('MMMM D, YYYY');
    },
    showAddExpenseModal: function(date, data) {
      this.$refs.expense.showModal(date, data);
    },
  }
}
</script>
