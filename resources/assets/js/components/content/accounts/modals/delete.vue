<template lang="pug">
  #delete-account-modal.modal
    .modal-dialog
      .modal-content
        .modal-header
          button.close(type='button', data-dismiss='modal', aria-label='Close')
            span(aria-hidden='true') ×
          h4.modal-title Delete Account
        .modal-body
          | Are you sure you want to delete this Account.
        .modal-footer
          button.btn.btn-danger.pull-left(type='button', data-dismiss='modal') Close
          button.btn.btn-success(type='button', v-on:click='destroyAccount') Delete
</template>

<script>
  export default {
    methods: {
      destroyAccount: function () {
        this.$http.delete(
            'http://local.finance-projections.com/api/account/' + this.$parent.deletingAccount.id
          )
          .then(
            function (successResponse) {
              this.$parent.$parent.accounts = this.$parent.$parent.accounts.filter(
                account => account.id !== this.$parent.deletingAccount.id
              );

              $('#delete-account-modal').modal('hide');
            },
            function (failedResponse) {
              console.log(failedResponse);
            }
          );
      }
    }
  }
</script>
