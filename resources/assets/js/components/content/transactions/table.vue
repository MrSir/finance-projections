<template lang="pug">
  #transactionsTableTemplate
    .box-body
      span.fa.fa-refresh.fa-spin(v-if='loading')
      table.table.table-bordered.table-striped(v-if='!loading')
        thead
          tr
            th Name
            th Description
            th Category
            th Account
            th Destination Account
            th Frequency
            th.text-right Amount
            th Occurred At
            th Created At
            th Actions
        tbody
          tr(v-if='transactions', v-for='transaction in transactions')
            td {{ transaction.name }}
            td {{ transaction.description }}
            td {{ getCategoryName(transaction.category_id) }}
            td {{ getAccountName(transaction.account_id) }}
            td {{ getAccountName(transaction.destination_account_id) }}
            td {{ getFrequencyName(transaction.transaction_frequency_id) }}
            td.text-right.danger(v-if='transaction.amount < 0') ${{ roundNumbers(transaction.amount) }}
            td.text-right.success(v-if='transaction.amount >= 0') ${{ roundNumbers(transaction.amount) }}
            td {{ transaction.occurred_at }}
            td {{ transaction.created_at }}
            td.center
              span.glyphicon.glyphicon-edit.action-icon(v-on:click='editTransaction(transaction)')
              span.glyphicon.glyphicon-trash.action-icon(v-on:click='deleteTransaction(transaction)')
          tr(v-if='$parent.transactions.length == 0')
            td(colspan='10') There are no Transactions in the system.
    .box-footer
      button.btn.btn-success(v-if='!loading', data-toggle='modal', data-target='#create-transaction-modal')
        | Create Transaction
      modals-create
      modals-edit
      modals-delete
</template>

<script>
  // import the modals
  import ModalsCreate from './modals/create.vue';
  import ModalsDelete from './modals/delete.vue';
  import ModalsEdit from './modals/edit.vue';

  // the main code
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
    props: [
      'transactions'
    ],
    data() {
      return {
        loading: false,
        accounts: [],
        categories: [],
        frequencies: [],
        editingTransaction: {
          id: 0,
          account_id: 0,
          destination_account_id: null,
          category_id: 0,
          transaction_frequency_id: 0,
          name: '',
          description: '',
          amount: 0,
          occurred_at: null,
          repeat_start_at: null,
          repeat_end_at: null
        },
        deletingTransaction: {}
      };
    },
    methods: {
      editTransaction: function (transaction) {
        this.editingTransaction = transaction;
        $('#edit-transaction-modal').modal('show');
      },
      deleteTransaction: function (transaction) {
        this.deletingTransaction = transaction;
        $('#delete-transaction-modal').modal('show');
      },
      roundNumbers: function(number) {
        return parseFloat(Math.round(number * 100) / 100).toFixed(2);
      },
      getCategoryName: function(id) {
        const theCategory = this.categories.find(
          function (category) {
            return category.id === id;
          }
        );

        return theCategory.name;
      },
      getAccountName: function(id) {
        if (id == null) {
          return '';
        }

        const theAccount = this.accounts.find(
          function (account) {
            return account.id === id;
          }
        );

        return theAccount.name;
      },
      getFrequencyName: function(id) {
        const theFrequency = this.frequencies.find(
          function (frequency) {
            return frequency.id === id;
          }
        );

        return theFrequency.name;
      }
    },
    components: {
      'modals-create': ModalsCreate,
      'modals-delete': ModalsDelete,
      'modals-edit': ModalsEdit
    }
  }
</script>
