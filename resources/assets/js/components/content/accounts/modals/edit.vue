<template lang="pug">
  #edit-account-modal.modal
    .modal-dialog
      .modal-content
        .modal-header
          button.close(type='button', data-dismiss='modal', aria-label='Close')
            span(aria-hidden='true') ×
          h4.modal-title Edit Account
        .modal-body
          form#edit-account-form(name='editAccountForm', role='form')
            .box-body
              .form-group
                label(for='name') Name
                input#name.form-control(type='text', name='name', placeholder='Name', v-model='$parent.editingAccount.name')
              .form-group
                label(for='description') Description
                input#description.form-control(type='text', name='description', placeholder='Description', v-model='$parent.editingAccount.description')
              .form-group
                label(for='balance') Balance
                .input-group
                  span.input-group-addon
                    i.fa.fa-dollar
                  input#balance.form-control(type='text', name='balance', placeholder='$1000.00', v-model='$parent.editingAccount.balance')
                | Last Updated: {{ $parent.editingAccount.balanceLastUpdated }}
        .modal-footer
          button.btn.btn-danger.pull-left(type='button', data-dismiss='modal') Close
          button.btn.btn-success(type='button', v-on:click='updateAccount') Save
</template>

<script>
  export default {
    methods: {
      updateAccount: function () {
        this.$http.put(
            'http://local.finance-projections.com/api/account/' + this.$parent.editingAccount.id,
            this.$parent.editingAccount
          )
          .then(
            function (successResponse) {
              $('#edit-account-modal').modal('hide');
            },
            function (failedResponse) {
              console.log(failedResponse);
            }
          );
      }
    }
  }
</script>
