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
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                       v-model="transaction.name">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="description" name="description"
                                       placeholder="Description" v-model="transaction.description">
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
                }
            };
        }
    }
</script>
