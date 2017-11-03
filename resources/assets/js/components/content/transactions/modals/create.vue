<template lang="pug">
  #create-transaction-modal.modal
    .modal-dialog
      .modal-content
        .modal-header
          button.close(type='button', data-dismiss='modal', aria-label='Close')
            span(aria-hidden='true') ×
          h4.modal-title Create Transaction
        .modal-body
          form#storeTransactionForm(name='storeTransactionForm', role='form')
            .box-body
              .row
                .col-lg-6
                  .form-group
                    label(for='name') Name
                    input#name.form-control(type='text', name='name', placeholder='e.g. Mortgage', v-model='transaction.name')
                  .form-group
                    label(for='description') Description
                    input#description.form-control(type='text', name='description', placeholder='e.g. That big payment every month.', v-model='transaction.description')
                  .form-group
                    label(for='category') Category
                    select#category.form-control(name='category', v-model='transaction.category_id')
                      option(v-bind:value='category.id', v-for='category in categories')
                        | {{ category.name }}
                  .form-group
                    label(for='category') Account
                    select#account.form-control(name='account', v-model='transaction.account_id')
                      option(v-bind:value='account.id', v-for='account in accounts')
                        | {{ account.name }}
                  .form-group(v-if='transaction.category_id == 1')
                    label(for='category') Destination Account
                    select#category.form-control(name='category', v-model='transaction.destination_account_id')
                      option(v-bind:value='account.id', v-for='account in accounts')
                        | {{ account.name }}
                  .form-group
                    label(for='frequency') Frequency
                    select#frequency.form-control(name='frequency', v-model='transaction.transaction_frequency_id')
                      option(v-bind:value='frequency.id', v-for='frequency in frequencies')
                        | {{ frequency.name }}
                .col-lg-6
                  .form-group
                    label(for='amount') Amount
                    .input-group
                      span.input-group-addon
                        i.fa.fa-dollar
                      input#amount.form-control(type='text', name='amount', placeholder='e.g. 10.25', v-model='transaction.amount')
                  .form-group
                    label(for='occurredAt') Occurred At
                    .input-group
                      .input-group-addon
                        i.fa.fa-calendar
                      input#occurredAt.form-control(type='date', name='occurredAt', v-model='transaction.occurred_at')
                  .form-group(v-if='transaction.transaction_frequency_id > 1')
                    label(for='repeatStartAt') Repeat Start At
                    .input-group
                      .input-group-addon
                        i.fa.fa-calendar
                      input#repeatStartAt.form-control(type='date', name='repeatStartAt', v-model='transaction.repeat_start_at')
                  .form-group(v-if='transaction.transaction_frequency_id > 1')
                    label(for='repeatEndAt') Repeat End At
                    .input-group
                      .input-group-addon
                        i.fa.fa-calendar
                      input#repeatEndAt.form-control(type='date', name='repeatEndAt', v-model='transaction.repeat_end_at')
        .modal-footer
          button.btn.btn-danger.pull-left(type='button', data-dismiss='modal') Close
          button.btn.btn-success(type='button', v-on:click='storeTransaction') Create
</template>

<script>
  export default {
    mounted() {
      // load the accounts
      this.$http.get('http://local.finance-projections.com/api/account')
        .then(
          function (successResponse) {
            this.accounts = successResponse.body.results;
          },
          function (failedResponse) {
            console.log(failedResponse);
          }
        );

      // load the categories
      this.$http.get('http://local.finance-projections.com/api/category')
        .then(
          function (successResponse) {
            this.categories = successResponse.body.results;
          },
          function (failedResponse) {
            console.log(failedResponse);
          }
        );

      // load the frequencies
      this.$http.get('http://local.finance-projections.com/api/transaction/frequency')
        .then(
          function (successResponse) {
            this.frequencies = successResponse.body.results;
          },
          function (failedResponse) {
            console.log(failedResponse);
          }
        );
    },
    methods: {
      storeTransaction: function () {
        let params = this.transaction;

        if(params.destination_account_id.selected === 0){
          delete params.destination_account_id;
        }

        if(!params.repeat_start_at){
          delete params.repeat_start_at;
        }

        if(!params.repeat_end_at){
          delete params.repeat_end_at;
        }

        this.$http.post(
          'http://local.finance-projections.com/api/transaction',
          params
          )
          .then(
            function (successResponse) {
              this.$parent.$parent.transactions.push(successResponse.body.results);
              $('#create-transaction-modal').modal('hide');
            },
            function (failedResponse) {
              console.log(failedResponse);
            }
          );

        this.transaction = {
          account_id: 0,
          category_id: 0,
          transaction_frequency_id: 0,
          name: '',
          description: '',
          amount: 0,
          occurred_at: null,
        };
      }
    },
    data() {
      return {
        transaction: {
          account_id: {
            selected: 0,
            options: [
              { id: 0, name: '' }
            ]
          },
          destination_account_id: {
            selected: 0,
            options: [
              { id: 0, name: '' }
            ]
          },
          category_id: {
            selected: 0,
            options: [
              { id: 0, name: '' }
            ]
          },
          transaction_frequency_id: {
            selected: 0,
            options: [
              { id: 0, name: '' }
            ]
          },
          name: '',
          description: '',
          amount: 0,
          occurred_at: null,
          repeat_start_at: null,
          repeat_end_at: null
        },
        accounts: [],
        categories: [],
        frequencies: []
      };
    }
  }
</script>
