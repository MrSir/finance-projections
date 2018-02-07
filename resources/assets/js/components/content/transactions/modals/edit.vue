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
              .row
                .col-lg-6
                  .form-group
                    label(for='name') Name
                    input#name.form-control(type='text', name='name', placeholder='Name', v-model='$parent.editingTransaction.name')
                  .form-group
                    label(for='description') Description
                    input#description.form-control(type='text', name='description', placeholder='Description', v-model='$parent.editingTransaction.description')
                  .form-group
                    label(for='category') Category
                    select#category.form-control(name='category', v-model='$parent.editingTransaction.category_id')
                      option(v-bind:value='category.id', v-for='category in $parent.categories')
                        | {{ category.name }}
                  .form-group
                    label(for='category') Account
                    select#account.form-control(name='account', v-model='$parent.editingTransaction.account_id')
                      option(v-bind:value='account.id', v-for='account in $parent.accounts')
                        | {{ account.name }}
                  .form-group(v-if='$parent.editingTransaction.category_id == 1')
                    label(for='category') Destination Account
                    select#destination_account_id.form-control(name='destination_account_id', v-model='$parent.editingTransaction.destination_account_id')
                      option(v-bind:value='account.id', v-for='account in $parent.accounts')
                        | {{ account.name }}
                  .form-group
                    label(for='frequency') Frequency
                    select#frequency.form-control(name='frequency', v-model='$parent.editingTransaction.transaction_frequency_id')
                      option(v-bind:value='frequency.id', v-for='frequency in $parent.frequencies')
                        | {{ frequency.name }}
                .col-lg-6
                  .form-group
                    label(for='amount') Amount
                    .input-group
                      span.input-group-addon
                        i.fa.fa-dollar
                      input#amount.form-control(type='text', name='amount', placeholder='e.g. 10.25', v-model='$parent.editingTransaction.amount')
                  .form-group
                    label(for='occurredAt') Occurred At
                    .input-group
                      .input-group-addon
                        i.fa.fa-calendar
                      input#occurredAt.form-control(type='date', name='occurredAt', v-model='$parent.editingTransaction.occurred_at')
                  .form-group(v-if='$parent.editingTransaction.transaction_frequency_id > 1')
                    label(for='repeatStartAt') Repeat Start At
                    .input-group
                      .input-group-addon
                        i.fa.fa-calendar
                      input#repeatStartAt.form-control(type='date', name='repeatStartAt', v-model='$parent.editingTransaction.repeat_start_at')
                  .form-group(v-if='$parent.editingTransaction.transaction_frequency_id > 1')
                    label(for='repeatEndAt') Repeat End At
                    .input-group
                      .input-group-addon
                        i.fa.fa-calendar
                      input#repeatEndAt.form-control(type='date', name='repeatEndAt', v-model='$parent.editingTransaction.repeat_end_at')
        .modal-footer
          button.btn.btn-danger.pull-left(type='button', data-dismiss='modal') Close
          button.btn.btn-success(type='button', v-on:click='updateTransaction') Save
</template>

<script>
  export default {
    methods: {
      updateTransaction: function () {
        let theTransaction = Object.assign({}, this.$parent.editingTransaction);

        if (theTransaction.destination_account_id == null || theTransaction.destination_account_id === 0) {
          delete theTransaction.destination_account_id;
        }

        if (theTransaction.repeat_start_at == null) {
          delete theTransaction.repeat_start_at;
        }

        if (theTransaction.repeat_end_at == null) {
          delete theTransaction.repeat_end_at;
        }

        this.$http.put(
            'http://local.finance-projections.com/api/transaction/' + theTransaction.id,
            theTransaction
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
