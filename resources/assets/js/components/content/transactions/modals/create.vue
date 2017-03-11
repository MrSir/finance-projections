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
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="e.g. Mortgage"
                                       v-model="transaction.name">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="description" name="description"
                                       placeholder="e.g. That big payment every month." v-model="transaction.description">
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select id="category" name="category" class="form-control">
                                    <option id="0" selected="selected"></option>
                                    <option id="category.id" v-for="category in categories">{{ category.name }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="frequency">Frequency</label>
                                <select id="frequency" name="frequency" class="form-control">
                                    <option id="0" selected="selected"></option>
                                    <option id="frequency.id" v-for="frequency in frequencies">{{ frequency.name }}
                                    </option>
                                </select>
                            </div>
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
            //TODO
//            this.$http.get('http://local-finance-projections.com/api/category')
//                .then(
//                    function (successResponse) {
//                        this.categories = successResponse.body.categories;
//                    },
//                    function (failedResponse) {
//                        console.log(failedResponse);
//                    }
//                );
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
                    name: '',
                    description: ''
                };
            }
        },
        data() {
            return {
                transaction: {
                    name: '',
                    description: ''
                },
                categories: [],
                frequencies: []
            };
        }
    }
</script>
