<template>
    <div id="create-transaction-modal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Create Transaction</h4>
                </div>
                <div class="modal-body">
                    <form id="storeTransactionForm" name="storeTransactionForm" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               placeholder="e.g. Mortgage"
                                               v-model="transaction.name">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <input type="text" class="form-control" id="description" name="description"
                                               placeholder="e.g. That big payment every month."
                                               v-model="transaction.description">
                                    </div>
                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <select id="category" name="category" class="form-control"
                                                v-model="transaction.category_id">
                                            <option v-bind:value="category.id" v-for="category in categories">
                                                {{ category.name }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="category">Account</label>
                                        <select id="account" name="account" class="form-control"
                                                v-model="transaction.account_id">
                                            <option v-bind:value="account.id" v-for="account in accounts">
                                                {{ account.name }}
                                            </option>
                                        </select>
                                    </div>
                                    <div v-if="transaction.category_id == 1" class="form-group">
                                        <label for="category">Destination Account</label>
                                        <select id="category" name="category" class="form-control"
                                                v-model="transaction.destination_account_id">
                                            <option v-bind:value="account.id" v-for="account in accounts">
                                                {{ account.name }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="frequency">Frequency</label>
                                        <select id="frequency" name="frequency" class="form-control"
                                                v-model="transaction.transaction_frequency_id">
                                            <option v-bind:value="frequency.id" v-for="frequency in frequencies">
                                                {{ frequency.name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                            <input type="text" class="form-control" id="amount" name="amount"
                                                   placeholder="e.g. 10.25"
                                                   v-model="transaction.amount">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="occurredAt">Occurred At</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="date" class="form-control" id="occurredAt" name="occurredAt"
                                                   v-model="transaction.occurred_at">
                                        </div>
                                    </div>
                                    <div v-if="transaction.transaction_frequency_id > 1" class="form-group">
                                        <label for="repeatStartAt">Repeat Start At</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="date" class="form-control" id="repeatStartAt"
                                                   name="repeatStartAt"
                                                   v-model="transaction.repeat_start_at">
                                        </div>
                                    </div>
                                    <div v-if="transaction.transaction_frequency_id > 1" class="form-group">
                                        <label for="repeatEndAt">Repeat End At</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="date" class="form-control" id="repeatEndAt" name="repeatEndAt"
                                                   v-model="transaction.repeat_end_at">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" v-on:click="storeTransaction">Create</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            // load the accounts
            this.$http.get('http://local-finance-projections.com/api/account')
                .then(
                    function (successResponse) {
                        this.accounts = successResponse.body.accounts;
                    },
                    function (failedResponse) {
                        console.log(failedResponse);
                    }
                );

            // load the categories
            this.$http.get('http://local-finance-projections.com/api/category')
                .then(
                    function (successResponse) {
                        this.categories = successResponse.body.categories;
                    },
                    function (failedResponse) {
                        console.log(failedResponse);
                    }
                );

            // load the frequencies
            this.$http.get('http://local-finance-projections.com/api/frequency')
                .then(
                    function (successResponse) {
                        this.frequencies = successResponse.body.frequencies;
                    },
                    function (failedResponse) {
                        console.log(failedResponse);
                    }
                );
        },
        methods: {
            storeTransaction: function () {
                this.$http.post(
                    'http://local-finance-projections.com/api/transaction',
                    this.transaction
                )
                    .then(
                        function (successResponse) {
                            this.$parent.$parent.transactions.push(successResponse.body.transaction);
                            $('#create-transaction-modal').modal('hide');
                        },
                        function (failedResponse) {
                            console.log(failedResponse);
                        }
                    );

                this.transaction = {
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
                };
            }
        },
        data() {
            return {
                transaction: {
                    account_id: {
                        selected: 0,
                        options: [
                            {id: 0, name: ''}
                        ]
                    },
                    destination_account_id: {
                        selected: 0,
                        options: [
                            {id: 0, name: ''}
                        ]
                    },
                    category_id: {
                        selected: 0,
                        options: [
                            {id: 0, name: ''}
                        ]
                    },
                    transaction_frequency_id: {
                        selected: 0,
                        options: [
                            {id: 0, name: ''}
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
