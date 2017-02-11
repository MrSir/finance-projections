<template>
    <div id="accountsTableTemplate">
        <div class="box-body">
            <span v-if="loading" class="fa fa-refresh fa-spin"></span>
            <table v-if="!loading" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="account in accounts">
                    <td>{{ account.name }}</td>
                    <td>{{ account.description }}</td>
                    <td>{{ account.created_at }}</td>
                    <td class="center">
                        <span class="glyphicon glyphicon-edit" v-on:click="editAccount(account)"></span>

                        <span class="glyphicon glyphicon-remove" data-toggle="modal"
                              :data-target="'#delete-account-modal-' + account.id"></span>
                        <modals.delete :account_id="account.id"></modals.delete>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <button class="btn btn-success" v-if="!loading" data-toggle="modal" data-target="#create-account-modal"
                    v-on:click="createAccount">
                Create Account
            </button>
            <modals.create></modals.create>
            <modals.edit></modals.edit>
        </div>
    </div>
</template>

<script>
    // import the modals
    import ModalsCreate from './modals/create.vue';
    import ModalsDelete from './modals/delete.vue';
    import ModalsEdit from './modals/edit.vue';

    // the main code
    export default {
        mounted() {
            this.$http.get('http://local-finance-projections.com/api/account')
                .then(
                    function (successResponse) {
                        this.loading = false;
                        this.accounts = successResponse.body.accounts;
                    },
                    function (failedResponse) {
                        console.log(failedResponse);
                    }
                );
        },
        beforeMount() {
            this.loading = true;
        },
        data() {
            return {
                loading: false,
                accounts: [],
                editingAccount: {
                    id: 0,
                    name: '',
                    description: ''
                }
            };
        },
        methods: {
            createAccount: function () {
                $('#createAccountForm input').attr('value', '');
            },
            editAccount: function (account) {
                this.editingAccount = account;
                $('#edit-account-modal').modal('show');
            }
        },
        components: {
            'modals.create': ModalsCreate,
            'modals.delete': ModalsDelete,
            'modals.edit': ModalsEdit
        }
    }
</script>
