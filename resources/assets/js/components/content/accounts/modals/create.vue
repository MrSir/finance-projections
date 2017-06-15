<template lang="pug">
  #create-account-modal.modal
    .modal-dialog
      .modal-content
        .modal-header
          button.close(type='button', data-dismiss='modal', aria-label='Close')
            span(aria-hidden='true') ×
          h4.modal-title Create Account
        .modal-body
          form#storeAccountForm(name='storeAccountForm', role='form')
            .box-body
              .form-group
                label(for='name') Name
                input#name.form-control(type='text', name='name', placeholder='Name', v-model='account.name')
              .form-group
                label(for='description') Description
                input#description.form-control(type='text', name='description', placeholder='Description', v-model='account.description')
        .modal-footer
          button.btn.btn-danger.pull-left(type='button', data-dismiss='modal') Close
          button.btn.btn-success(type='button', v-on:click='storeAccount') Create
</template>

<script>
  export default {
    methods: {
      storeAccount: function () {
        this.$http.post(
          'http://local.finance-projections.com/api/account',
          this.account
          )
          .then(
            function (successResponse) {
              console.log(successResponse.body.results);
              this.$parent.$parent.accounts.push(successResponse.body.results);
              $('#create-account-modal').modal('hide');
            },
            function (failedResponse) {
              console.log(failedResponse);
            }
          );

        this.account = {
          name: '',
          description: ''
        };
      }
    },
    data() {
      return {
        account: {
          name: '',
          description: ''
        }
      };
    }

  }
</script>
