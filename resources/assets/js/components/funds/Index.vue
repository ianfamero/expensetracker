<template>
  <section class="section">
    <div class="container">
      <div class="page-top">
        <h1 class="title is-1" v-if="!isLoading">&#8369; {{ user.savings_amount + user.spendable_amount + user.receivable_amount | numberFormat }}</h1>
        <h5 class="subtitle is-5">Total Funds</h5>
        <b-button type="is-primary" @click="showAddFundModal">Add Fund</b-button>
      </div>
      <div class="card">
        <div class="card-content">
          <b-table :data="summary" hoverable>
            <template slot-scope="props">
              <b-table-column field="name" label="" sortable>
                {{ props.row.name }}
              </b-table-column>
              <b-table-column field="amount" label="Amount" width="250" sortable>
                &#8369; {{ props.row.amount  | numberFormat }}
              </b-table-column>
            </template>
          </b-table>
          
          <br><br>
          <b-button type="is-primary" @click="showTransferFundModal">Transfer Funds</b-button>
        </div>
      </div>
    </div>
    <add-fund-modal ref="fund"></add-fund-modal>
    <transfer-fund-modal ref="fundtransfer"></transfer-fund-modal>
    <b-loading :is-full-page="true" :active.sync="isLoading" :can-cancel="true"></b-loading>
  </section> 
</template>

<script>
var URL = '/funds/';
export default {
  data() {
    return {
      user: [],
      summary: [],
      isLoading: false,
    }
  },
  created() {
    document.title = "Funds";
    this.getDatas();
  },
  methods: {
    getDatas: function() {
      this.isLoading = true;
      axios.get(URL + 'get-datas')
      .then(response => {
        this.user = response.data.user;
        this.summary = response.data.summary;
        this.isLoading = false;
      }).catch(error => {
        this.isLoading = false;
      });
    },
    showAddFundModal: function() {
      this.$refs.fund.showModal();
    },
    showTransferFundModal: function() {
      this.$refs.fundtransfer.showModal();
    }
  }
}
</script>
