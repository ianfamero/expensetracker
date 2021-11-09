<template>
  <b-modal :active.sync="isShowModal" has-modal-card>
    <div class="modal-card" style="margin: 0 auto; max-width: 90%; width: 800px">
      <header class="modal-card-head">
          <p class="modal-card-title">Transfer Funds</p>
      </header>
      <section class="modal-card-body">
        <div>
          <div class="columns">
            <div class="column">
              <b-field label="Source" :type="{ 'is-danger': this.$root.validator(formError.source) }" :message="{ [formError.source] : this.$root.validator(formError.source) }">
                <b-select placeholder="Select" v-model="formData.source" expanded>
                  <option
                    v-for="option in type"
                    :value="option.id"
                    :key="option.id">
                    {{ option.value }}
                  </option>
                </b-select>
              </b-field>
            </div>
            <div class="column">
              <b-field label="Destination" :type="{ 'is-danger': this.$root.validator(formError.destination) }" :message="{ [formError.destination] : this.$root.validator(formError.destination) }">
                <b-select placeholder="Select" v-model="formData.destination" expanded>
                  <option
                    v-for="option in type"
                    :value="option.id"
                    :key="option.id">
                    {{ option.value }}
                  </option>
                </b-select>
              </b-field>
            </div>
          </div>
          <b-field label="Amount" :type="{ 'is-danger': this.$root.validator(formError.amount) }" :message="{ [formError.amount] : this.$root.validator(formError.amount) }">
            <b-input type="text" v-model="formData.amount"></b-input>
          </b-field>
        </div>
      </section>
      <footer class="modal-card-foot">
        <button class="button" type="button" @click="closeModal">Close</button>
        <b-button type="is-primary" @click="transferFunds">Transfer</b-button>
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
      isShowModal: false,
      type: [
        {
          id: 0,
          value: 'Savings'
        },
        {
          id: 1,
          value: 'Spendable'
        },
        {
          id: 2,
          value: 'Receivable'
        },
      ],
       formError: '',
    }
  },
  methods: {
    initFormData: function() {
      return {
        source: '',
        destination: '',
        amount: '',
      }
    },
    transferFunds: function() {
      let source = _.find(this.type, {'id': this.formData.source});
      let destination = _.find(this.type, {'id': this.formData.destination});
      axios.post(URL + 'transfer', this.formData)
      .then(response => {
        this.formError = [];
        this.$root.showToast('is-success', 'Success! An amount of &#8369;' + this.formData.amount + ' has been transfered to your ' + destination.value.toLowerCase() + ' funds.');
        this.formData = this.initFormData();
        this.$parent.getDatas();
        this.isShowModal = false;
      }).catch(error => {
        if (error.response.status == 422) {
          this.formError = error.response.data;
        } else if(error.response.status == 400) {
          this.$root.showToast('is-danger', 'Insufficient funds!');
        } else if(error.response.status == 405) {
          this.$root.showToast('is-danger', 'You cannot transfer from the same source and destination!');
        } else {
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
