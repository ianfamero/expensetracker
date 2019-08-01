<template>
  <section class="section">
    <div class="container">
      <div>
        <h1>PHP {{ user.savings_amount + user.spendable_amount + user.receivable_amount }}</h1>
        <h2>Total Funds</h2>
        <b-button type="is-primary" @click="showAddFundModal">Add Fund</b-button>
      </div>
      <div>
        <b-table :data="summary" :columns="columns"></b-table>
        <b-button type="is-primary" @click="showTransferFundModal">Transfer Funds</b-button>
      </div>
    </div>
    <add-fund-modal ref="fund"></add-fund-modal>
    <transfer-fund-modal ref="fundtransfer"></transfer-fund-modal>
  </section> 
</template>

<script>
var URL = '/funds/';
export default {
  data() {
    return {
      user: [],
      summary: [],
      columns: [
        {
          field: 'name',
          label: '',
        },
        {
          field: 'amount',
          label: 'Amount',
        },
      ]
    }
  },
  created() {
    document.title = "Funds";
    this.getDatas();
  },
  methods: {
    getDatas: function() {
      axios.get(URL + 'get-datas')
      .then(response => {
        this.user = response.data.user;
        this.summary = response.data.summary;
      }).catch(error => {

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
