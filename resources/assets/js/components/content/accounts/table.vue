<template lang="pug">
  #accountsTableTemplate
    .box-body
      span.fa.fa-refresh.fa-spin(v-if='loading')
      table.table.table-bordered.table-striped(v-if='!loading')
        thead
          tr
            th Name
            th Description
            th Created At
            th Actions
        tbody
          tr(v-if='$parent.accounts.length > 0', v-for='account in $parent.accounts')
            td {{ account.name }}
            td {{ account.description }}
            td {{ account.created_at }}
            td.center
              span.glyphicon.glyphicon-edit.action-icon(v-on:click='editAccount(account)')
              span.glyphicon.glyphicon-remove.action-icon(v-on:click='deleteAccount(account)')
          tr(v-if='$parent.accounts.length == 0')
            td(colspan='4') There are no Accounts in the system.
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
        $('#edit-account-modal').modal('show');
      },
      deleteAccount: function (account) {
        this.deletingAccount = account;
        $('#delete-account-modal').modal('show');
      }
    },
    components: {
      'modals-create': ModalsCreate,
      'modals-delete': ModalsDelete,
      'modals-edit': ModalsEdit
    }
  }
</script>
