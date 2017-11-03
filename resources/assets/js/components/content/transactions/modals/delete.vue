<template lang="pug">
  #delete-transaction-modal.modal
    .modal-dialog
      .modal-content
        .modal-header
          button.close(type='button', data-dismiss='modal', aria-label='Close')
            span(aria-hidden='true') ×
          h4.modal-title Delete Transaction
        .modal-body
          | Are you sure you want to delete this Transaction.
        .modal-footer
          button.btn.btn-danger.pull-left(type='button', data-dismiss='modal') Close
          button.btn.btn-success(type='button', v-on:click='destroyTransaction') Delete
</template>

<script>
  export default {
    methods: {
      destroyTransaction: function () {
        this.$http.delete(
            'http://local.finance-projections.com/api/transaction/' + this.$parent.deletingTransaction.id
          )
          .then(
            function (successResponse) {
              this.$parent.$parent.transactions = this.$parent.$parent.transactions.filter(
                transaction => transaction.id !== this.$parent.deletingTransaction.id
              );

              $('#delete-transaction-modal').modal('hide');
            },
            function (failedResponse) {
              console.log(failedResponse);
            }
          );
      }
    }
  }
</script>
