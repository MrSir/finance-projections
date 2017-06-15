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
            th Amount
            th Occurred At
            th Created At
            th Actions
        tbody
          tr(v-if='transactions', v-for='transaction in transactions')
            td {{ transaction.name }}
            td {{ transaction.description }}
            td {{ transaction.category_id }}
            td {{ transaction.account_id }}
            td {{ transaction.destinationAccount_id }}
            td {{ transaction.transaction_frequency_id }}
            td.danger(v-if='transaction.is_credit') {{ transaction.amount }}
            td.success(v-if='transaction.is_debit') {{ transaction.amount }}
            td {{ transaction.occurred_at }}
            td {{ transaction.created_at }}
            td.center
              span.glyphicon.glyphicon-edit.action-icon(v-on:click='editTransaction(transaction)')
              span.glyphicon.glyphicon-remove.action-icon(v-on:click='deleteTransaction(transaction)')
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
    props: [
      'transactions'
    ],
    data() {
      return {
        loading: false,
        editingTransaction: {
          id: 0,
          account_id: 0,
          destination_account_id: 0,
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
      }
    },
    components: {
      'modals-create': ModalsCreate,
      'modals-delete': ModalsDelete,
      'modals-edit': ModalsEdit
    }
  }
</script>
