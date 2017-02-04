<template>
    <div id="accountsTemplate">
        <span v-if="loading" class="fa fa-refresh fa-spin"></span>
        <table v-if="!loading" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Created At</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="account in $parent.accounts">
                <td>{{ account.name }}</td>
                <td>{{ account.description }}</td>
                <td>{{ account.created_at }}</td>
            </tr>
            </tbody>
        </table>
        <button class="btn btn-success" v-if="!loading" data-toggle="modal" data-target="#create-account-modal" v-on:click="createAccount">
            Create Account
        </button>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.$http.get('http://local-finance-projections.com/api/account')
                .then(
                    function (successResponse) {
                        this.loading = false;
                        this.$parent.accounts = successResponse.body.accounts;
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
                loading: false
            };
        },
        methods: {
            createAccount: function () {
                $('#createAccountForm input').attr('value', '');
            }
        }

    }
</script>
