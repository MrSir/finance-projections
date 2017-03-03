<template>
    <div :id="'delete-account-modal-' + account_id" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Delete Account</h4>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Account.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" v-on:click="destroyAccount">Delete</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            destroyAccount: function () {
                this.$http.delete(
                    'http://local-finance-projections.com/api/account/' + this.account_id,
                    this.account
                )
                    .then(
                        function (successResponse) {
                            this.$parent.$parent.accounts = this.$parent.$parent.accounts.filter(
                                account => account.id !== this.account_id
                            );

                            $('#delete-account-modal-' + this.account_id).modal('hide');
                        },
                        function (failedResponse) {
                            console.log(failedResponse);
                        }
                    );
            }
        },
        props: [
            'account_id'
        ]
    }
</script>
