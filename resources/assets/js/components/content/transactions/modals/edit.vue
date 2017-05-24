<template lang="pug">
  #edit-transaction-modal.modal
    .modal-dialog
      .modal-content
        .modal-header
          button.close(type='button', data-dismiss='modal', aria-label='Close')
            span(aria-hidden='true') ×
          h4.modal-title Edit Transaction
        .modal-body
          form#edit-transaction-form(name='editTransactionForm', role='form')
            .box-body
              .form-group
                label(for='name') Name
                input#name.form-control(type='text', name='name', placeholder='Name', v-model='$parent.editingTransaction.name')
              .form-group
                label(for='description') Description
                input#description.form-control(type='text', name='description', placeholder='Description', v-model='$parent.editingTransaction.description')
        .modal-footer
          button.btn.btn-danger.pull-left(type='button', data-dismiss='modal') Close
          button.btn.btn-success(type='button', v-on:click='updateTransaction') Save
</template>

<script>
  export default {
    methods: {
      updateTransaction: function () {
        this.$http.put(
            'http://local-finance-projections.com/api/transaction/' + this.$parent.editingTransaction.id,
            this.$parent.editingTransaction
          )
          .then(
            function (successResponse) {
              $('#edit-transaction-modal').modal('hide');
            },
            function (failedResponse) {
              console.log(failedResponse);
            }
          );
      }
    }
  }
</script>
