<template>
    <div id="delete-transaction-modal" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Delete Transaction</h4>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Transaction.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" v-on:click="destroyTransaction">Delete</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            destroyTransaction: function () {
                this.$http.delete(
                    'http://local-finance-projections.com/api/transaction/' + this.$parent.deletingTransaction.id
                )
                    .then(
                        function (successResponse) {
                            this.$parent.$parent.transactions = this.$parent.$parent.transactions.filter(
                                transaction => transaction.id !== this.$parent.deletingTransaction.id
                            );

                            $('#delete-transaction-modal').modal('hide');
                        },
                        function (failedResponse) {
                            console.log(failedResponse);
                        }
                    );
            }
        }
    }
</script>
