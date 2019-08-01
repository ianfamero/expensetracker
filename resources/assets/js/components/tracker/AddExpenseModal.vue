<template>
  <b-modal :active.sync="isShowModal" has-modal-card>
    <div class="modal-card" style="margin: 0 auto; max-width: 90%; width: 800px">
      <header class="modal-card-head">
          <p class="modal-card-title">Add Expense</p>
      </header>
      <section class="modal-card-body">

      </section>
      <footer class="modal-card-foot">

      </footer>
    </div>
  </b-modal>
</template>

<script>
export default {
  data() {
    return {
      isShowModal: false,
    }
  },
  methods: {
    showModal: function() {
      Vue.nextTick(() => this.isShowModal = true);
    }
  }
}
</script>
