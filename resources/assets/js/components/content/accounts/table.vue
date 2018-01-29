<template lang="pug">
  #accountsTableTemplate
    .box-body
      span.fa.fa-refresh.fa-spin(v-if='loading')
      table.table.table-bordered.table-striped(v-if='!loading')
        thead
          tr
            th Name
            th Description
            th.text-center Balance
            th Last Balance Update
            th Created At
            th.text-center Actions
        tbody
          tr(v-if='$parent.accounts.length > 0', v-for='account in $parent.accounts')
            td {{ account.name }}
            td {{ account.description }}
            td.text-right ${{ account.balance }}
            td {{ account.balanceLastUpdated }}
            td {{ account.created_at }}
            td.text-center
              span.glyphicon.glyphicon-edit.action-icon(v-on:click='editAccount(account)')
              | &nbsp;
              span.glyphicon.glyphicon-trash.action-icon(v-on:click='deleteAccount(account)')
          tr(v-if='$parent.accounts.length == 0')
            td(colspan='6') There are no Accounts in the system.
    .box-footer
      button.btn.btn-success(v-if='!loading', data-toggle='modal', data-target='#create-account-modal', v-on:click='createAccount')
        | Create Account
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
    data() {
      return {
        loading: false,
        editingAccount: {
          id: 0,
          name: '',
          description: ''
        },
        deletingAccount: {}
      };
    },
    methods: {
      createAccount: function () {
        $('#createAccountForm input').attr('value', '');
      },
      editAccount: function (account) {
        this.editingAccount = account;
        this.editingAccount.balance = this.getBalance();
        this.editingAccount.balanceLastUpdated = this.getLastUpdated();

        $('#edit-account-modal').modal('show');
      },
      deleteAccount: function (account) {
        this.deletingAccount = account;
        $('#delete-account-modal').modal('show');
      },
      getBalance: function() {
        const balances = this.editingAccount.account_balances;

        if (balances.length > 0) {
          return parseFloat(Math.round(balances[0].balance * 100) / 100).toFixed(2);
        }

        return null;
      },
      getLastUpdated: function() {
        const balances = this.editingAccount.account_balances;

        if (balances.length > 0) {
          return balances[0].posted_at;
        }

        return null;
      }
    },
    components: {
      'modals-create': ModalsCreate,
      'modals-delete': ModalsDelete,
      'modals-edit': ModalsEdit
    }
  }
</script>
